<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;

/**
 * Class CuentaController
 * @package App\Http\Controllers
 */
class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuenta::paginate();

        return view('cuenta.index', compact('cuentas'))
            ->with('i', (request()->input('page', 1) - 1) * $cuentas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuenta = new Cuenta();
        return view('cuenta.create', compact('cuenta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cuenta::$rules);

        $cuenta = Cuenta::create($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuenta = Cuenta::find($id);

        return view('cuenta.show', compact('cuenta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuenta = Cuenta::find($id);

        return view('cuenta.edit', compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cuenta $cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuenta $cuenta)
    {
        request()->validate(Cuenta::$rules);

        $cuenta->update($request->all());

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuenta = Cuenta::find($id)->delete();

        return redirect()->route('cuentas.index')
            ->with('success', 'Cuenta deleted successfully');
    }
}
