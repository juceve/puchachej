<?php

namespace App\Http\Livewire;

use App\Models\Aporte;
use App\Models\Aportemiembro;
use App\Models\Miembro;
use App\Models\Movimiento;
use App\Models\Pago;
use App\Models\Pagosaportemiembro;
use App\Models\Tipopago;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CobrosAportes extends Component
{
    public $selMiembro = "", $aportesgestion, $miembro;
    public $selAportes = [], $montototal = 0, $selTipoPago = "";

    public function resetAll()
    {
        $this->reset('selMiembro', 'aportesgestion', 'selAportes', 'selTipoPago', 'montototal');
    }

    public function updatedSelMiembro()
    {
        $aportesMiembro = Aportemiembro::where('miembro_id', $this->selMiembro)->select('aporte_id')->get();
        $apM = [];
        foreach ($aportesMiembro as $item) {
            $apM[] = $item->aporte_id;
        }

        $this->miembro = Miembro::find($this->selMiembro);
        $this->aportesgestion = Aporte::where("gestion", "<=",date('Y'))
            ->whereNotIn('id', $apM)
            ->get();
    }
    public function render()
    {
        $miembros = Miembro::where('status',1)->get();
        $tipopagos = Tipopago::all();
        $aportesmiembros = Aportemiembro::all();
        $this->emit('dataTable');
        return view('livewire.cobros-aportes', compact('miembros', 'tipopagos', 'aportesmiembros'))->extends('adminlte::page');
    }

    public function pagar1()
    {
        $this->reset('montototal', 'selTipoPago');
        if (count($this->selAportes)) {
            foreach ($this->selAportes as $id) {
                $aporte = Aporte::find($id);
                $this->montototal += $aporte->importe;
            }
            $this->emit('abrirpago2');
        } else {
            $this->emit('warning', 'Debe seleccionar algun aporte para Pagar');
        }
    }

    public function pagar2()
    {
        $this->validate([
            'selTipoPago' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $movimientos = [];
            $recibo = '';
            $recibo .= $this->miembro->nombre . '|' . date('Y-m-d') . '|';
            foreach ($this->selAportes as $id) {
                $aporte = Aporte::find($id);

                $movimiento = Movimiento::create([
                    'fecha' => date('Y-m-d'),
                    'descripcion' => 'Pago aporte | Cod.:' . $aporte->codigo . ' | ' . $this->miembro->nombre,
                    'cuenta_id' => 1,
                    'user_id' => Auth::user()->id,
                    'monto' => $aporte->importe
                ]);

                $aportemiembro = Aportemiembro::create([
                    "aporte_id" => $id,
                    "miembro_id" => $this->selMiembro,
                    "movimiento_id" => $movimiento->id,
                    'fecha' => date('Y-m-d'),
                ]);

                $pago = Pago::create([
                    'fecha' => date('Y-m-d'),
                    'importe' => $aporte->importe,
                    'tipopago_id' => $this->selTipoPago,
                    'movimiento_id' => $movimiento->id,
                ]);

                $pagoaportemiembro = Pagosaportemiembro::create([
                    'aportemiembro_id' => $aportemiembro->id,
                    'pago_id' => $pago->id,
                ]);
                $movimientos[] = $movimiento;
                $recibo .= $movimiento->id . '^Pago aporte^' . $aporte->codigo . '^' . $aporte->importe . '~';
            }
            $recibo = substr($recibo, 0, -1);
            $recibo .= '|' . $this->montototal;
            DB::commit();
            $this->resetAll();
            $this->emit('cerrarModales');
            $this->emit('success', 'Pago realizado con exito');
            $this->emit('imprimir', $recibo);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function reimpresion($aportemiembro_id)
    {
        $aportemiembro = Aportemiembro::find($aportemiembro_id);
        $fecha = $aportemiembro->fecha;
        $miembro = $aportemiembro->miembro->nombre;
        $codigo = $aportemiembro->aporte->codigo;
        $movimiento = $aportemiembro->movimiento;
        $pagosaportemiembro = $aportemiembro->pagosaportemiembros->first();
        $importe = $pagosaportemiembro->pago->importe;
        $recibo = '';
        $recibo .= $miembro . '|' . $fecha . '|';
        $recibo .= $movimiento->id . '^Pago aporte^' . $codigo . '^' . $importe;
        $recibo .= '|' . $importe;

        $this->emit('imprimir', $recibo);
    }
}
