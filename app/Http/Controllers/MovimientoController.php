<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Movimiento;
use App\Models\Pago;
use App\Models\Tipopago;
use Illuminate\Http\Request;

/**
 * Class MovimientoController
 * @package App\Http\Controllers
 */
class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientos = Movimiento::all();

        return view('movimiento.index', compact('movimientos'))
            ->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movimiento = new Movimiento();
        $tipopagos = Tipopago::all()->pluck('nombre', 'id');
        $cuentas = Cuenta::all()->pluck('nombre', 'id');
        return view('movimiento.create', compact('movimiento', 'cuentas', 'tipopagos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Movimiento::$rules);

        $movimiento = Movimiento::create($request->all());
        $pago = Pago::create([
            'fecha' => date('Y-m-d'),
            'importe' => $request->monto,
            'tipopago_id' => $request->tipopago_id,
            'movimiento_id' => $movimiento->id,
        ]);

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::find($id);

        return view('movimiento.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimiento = Movimiento::find($id);
        $cuentas = Cuenta::all()->pluck('nombre', 'id');
        $tipopagos = Tipopago::all()->pluck('nombre', 'id');
        return view('movimiento.edit', compact('movimiento', 'cuentas','tipopagos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Movimiento $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        request()->validate(Movimiento::$rules);

        $movimiento->update($request->all());

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::find($id)->delete();

        return redirect()->route('movimientos.index')
            ->with('success', 'Movimiento deleted successfully');
    }
}
