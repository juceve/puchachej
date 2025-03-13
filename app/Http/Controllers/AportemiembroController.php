<?php

namespace App\Http\Controllers;

use App\Models\Aportemiembro;
use Illuminate\Http\Request;

/**
 * Class AportemiembroController
 * @package App\Http\Controllers
 */
class AportemiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aportemiembros = Aportemiembro::paginate();

        return view('aportemiembro.index', compact('aportemiembros'))
            ->with('i', (request()->input('page', 1) - 1) * $aportemiembros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aportemiembro = new Aportemiembro();
        return view('aportemiembro.create', compact('aportemiembro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Aportemiembro::$rules);

        $aportemiembro = Aportemiembro::create($request->all());

        return redirect()->route('aportemiembros.index')
            ->with('success', 'Aportemiembro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aportemiembro = Aportemiembro::find($id);

        return view('aportemiembro.show', compact('aportemiembro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aportemiembro = Aportemiembro::find($id);

        return view('aportemiembro.edit', compact('aportemiembro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Aportemiembro $aportemiembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aportemiembro $aportemiembro)
    {
        request()->validate(Aportemiembro::$rules);

        $aportemiembro->update($request->all());

        return redirect()->route('aportemiembros.index')
            ->with('success', 'Aportemiembro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $aportemiembro = Aportemiembro::find($id)->delete();

        return redirect()->route('aportemiembros.index')
            ->with('success', 'Aportemiembro deleted successfully');
    }
}
