<?php

namespace App\Http\Controllers;

use App\Models\Pagosaportemiembro;
use Illuminate\Http\Request;

/**
 * Class PagosaportemiembroController
 * @package App\Http\Controllers
 */
class PagosaportemiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagosaportemiembros = Pagosaportemiembro::paginate();

        return view('pagosaportemiembro.index', compact('pagosaportemiembros'))
            ->with('i', (request()->input('page', 1) - 1) * $pagosaportemiembros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagosaportemiembro = new Pagosaportemiembro();
        return view('pagosaportemiembro.create', compact('pagosaportemiembro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Pagosaportemiembro::$rules);

        $pagosaportemiembro = Pagosaportemiembro::create($request->all());

        return redirect()->route('pagosaportemiembros.index')
            ->with('success', 'Pagosaportemiembro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagosaportemiembro = Pagosaportemiembro::find($id);

        return view('pagosaportemiembro.show', compact('pagosaportemiembro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagosaportemiembro = Pagosaportemiembro::find($id);

        return view('pagosaportemiembro.edit', compact('pagosaportemiembro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Pagosaportemiembro $pagosaportemiembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagosaportemiembro $pagosaportemiembro)
    {
        request()->validate(Pagosaportemiembro::$rules);

        $pagosaportemiembro->update($request->all());

        return redirect()->route('pagosaportemiembros.index')
            ->with('success', 'Pagosaportemiembro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pagosaportemiembro = Pagosaportemiembro::find($id)->delete();

        return redirect()->route('pagosaportemiembros.index')
            ->with('success', 'Pagosaportemiembro deleted successfully');
    }
}
