<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\Panel\ExpedienteController;
use App\Http\Controllers\Panel\ClienteController;
use App\Http\Controllers\Panel\InstrumentoController;
use App\Http\Controllers\Panel\ContratoController;
use App\Http\Controllers\Panel\CalibracionController;
use App\Http\Controllers\Panel\CertificadoController;
use App\Http\Controllers\Panel\TecnicoController;
use App\Http\Controllers\Panel\PerfilController;
use App\Http\Controllers\Panel\ActividadController;
use App\Http\Controllers\Ajax\AuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/ajax/login',   [AuthController::class, 'login'])->name('ajax.auth.login');
Route::post('/ajax/logout',  [AuthController::class, 'logout'])->name('ajax.auth.logout');


# --- Panel ---
Route::namespace('App\Http\Controllers\Panel')->prefix('panel')->name('panel.')->middleware('auth')->group(function () {

    Route::get('/', [PanelController::class, 'index'])->name('index');
    // Route::get('/', [PanelController::class, 'index'])->name('dashboard')->middleware('can:gerencia_tecnica,jefatura_calibracion,secretaria,tecnico,jefatura_calidad');

    # -- Clientes --
    Route::resource('/clientes', 'ClienteController')->middleware('can:panel.database');
    Route::get('/clientes/ficha/{id}', [ClienteController::class, 'ficha'])->name('clientes.ficha')->middleware('can:panel.database');


    # -- Instrumentos --

    Route::resource('/entrada-instrumentos', 'InstrumentoController')->names([
        'index' => 'instrumentos.index',
        'create' => 'instrumentos.create',
        'edit'  => 'instrumentos.edit',
        'update' => 'instrumentos.update',
        'store' => 'instrumentos.store',
        'show'  => 'instrumentos.show',
        'show'  => 'instrumentos.show',
        'destroy' => 'instrumentos.destroy'
    ])->middleware('can:panel.admin');


    Route::resource('/egreso-instrumentos', 'EgresoController')->names([
        'index' => 'egreso.index',
        'create' => 'egreso.create',
        'edit'  => 'egreso.edit',
        'update' => 'egreso.update',
        'store' => 'egreso.store',
        'show'  => 'egreso.show',
        'destroy' => 'egreso.destroy'
    ])->middleware('can:panel.database');

    Route::resource('/facturacion', 'FacturacionController')->names([
        'index' => 'facturacion.index',
        'create' => 'facturacion.create',
        'edit'  => 'facturacion.edit',
        'update' => 'facturacion.update',
        'store' => 'facturacion.store',
        'show'  => 'facturacion.show',
        'destroy' => 'facturacion.destroy'
    ])->middleware('can:panel.admin');



    # -- Certificados --

    Route::get('/calibracion/certificados', [CertificadoController::class, 'index'])->name('calibracion.certificados.index')->middleware('can:gerencia_tecnica,jefatura_calibracion');

    # -- Calibración  --
    Route::resource('/calibracion', 'CalibracionController')->names([
        'create' => 'calibracion.create',
        'edit'  => 'calibracion.edit',
        'update' => 'calibracion.update',
        'store' => 'calibracion.store',
        'show'  => 'calibracion.show',
        'destroy' => 'calibracion.destroy'
    ])->middleware('can:panel.admin');

    Route::get('/alert_calibration', 'CalibracionController@getAlertCalibration')->name('alert.calibration');
    Route::get('/condition', [PanelController::class, 'getCondition'])->name('condition.all');
    Route::get('/magnitud', [PanelController::class, 'getMagnitudes'])->name('magnitud.all');

    # -- Usuarios --
    // Route::resource('/usuarios', 'UsuarioController')->names([
    //     'create' => 'usuarios.create',
    //     'edit'  => 'usuarios.edit',
    //     'update' => 'usuarios.update',
    //     'store' => 'usuarios.store',
    //     'show'  => 'usuarios.show',
    //     'destroy' => 'usuarios.destroy'
    // ])->middleware('can:panel.database');

    Route::resource('/usuarios', 'UsuarioController')->middleware('can:panel.database');
    Route::get('/usuario/active/{id}', 'UsuarioController@active')->name('usuarios.active')->middleware('can:panel.database');

    # -- Patrones --
    // Route::resource('/patrones', 'PatronController')->names([
    //     'create' => 'patrones.create',
    //     'edit'  => 'patrones.edit',
    //     'update' => 'patrones.update',
    //     'store' => 'patrones.store',
    //     'show'  => 'patrones.show',
    //     'destroy' => 'patrones.destroy'
    // ])->middleware('can:gerencia_tecnica,jefatura_calidad');

    Route::resource('/patrones', 'PatronController')->middleware('can:panel.database');
    Route::get('/patron/{id}', 'PatronController@getPatronForId')->name('patron.get')->middleware('can:panel.database');
    Route::get('/patron-hoja-vida/{id}', 'PatronController@hojaVida')->name('patron.hojaVida')->middleware('can:panel.database');



    # -- Equipos --
    Route::resource('/equipos', 'EquipoController')->middleware('can:panel.database');
    Route::get('/equipo/hoja-vida/{id}', 'EquipoController@hojaVida')->name('equipo.hojaVida')->middleware('can:panel.database');
    Route::get('/equipo/{id}', 'EquipoController@getEquipoForId')->name('equipos.get')->middleware('can:panel.database');


    Route::resource('/historial', 'HistorialController')->middleware('can:panel.database');

    # -- Incertidumbre --
    Route::resource('/incertidumbre', 'IncertidumbreController')->names([
        'create' => 'incertidumbre.create',
        'edit'  => 'incertidumbre.edit',
        'update' => 'incertidumbre.update',
        'store' => 'incertidumbre.store',
        'show'  => 'incertidumbre.show',
        'destroy' => 'incertidumbre.destroy'
    ])->middleware('can:panel.admin');

    Route::resource('/incertidumbre', 'IncertidumbreController')->middleware('can:panel.admin');

    # -- Servicios --
    Route::resource('/procedimientos', 'ProcedimientoController')->middleware('can:panel.database');
    Route::get('/procedimiento/{id}', 'ProcedimientoController@getProcedimientoForId')->name('procedimientos.get')->middleware('can:panel.database');

    # -- Tecnico --

    Route::prefix('perfil')->name('perfil.')->group(function () {
        Route::get('/dashboard', [PerfilController::class, 'index'])->name('index')->middleware('can:tecnico');
        /***************************************************************** Resources *****************************************************************/

        Route::resource('/informes', 'InformeController')->names([
            'index' => 'informes.index',
            'create' => 'informes.create',
            'edit'  => 'informes.edit',
            'update' => 'informes.update',
            'store' => 'informes.store',
            'show'  => 'informes.show',
            'destroy' => 'informes.destroy'
        ])->middleware('can:tecnico');

        Route::resource('/actividades', 'ActividadController')->names([
            'index' => 'actividades.index',
            'create' => 'actividades.create',
            'edit'  => 'actividades.edit',
            'update' => 'actividades.update',
            'store' => 'actividades.store',
            'show'  => 'actividades.show',
            'destroy' => 'actividades.destroy'
        ])->middleware('can:tecnico');
    });

    # -- Expedientes --

    Route::get('/expedientes/agenda', [ExpedienteController::class, 'agenda'])->name('expedientes.agenda')->middleware('can:panel.admin');

    /***************************************************************** Resources *****************************************************************/


    # -- Expedientes (Resources) --

    Route::resource('/expedientes/agendamientos', 'AgendamientoController')->middleware('can:panel.admin');
    Route::resource('/expedientes', 'ExpedienteController')->middleware('can:panel.admin');

    # -- Certificados (Resources) --

    Route::resource('/calibracion/certificados', 'CertificadoController')->names([
        'index' => 'calibracion.certificados.index',
        'create' => 'calibracion.certificados.create',
        'edit'  => 'calibracion.certificados.edit',
        'update' => 'calibracion.certificados.update',
        'store' => 'calibracion.certificados.store',
        'destroy' => 'calibracion.certificados.destroy',
        'show' => 'calibracion.certificados.show'
    ])->middleware('can:panel.admin');

    Route::resource('/mantenimientos/tecnicos/grupos', 'GrupoTecnicoController')->names([
        'index' => 'tecnicos.grupos.index',
        'create' => 'tecnicos.grupos.create',
        'edit'  => 'tecnicos.grupos.edit',
        'update' => 'tecnicos.grupos.update',
        'store' => 'tecnicos.grupos.store',
        'destroy' => 'tecnicos.grupos.destroy',
        'show' => 'tecnicos.grupos.show'
    ])->middleware('can:panel.admin');

    Route::resource('/mantenimientos/tecnicos', 'TecnicoController')->middleware('can:panel.admin');
});

// Quick search dummy route to display html elements in search dropdown (header search)
#Route::get('/quick-search', [PagesController::class, 'quickSearch'])->name('quick-search');
