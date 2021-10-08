<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\Panel\ExpedienteController;
use App\Http\Controllers\Panel\ClienteController;
use App\Http\Controllers\Panel\InstrumentoController;
use App\Http\Controllers\Panel\CertificadoController;
use App\Http\Controllers\Panel\PerfilController;
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


    # -- Clientes --
    Route::resource('/clientes', 'ClienteController')->middleware('can:panel.database');
    Route::get('/clientes/ficha/{id}', [ClienteController::class, 'ficha'])->name('clientes.ficha')->middleware('can:panel.database');


    # -- Instrumentos --
    Route::resource('/entrada-instrumentos', 'EntradaInstrumentoController')->middleware('can:panel.admin');
    Route::get('/entrada-instrumentos-print/{entradaInstrumento}', 'EntradaInstrumentoController@print')->name('entrada-instrumentos.print')->middleware('can:panel.admin');
    Route::get('/instrumentos-all', [InstrumentoController::class, 'getInstrumentos'])->name('instrumentos.all')->middleware('can:panel.database');

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


    # -- Patrones --
    Route::resource('/patrones', 'PatronController')->middleware('can:panel.database');
    Route::get('/patron/{id}', 'PatronController@getPatronForId')->name('patron.get')->middleware('can:panel.database');
    Route::get('/patron-hoja-vida/{id}', 'PatronController@hojaVida')->name('patron.hojaVida')->middleware('can:panel.database');


    # -- Patrones Documentos--
    Route::get('/patron-doc/{patron}', 'PatronController@documents')->name('patrones.doc')->middleware('can:panel.database');
    Route::post('/patron-doc/{patron}', 'PatronController@storeDocument')->name('patrones.doc.store')->middleware('can:panel.database');

    # -- Patrones Historial Calibracion--
    Route::get('/patron-calibration-history/{patron}/{id}', 'PatronController@patronCalibrationHistory')->name('patron.calibration-history')->middleware('can:panel.database');
    Route::post('/patron-calibration-history/{id}', 'PatronController@storeCalibrationHistory')->name('patron.calibration-history.store')->middleware('can:panel.database');

     # -- Patrones Historial Mantenimiento--
    Route::get('/patron-maintenance-history/{patron}/{id}', 'PatronController@patronMaintenanceHistory')->name('patron.maintenance-history')->middleware('can:panel.database');
    Route::post('/patron-maintenance-history/{id}', 'PatronController@patronMaintenanceStore')->name('patron.maintenance-history.store')->middleware('can:panel.database');


    # -- Patrones IDE --
    Route::resource('/patrones-ide', 'PatronIdeController')->middleware('can:panel.database');
    Route::get('/patron-ide-unidades', 'PatronController@unidadesIde')->name('patrones.unidades_ide')->middleware('can:panel.database');
    Route::get('/patron-ide/{id}', 'PatronController@ideForm')->name('patron.ide.form')->middleware('can:panel.database');


    # -- Equipos --
    Route::resource('/equipos', 'EquipoController')->middleware('can:panel.database');
    Route::get('/equipo/hoja-vida/{id}', 'EquipoController@hojaVida')->name('equipo.hojaVida')->middleware('can:panel.database');
    Route::get('/equipo/{id}', 'EquipoController@getEquipoForId')->name('equipos.get')->middleware('can:panel.database');

     # -- Equipos Documentos--
     Route::get('/equipo-doc/{equipo}', 'EquipoController@documents')->name('equipos.doc')->middleware('can:panel.database');
     Route::post('/equipo-doc/{id}', 'EquipoController@storeDocument')->name('equipos.doc.store')->middleware('can:panel.database');

     # -- Equipos Historial Calibracion--
     Route::get('/equipo-calibration-history/{equipo}/{id}', 'EquipoController@equipoCalibrationHistory')->name('equipo.calibration-history')->middleware('can:panel.database');
     Route::post('/equipo-calibration-history/{id}', 'EquipoController@storeCalibrationHistory')->name('equipo.calibration-history.store')->middleware('can:panel.database');

    # -- Equipos Historial Mantenimiento--
    Route::get('/equipo-maintenance-history/{equipo}/{id}', 'EquipoController@equipoMaintenanceHistory')->name('equipo.maintenance-history')->middleware('can:panel.database');
    Route::post('/equipo-maintenance-history/{id}', 'EquipoController@equipoMaintenanceStore')->name('equipo.maintenance-history.store')->middleware('can:panel.database');


    # -- Historial --
    Route::resource('/historial', 'HistorialController')->middleware('can:panel.database');
    Route::get('/history-calibracion/{id}', 'HistorialController@getHistoryCalibration')->name('history-calibration.get');
    Route::put('/history-calibration-update', 'HistorialController@updateCalibrationHistory')->name('history-calibration.update')->middleware('can:panel.database');
    Route::get('/history-maintenance/{id}', 'HistorialController@getHistoryMaintenance')->name('history-maintenance.get');
    Route::put('/history-maintenance-update/{id}', 'HistorialController@updateHistoryMaintenance')->name('history-maintenance.update')->middleware('can:panel.database');


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
    Route::get('/procedimiento-doc/{procedimiento}', 'ProcedimientoController@documents')->name('procedimientos.doc')->middleware('can:panel.database');
    Route::post('/procedimiento-doc/{id}', 'ProcedimientoController@storeDocument')->name('procedimientos.doc.store')->middleware('can:panel.database');


    # -- Expedientes --
    Route::resource('/expedientes', 'ExpedienteController')->middleware('can:panel.admin');
    Route::get('/expediente/espera', 'ExpedienteController@getExpedienteEspera')->name('expedientes.espera')->middleware('can:panel.admin');
    Route::put('/expediente/update-tecnicos', 'ExpedienteController@asignarTecnicos')->name('expedientes.update_tecnicos')->middleware('can:panel.admin');
    Route::get('/expediente/agenda', 'ExpedienteController@agenda')->name('expedientes.agenda')->middleware('can:panel.admin');
    Route::get('/expediente/asignar-tecnico', 'ExpedienteController@asignarTecnicoIndex')->name('expedientes.asignar')->middleware('can:panel.admin');
    Route::resource('/expedientes/agendamientos', 'AgendamientoController')->middleware('can:panel.admin');


    # -- Certificados --
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


    # -- Usuarios --
    Route::resource('/usuarios', 'UsuarioController')->middleware('can:panel.database');
    Route::get('/usuario/active/{id}', 'UsuarioController@active')->name('usuarios.active')->middleware('can:panel.database');
    Route::get('/usuario/tecnicos', 'UsuarioController@getTecnicos')->name('usuarios.tecnicos')->middleware('can:panel.admin');


    # -- Tecnico --
    Route::prefix('perfil')->name('perfil.')->group(function () {
        Route::get('/dashboard', [PerfilController::class, 'index'])->name('index')->middleware('can:tecnico');

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


});


// Quick search dummy route to display html elements in search dropdown (header search)
#Route::get('/quick-search', [PagesController::class, 'quickSearch'])->name('quick-search');

// Route::get('/test', function(){
//     $expediente = Expediente::find(1);
//     return $expediente->servicios->priority;
// });
