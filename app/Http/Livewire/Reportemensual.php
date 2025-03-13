<?php

namespace App\Http\Livewire;

use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reportemensual extends Component
{
    public $mes = "", $gestion = "", $tabla1 = NULL, $tabla1Title = "";

    public function render()
    {
        $gestiones = DB::select("SELECT DISTINCT(YEAR(fecha)) gestion FROM movimientos ORDER BY gestion DESC");

        return view('livewire.reportemensual', compact('gestiones'))->with('i', 1)->extends('adminlte::page');
    }

    protected $rules = [
        "mes" => 'required',
        "gestion" => 'required'
    ];

    public function generar()
    {
        $this->validate();
        $this->reset('tabla1', 'tabla1Title');
        $sql = "SELECT c.nombre cuenta, c.tipo, COUNT(*) cantidad, SUM(m.monto) monto FROM movimientos m
        INNER JOIN cuentas c ON c.id = m.cuenta_id
        WHERE YEAR(m.fecha) = '$this->gestion'
        AND MONTH(m.fecha) = '$this->mes'
        AND m.status = 1
        GROUP BY c.nombre, c.tipo";
        $movimientos = DB::select($sql);

        $this->tabla1 = $movimientos;
        $this->tabla1Title = "$this->mes-$this->gestion";
    }
}
