<?php

namespace App\Http\Livewire;

use App\Models\Cuenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class Reportegestion extends Component
{
    public $gestion, $result1, $result2, $resultMovimientos, $selCuenta = "";

    public function mount()
    {
        $this->gestion = date('Y');
    }

    public function render()
    {
        $gestiones = DB::select("SELECT DISTINCT(YEAR(fecha)) gestion FROM movimientos ORDER BY gestion DESC");
        if ($this->gestion) {
            $this->result1 = DB::select("SELECT c.id,c.nombre movimiento, c.tipo, COUNT(*) cantidad,  SUM(m.monto) total FROM movimientos m
            INNER JOIN cuentas c ON c.id=m.cuenta_id
            WHERE YEAR(m.fecha)=" . $this->gestion . "
            GROUP BY c.id,movimiento, tipo");

            $this->result2 = DB::select("SELECT c.tipo,SUM(m.monto) montos FROM movimientos m
            INNER JOIN cuentas c ON c.id=m.cuenta_id
            WHERE YEAR(m.fecha)=" . $this->gestion . "
            GROUP BY tipo");
        } else {
            $this->result1 = DB::select("SELECT c.id,c.nombre movimiento, c.tipo, COUNT(*) cantidad,  SUM(m.monto) total FROM movimientos m
            INNER JOIN cuentas c ON c.id=m.cuenta_id
            GROUP BY c.id,movimiento, tipo");

            $this->result2 = DB::select("SELECT c.tipo,SUM(m.monto) montos FROM movimientos m
            INNER JOIN cuentas c ON c.id=m.cuenta_id
            GROUP BY tipo");
        }
        return View('livewire.reportegestion', compact('gestiones'))->with('i', 1)->extends('adminlte::page');
    }

    protected $listeners = ['movimientos'];



    public function movimientos($cuenta_id)
    {
        $cuenta = Cuenta::find($cuenta_id);
        $this->selCuenta = $cuenta->nombre;
        $this->reset('resultMovimientos');
        $this->resultMovimientos = DB::select("SELECT m.fecha,m.descripcion, c.tipo, m.monto FROM movimientos m
INNER JOIN cuentas c ON c.id=m.cuenta_id
WHERE cuenta_id = $cuenta_id 
AND Year(m.fecha)=".$this->gestion." 
ORDER BY m.fecha ASC");
    }
}
