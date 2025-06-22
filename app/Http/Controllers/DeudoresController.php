<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeudoresController extends Controller
{
    public function buscar(Request $request)
    {
        $request->validate([
            'cedula' => 'required'
        ]);

        $cedula = $request->cedula;
        if ($cedula != '0') {
            $sql = "SELECT * FROM (
            SELECT 
                m2.nombre AS miembro, 
                m.detalles, 
                m.monto 
            FROM multas m
            INNER JOIN miembros m2 ON m.miembro_id = m2.id
            WHERE 
                m.estado = 0
                AND m2.status = 1
                AND m2.nrodoc = ?

            UNION

            SELECT 
                m.nombre AS miembro, 
                CONCAT('Aporte: ', a.codigo) AS detalles, 
                a.importe AS monto 
            FROM aportes a
            CROSS JOIN miembros m
            LEFT JOIN aportemiembros am ON a.id = am.aporte_id AND m.id = am.miembro_id
            WHERE (
                    (
                        CAST(SUBSTRING_INDEX(a.codigo, '-', -1) AS UNSIGNED) = YEAR(CURDATE()) AND 
                        CAST(SUBSTRING_INDEX(a.codigo, '-', 1) AS UNSIGNED) <= MONTH(CURDATE())
                    )
                    OR 
                    CAST(SUBSTRING_INDEX(a.codigo, '-', -1) AS UNSIGNED) < YEAR(CURDATE())
                )
                AND am.id IS NULL
                AND m.status = 1
                AND m.nrodoc = ?
        ) AS CONSULTA";

            $deudas = DB::select($sql, [$cedula, $cedula]);

            return response()->json($deudas);
        }else{
             return response()->json(array());
        }
    }
}
