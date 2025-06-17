<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class FotoController
 * @package App\Http\Controllers
 */
class FotoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:5012',
        ]);

        $archivo = $request->file('file');
        $extension = $archivo->getClientOriginalExtension();
        $name = uniqid() . '_' . date('Ymd_His') . '.' . $extension;

        $registro = $archivo->storeAs('temp', $name, 'public');
        $path = 'temp/' . $name;
        return response()->json([
            'success' => true,
            'path' => $path,
            'url' => Storage::url($path),
        ]);
    }
}
