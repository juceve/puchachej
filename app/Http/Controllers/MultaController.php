<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use Illuminate\Http\Request;

/**
 * Class MultaController
 * @package App\Http\Controllers
 */
class MultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multas = Multa::paginate();

        return view('multa.index', compact('multas'))
            ->with('i', (request()->input('page', 1) - 1) * $multas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $multa = new Multa();
        return view('multa.create', compact('multa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Multa::$rules);

        $multa = Multa::create($request->all());

        return redirect()->route('multas.index')
            ->with('success', 'Multa created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $multa = Multa::find($id);

        return view('multa.show', compact('multa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $multa = Multa::find($id);

        return view('multa.edit', compact('multa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Multa $multa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multa $multa)
    {
        request()->validate(Multa::$rules);

        $multa->update($request->all());

        return redirect()->route('multas.index')
            ->with('success', 'Multa updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $multa = Multa::find($id)->delete();

        return redirect()->route('multas.index')
            ->with('success', 'Multa deleted successfully');
    }
}
