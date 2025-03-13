<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use Illuminate\Http\Request;

/**
 * Class AporteController
 * @package App\Http\Controllers
 */
class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aportes = Aporte::all();

        return view('aporte.index', compact('aportes'))
            ->with('i',  0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aporte = new Aporte();
        $meses = array("" => "Seleccione una mes", "Enero" => "Enero", "Febrero" => "Febrero", "Marzo" => "Marzo", "Abril" => "Abril", "Mayo" => "Mayo", "Junio" => "Junio", "Julio" => "Julio", "Agosto" => "Agosto", "Septiembre" => "Septiembre", "Octubre" => "Octubre", "Noviembre" => "Noviembre", "Diciembre" => "Diciembre");
        return view('aporte.create', compact('aporte', 'meses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Aporte::$rules);

        $aporte = Aporte::create($request->all());

        return redirect()->route('aportes.index')
            ->with('success', 'Aporte created successfully.');
    }
    public function generargestion()
    {
        $gestion = date('Y');
        $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        for ($i = 1; $i <= 12; $i++) {
            $codigo = $i . '-' . $gestion;
            $aporte = Aporte::create([
                'codigo' => $codigo,
                'gestion' => $gestion,
                'mes' => $meses[$i],
                'importe' => 50,
            ]);
        }


        return redirect()->route('aportes.index')
            ->with('success', 'Aporte created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aporte = Aporte::find($id);

        return view('aporte.show', compact('aporte'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aporte = Aporte::find($id);

        return view('aporte.edit', compact('aporte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Aporte $aporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aporte $aporte)
    {
        request()->validate(Aporte::$rules);

        $aporte->update($request->all());

        return redirect()->route('aportes.index')
            ->with('success', 'Aporte updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $aporte = Aporte::find($id)->delete();

        return redirect()->route('aportes.index')
            ->with('success', 'Aporte deleted successfully');
    }
}
