<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reportedeudores extends Component
{
    public function render()
    {
        $sql = "SELECT * from
(SELECT m2.nombre miembro, m.detalles,m.monto from multas m
inner join miembros m2 on m.miembro_id =m2.id
where m.estado=0
and m2.status=1
UNION
SELECT m.nombre AS miembro, CONCAT('Aporte: ',a.codigo)  AS detalles, a.importe as monto from aportes a
CROSS JOIN miembros m
LEFT JOIN aportemiembros am
ON
    a.id = am.aporte_id AND m.id = am.miembro_id
WHERE
(
(CAST(SUBSTRING_INDEX(codigo, '-', -1) AS UNSIGNED) = YEAR(CURDATE()) 
         AND CAST(SUBSTRING_INDEX(codigo, '-', 1) AS UNSIGNED) <= MONTH(CURDATE()))
        OR        
        CAST(SUBSTRING_INDEX(codigo, '-', -1) AS UNSIGNED) < YEAR(CURDATE())
)
    and
    am.id IS null
    and m.status = 1) as CONSULTA
    order by miembro ASC";

        $deudas = DB::select($sql);
        $i = 0;
        return view('livewire.reportedeudores', compact('deudas', 'i'))->extends('adminlte::page');
    }
}
