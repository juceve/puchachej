<?php

namespace App\Http\Controllers;

use App\Models\Miembro;
use Illuminate\Http\Request;

/**
 * Class MiembroController
 * @package App\Http\Controllers
 */
class MiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miembros = Miembro::paginate();

        return view('miembro.index', compact('miembros'))
            ->with('i', (request()->input('page', 1) - 1) * $miembros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miembro = new Miembro();
        return view('miembro.create', compact('miembro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Miembro::$rules);

        $miembro = Miembro::create($request->all());

        return redirect()->route('miembros.index')
            ->with('success', 'Miembro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $miembro = Miembro::find($id);

        return view('miembro.show', compact('miembro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $miembro = Miembro::find($id);

        return view('miembro.edit', compact('miembro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Miembro $miembro)
    {
        request()->validate(Miembro::$rules);

        $miembro->update($request->all());

        return redirect()->route('miembros.index')
            ->with('success', 'Miembro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $miembro = Miembro::find($id)->delete();

        return redirect()->route('miembros.index')
            ->with('success', 'Miembro deleted successfully');
    }
}
