<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Galeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class GaleriaController
 * @package App\Http\Controllers
 */
class GaleriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galerias = Galeria::paginate();

        return view('galeria.index', compact('galerias'))
            ->with('i', (request()->input('page', 1) - 1) * $galerias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galeria = new Galeria();
        return view('galeria.create', compact('galeria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $galeria = Galeria::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
            ]);


            $imagenes = explode('|', $request->imagenes_temp);

            foreach ($imagenes as $rutaTemp) {
                if (Storage::exists($rutaTemp)) {
                    $nuevaRuta = str_replace('temp/', 'foto_galeria/', $rutaTemp);
                    Storage::move($rutaTemp, $nuevaRuta);

                    $foto = Foto::create([
                        'galeria_id' => $galeria->id,
                        'url' => $nuevaRuta,
                        'descripcion' => 'Foto_Galeria'
                    ]);
                }
            }
            DB::select("UPDATE galerias SET estado=0 WHERE id!=" . $galeria->id);
            DB::commit();

            return redirect()->route('galerias.index')->with('success', 'Galeria registrada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('galerias.create')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galeria = Galeria::find($id);

        return view('galeria.show', compact('galeria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galeria = Galeria::find($id);

        return view('galeria.edit', compact('galeria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Galeria $galeria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeria $galeria)
    {
        request()->validate(Galeria::$rules);

        $galeria->update($request->all());

        return redirect()->route('galerias.index')
            ->with('success', 'Galeria updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $galeria = Galeria::find($id)->delete();

        return redirect()->route('galerias.index')
            ->with('success', 'Galeria deleted successfully');
    }
}
