<?php

use App\Http\Controllers\AporteController;
use App\Http\Controllers\AportemiembroController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagosaportemiembroController;
use App\Http\Controllers\TipopagoController;
use App\Http\Livewire\CobrosAportes;
use App\Http\Livewire\Multas;
use App\Http\Livewire\Reportedeudores;
use App\Http\Livewire\Reportegestion;
use App\Http\Livewire\Reportemensual;
use App\Models\Galeria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $galeria = Galeria::where('estado', 1)->first();
    return view('welcome', compact('galeria'));
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/tipopagos', TipopagoController::class)->names('tipopagos');
    Route::resource('/aportes', AporteController::class)->names('aportes');
    Route::get('/generargestion', [AporteController::class, 'generargestion'])->name('generargestion');
    Route::resource('/aportemiembros', AportemiembroController::class)->names('aportemiembros');
    Route::resource('/cuentas', CuentaController::class)->names('cuentas');
    Route::resource('/miembros', MiembroController::class)->names('miembros');
    Route::resource('/movimientos', MovimientoController::class)->names('movimientos');
    Route::resource('/pagos', PagoController::class)->names('pagos');
    Route::resource('/pagosaportemiembros', PagosaportemiembroController::class)->names('pagosaportemiembros');
    Route::resource('/galerias', GaleriaController::class)->names('galerias');

    Route::get('cobros/aportes', CobrosAportes::class)->name('cobros.aportes');
    Route::get('multas', Multas::class)->name('multas');
    Route::get('reportes/mensual', Reportemensual::class)->name('reportemensual');
    Route::get('reportes/gestion', Reportegestion::class)->name('reportegestion');
    Route::get('reportes/deudores', Reportedeudores::class)->name('reportedeudores');


    Route::post('/fotos/upload', [FotoController::class, 'upload'])->name('fotos.upload');
});
