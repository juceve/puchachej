<?php

namespace App\Http\Livewire;

use App\Models\Miembro;
use App\Models\Motivo;
use App\Models\Movimiento;
use App\Models\Multa;
use App\Models\Pago;
use App\Models\Tipopago;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Multas extends Component
{

    public $miembro_id = '', $detalles = '', $monto = '', $estado = false, $motivoid = '', $tipopagoid = '';

    public function render()
    {
        $miembros = Miembro::where('status', 1)->get();
        $motivos = Motivo::all();
        $multas = Multa::all();
        $tipopagos = Tipopago::all();
        $this->emit('resetDataTable');
        return view('livewire.multas', compact('miembros', 'multas', 'motivos', 'tipopagos'))->extends('adminlte::page');
    }

    protected $rules = [
        "miembro_id" => "required",
        "motivoid" => "required",
        "monto" => "required",
        "estado" => "required",
    ];

    protected $listeners = ['delete', 'pagar'];

    public function updatedMotivoid()
    {
        $motivo = Motivo::find($this->motivoid);
        $this->detalles = $motivo->descripcion;
        $this->monto = $motivo->importe;
    }

    public function registrar()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            $miembro = Miembro::find($this->miembro_id);
            $recibo = '';
            $recibo .= $miembro->nombre . '|' . date('Y-m-d') . '|';
            $multa = Multa::create([
                "fecha" => date('Y-m-d'),
                "miembro_id" => $this->miembro_id,
                "motivo_id" => $this->motivoid,
                "detalles" => $this->detalles,
                "monto" => $this->monto,
                "estado" => $this->estado,
            ]);

            if ($this->estado) {
                $movimiento = Movimiento::create([
                    'fecha' => date('Y-m-d'),
                    'descripcion' => 'Pago Multa | ID.:' . $multa->id . ' | ' . $miembro->nombre,
                    'cuenta_id' => 7,
                    'tipopago_id' => $this->tipopagoid,
                    'user_id' => Auth::user()->id,
                    'monto' => $multa->monto
                ]);

                $pago = Pago::create([
                    'fecha' => date('Y-m-d'),
                    'importe' => $multa->monto,
                    'tipopago_id' => $this->tipopagoid,
                    'movimiento_id' => $movimiento->id,
                ]);

                $recibo .= $movimiento->id . '^Pago Multa^' . $multa->id . '^' . $multa->monto . '~';
            }
            $recibo = substr($recibo, 0, -1);
            $recibo .= '|' . $multa->monto;

            $this->emit('cerrarModales');
            $this->emit('success', 'Multa generada con exito');
            if ($this->estado) {
                $this->emit('imprimir', $recibo);
            }
            $this->resetAll();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error.');
        }
    }

    public function pagar($multa_id)
    {
        DB::beginTransaction();
        try {
            $multa = Multa::find($multa_id);
            $recibo = '';
            $recibo .= $multa->miembro->nombre . '|' . date('Y-m-d') . '|';

            $movimiento = Movimiento::create([
                'fecha' => date('Y-m-d'),
                'descripcion' => 'Pago Multa | ID.:' . $multa->id . ' | ' . $multa->miembro->nombre,
                'cuenta_id' => 7,
                'tipopago_id' => 1,
                'user_id' => Auth::user()->id,
                'monto' => $multa->monto
            ]);

            $pago = Pago::create([
                'fecha' => date('Y-m-d'),
                'importe' => $multa->monto,
                'tipopago_id' => 1,
                'movimiento_id' => $movimiento->id,
            ]);
            $multa->estado = true;
            $multa->save();

            $recibo .= $movimiento->id . '^Pago Multa^' . $multa->id . '^' . $multa->monto . '~';
            $recibo = substr($recibo, 0, -1);
            $recibo .= '|' . $multa->monto;
            DB::commit();
            $this->emit('success', 'Multa pagada con exito');
            $this->emit('imprimir', $recibo);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('error', 'Ha ocurrido un error.');
        }
    }

    public function resetAll()
    {
        $this->reset('miembro_id', 'motivoid', 'detalles', 'monto', 'estado');
    }

    public function delete($id)
    {
        $multa = Multa::find($id);
        $multa->delete();
        $this->emit('success', 'Multa eliminada con exito');
    }
}
