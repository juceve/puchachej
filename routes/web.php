<?php

use App\Http\Controllers\AporteController;
use App\Http\Controllers\AportemiembroController;
use App\Http\Controllers\CuentaController;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
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

    Route::get('cobros/aportes', CobrosAportes::class)->name('cobros.aportes');
    Route::get('multas', Multas::class)->name('multas');
    Route::get('reportes/mensual', Reportemensual::class)->name('reportemensual');
    Route::get('reportes/gestion', Reportegestion::class)->name('reportegestion');
    Route::get('reportes/deudores', Reportedeudores::class)->name('reportedeudores');
});
