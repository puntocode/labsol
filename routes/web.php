<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\Ajax\AuthController;
use App\Http\Controllers\Panel\PerfilController;
use App\Http\Controllers\Panel\ClienteController;
use App\Http\Controllers\Panel\InstrumentoController;
use App\Http\Controllers\Panel\CertificadoController;

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
    Route::resource('/instrumentos', 'InstrumentoController')->middleware('can:panel.database');
    Route::resource('/entrada-instrumentos', 'EntradaInstrumentoController')->middleware('can:panel.admin');
    Route::get('/entrada-instrumentos-print/{entradaInstrumento}', 'EntradaInstrumentoController@print')->name('entrada-instrumentos.print')->middleware('can:panel.admin');
    Route::get('/instrumentos-all', [InstrumentoController::class, 'getInstrumentos'])->name('instrumentos.all')->middleware('can:panel.database');
    Route::get('/instrument/active/{id}', 'InstrumentoController@active')->name('instrumento.active')->middleware('can:panel.database');


    Route::get('egreso-instrumentos/enviar-certificados-calibracion', 'EnviarCertificadoCalibracionController@index')
        ->name('egreso.enviar-certificados-calibracion.index')
        ->middleware('can:panel.admin');

    Route::post('egreso-instrumentos/enviar-certificados-calibracion', 'EnviarCertificadoCalibracionController@send')
        ->name('egreso.enviar-certificados-calibracion.send')
        ->middleware('can:panel.admin');

    Route::resource('egreso-instrumentos', 'EgresoController')
        ->parameter('egreso-instrumentos', 'entradaInstrumento')
        ->names('egreso')
        ->middleware('can:panel.database');

    Route::get('/egreso-instrumentos-print/{entradaInstrumento}', 'EgresoController@print')->name('egreso.print')->middleware('can:panel.admin');

    Route::prefix('facturas')->name('facturas.')->middleware('can:panel.admin')->group(function () {
        Route::resource('prefacturas', 'PrefacturaController');
    });

    Route::resource('/facturacion', 'FacturacionController')->names([
        'index'   => 'facturacion.index',
        'create'  => 'facturacion.create',
        'edit'    => 'facturacion.edit',
        'update'  => 'facturacion.update',
        'store'   => 'facturacion.store',
        'show'    => 'facturacion.show',
        'destroy' => 'facturacion.destroy'
    ])->middleware('can:panel.admin');


    # -- Certificados --
    Route::get('/calibracion/certificados', [CertificadoController::class, 'index'])->name('calibracion.certificados.index')->middleware('can:gerencia_tecnica,jefatura_calibracion');


    # -- Calibración  --
    Route::resource('/calibracion', 'CalibracionController')->middleware('can:panel.database');
    Route::get('/calibraciones/expediente/{expediente_id}', 'CalibracionController@calibrarExpediente')->name('calibrar.expediente')->middleware('can:panel.database');
    Route::put('/update-calibracion', 'CalibracionController@actualizarHistorico')->name('calibrar.actualizar.historico')->middleware('can:panel.database');
    Route::post('/calibraciones-limpiar', 'CalibracionController@limpiarValores')->name('calibrar.limpiar')->middleware('can:panel.database');


    Route::resource('/valors', 'ValorController')->middleware('can:panel.database');
    Route::resource('/valor-resultado', 'ValorResultadoController')->middleware('can:panel.database');
    Route::resource('/valor-incertidumbre', 'ValorIncertidumbreController')->middleware('can:panel.database');
    Route::resource('/incertidumbre-resultados', 'ValorIncertidumbreResultadoController')->middleware('can:panel.database');

    Route::delete('/valor-incertidumbre-delete', 'ValorIncertidumbreController@eliminarIncertidumbres')->name('valor.incertidumbre.delete')->middleware('can:panel.database');
    Route::put('/valor-resultados/update', 'ValorResultadoController@updateValorResultado')->name('valor.resultados.update')->middleware('can:panel.database');
    Route::put('/valor-incertidumbre-result/update', 'ValorIncertidumbreResultadoController@updateIncertidumbreResultado')->name('incertidumbre.resultados.update')->middleware('can:panel.database');

    Route::get('/valor-certificados', 'ValorCertificadoController@getValoresForValorId')->name('valor-certificados.get')->middleware('can:panel.admin');
    Route::post('/valor-certificados', 'ValorCertificadoController@store')->name('valor-certificados.store')->middleware('can:panel.database');
    Route::put('/valor-certificado/update', 'ValorCertificadoController@updateValorCertificado')->name('valor.certificados.update')->middleware('can:panel.database');

    Route::get('/incertidumbre-valor', 'ValorIncertidumbreController@getValorIncertidumbre')->name('incertidumbre.valor')->middleware('can:panel.database');
    Route::get('/resultado-valor-id', 'ValorIncertidumbreResultadoController@getResultado')->name('incertidumbre.resultado')->middleware('can:panel.database');

    Route::get('/alert_calibration', 'CalibracionController@getAlertCalibration')->name('alert.calibration');
    Route::get('/condition', [PanelController::class, 'getCondition'])->name('condition.all');
    Route::get('/magnitud', [PanelController::class, 'getMagnitudes'])->name('magnitud.all');

    Route::get('/valores-historial', 'ValorHistorialController@getValoresForCalibracion')->name('valor-historial.get')->middleware('can:panel.admin');
    Route::post('/valores-historial', 'ValorHistorialController@store')->name('valor-historial.store')->middleware('can:panel.admin');

    # -- Calibración Historial  --
    Route::resource('/calibracion-historial', 'CalibracionHistorialController')->middleware('can:panel.database');


    # -- Patrones --
    Route::resource('/patrones', 'PatronController')->middleware('can:panel.database');
    Route::get('/patron/{id}', 'PatronController@getPatronForId')->name('patron.get')->middleware('can:panel.database');
    Route::get('/patron-hoja-vida/{id}', 'PatronController@hojaVida')->name('patron.hojaVida')->middleware('can:panel.database');

    # -- Patrones Documentos--
    Route::get('/patron-doc/{patron}', 'PatronController@documents')->name('patrones.doc')->middleware('can:panel.database');
    Route::post('/patron-doc/{patron}', 'PatronController@storeDocument')->name('patrones.doc.store')->middleware('can:panel.database');
    Route::get('/patron-manuales', 'PatronController@getManuales')->name('patrones.manuales')->middleware('can:panel.database');


    # -- Patrones Historial Calibracion--
    Route::get('/patron-calibration-history/{patron}/{id}', 'PatronController@patronCalibrationHistory')->name('patron.calibration-history')->middleware('can:panel.database');
    Route::post('/patron-calibration-history/{id}', 'PatronController@storeCalibrationHistory')->name('patron.calibration-history.store')->middleware('can:panel.database');


     # -- Patrones Historial Mantenimiento--
    Route::get('/patron-maintenance-history/{patron}/{id}', 'PatronController@patronMaintenanceHistory')->name('patron.maintenance-history')->middleware('can:panel.database');
    Route::post('/patron-maintenance-history/{id}', 'PatronController@patronMaintenanceStore')->name('patron.maintenance-history.store')->middleware('can:panel.database');

    # -- Patrones IDE --
    Route::resource('/patrones-ide', 'PatronIdeController')->middleware('can:panel.database');
    Route::get('/patrones-ide-all/{patron_id}', 'PatronIdeController@patronIdeShow')->name('patron_ide.show')->middleware('can:panel.database');
    Route::get('/patron-ide-unidades', 'PatronController@unidadesIde')->name('patrones.unidades_medidas')->middleware('can:panel.database');
    Route::get('/patron-ide/{id}', 'PatronController@ideForm')->name('patron.ide.form')->middleware('can:panel.database');
    Route::get('/patron-ide-um/get-unidad-medida', 'PatronIdeController@getUmIde')->name('patron.ide.um')->middleware('can:panel.database');
    Route::delete('/patron-ide/{id}', 'PatronIdeController@destroy')->name('patron_ide.delete')->middleware('can:panel.database');


    # -- Patrones Ensayo --
    Route::get('/patron-ensayo/{id}', 'PatronController@ensayoForm')->name('patron.ensayo.form')->middleware('can:panel.database');
    Route::get('/patron-ensayo/{id}/edit', 'PatronController@ensayoEdit')->name('patron.ensayo.edit')->middleware('can:panel.database');
    Route::post('/patron-ensayo/store', 'PatronController@ensayoStore')->name('patron.ensayo.store')->middleware('can:panel.database');
    Route::put('/patron-ensayo/update', 'PatronController@ensayoUpdate')->name('patron.ensayo.update')->middleware('can:panel.database');
    Route::delete('/patron-ensayo/{id}', 'PatronController@ensayoDestroy')->name('patron.ensayo.delete')->middleware('can:panel.database');


    # --  Patrones IDE Rangos --
    Route::get('/ide-rangos', 'IdeRangoController@index')->name('ide_rango.index')->middleware('can:panel.database');
    Route::get('/ide-rangos/{id}/edit', 'IdeRangoController@edit')->name('ide_rango.edit')->middleware('can:panel.database');
    Route::delete('/ide-rangos/{id}', 'IdeRangoController@destroy')->name('ide_rango.destroy')->middleware('can:panel.database');
    # --  Patrones IDE Rangos Derivas--
    Route::post('/derivas', 'IdeRangoController@insertDeriva')->name('rango_deriva.insert')->middleware('can:panel.database');
    Route::put('/derivas/{id}', 'IdeRangoController@updateDeriva')->name('rango_deriva.update')->middleware('can:panel.database');
    Route::delete('/derivas/{id}', 'IdeRangoController@destroyDeriva')->name('rango_deriva.destroy')->middleware('can:panel.database');


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


    # -- Historial PATRONES / EQUIPOS --
    Route::get('/historial', 'HistorialController@index')->name('historial.index')->middleware('can:panel.database');
    Route::get('/history-calibracion/{id}', 'HistorialController@getHistoryCalibration')->name('history-calibration.get');
    Route::put('/history-calibration-update', 'HistorialController@updateCalibrationHistory')->name('history-calibration.update')->middleware('can:panel.database');
    Route::delete('/history-calibration/{id}', 'HistorialController@destroyCalibracion')->name('history-calibration.destroy')->middleware('can:panel.database');
    Route::post('/historial/doc-store/{id}', 'HistorialController@storeCertificate')->name('history-calibration.doc.store')->middleware('can:panel.database');
    Route::post('/historial-calibracion/doc-delete/{id}', 'HistorialController@deleteCertificate')->name('history-calibration.doc.del')->middleware('can:panel.database');
    Route::get('/history-maintenance/{id}', 'HistorialController@getHistoryMaintenance')->name('history-maintenance.get');
    Route::put('/history-maintenance-update/{id}', 'HistorialController@updateHistoryMaintenance')->name('history-maintenance.update')->middleware('can:panel.database');
    Route::delete('/history-maintenance/{id}', 'HistorialController@destroyMaintenance')->name('history-maintenance.destroy')->middleware('can:panel.database');
    Route::delete('/documento', 'HistorialController@destroyDocument')->name('document.destroy')->middleware('can:panel.database');

    # -- Incertidumbre --
    Route::resource('/incertidumbre', 'IncertidumbreController')->middleware('can:panel.admin');


    # -- Procedimientos --
    Route::resource('/procedimientos', 'ProcedimientoController')->middleware('can:panel.database');
    Route::get('/procedimiento/{id}', 'ProcedimientoController@getProcedimientoForId')->name('procedimientos.get')->middleware('can:panel.database');
    Route::post('/procedimientos/doc-store/{id}', 'ProcedimientoController@storeDocument')->name('procedimientos.doc.store')->middleware('can:panel.database');
    Route::post('/procedimientos/doc-delete/{id}', 'ProcedimientoController@deleteDocument')->name('procedimientos.doc.del')->middleware('can:panel.database');
    Route::delete('/procedimientos/patron-delete/{id}', 'ProcedimientoController@destroyProcedimientoPatron')->name('patron_procedimiento.delete')->middleware('can:panel.database');
    Route::put('/procedimiento/update-ema', 'ProcedimientoController@updateEma')->name('procedimientos.update.ema')->middleware('can:panel.database');
    Route::post('/procedimiento/update-acreditado', 'ProcedimientoController@updateAcreditado')->name('procedimientos.update.acreditado')->middleware('can:panel.database');

    # -- Expedientes --
    Route::resource('/expedientes', 'ExpedienteController')->middleware('can:panel.admin');
    Route::get('/expediente/espera', 'ExpedienteController@getExpedienteEspera')->name('expedientes.espera')->middleware('can:panel.admin');
    Route::put('/expediente/update-tecnicos', 'ExpedienteController@asignarTecnicos')->name('expedientes.update_tecnicos')->middleware('can:panel.admin');
    Route::put('/expediente/update-estado', 'ExpedienteController@cambiarEstadoExpediente')->name('expedientes.update_estado')->middleware('can:panel.admin');
    Route::get('/expediente/agenda', 'ExpedienteController@agenda')->name('expedientes.agenda')->middleware('can:panel.admin');
    Route::get('/expediente/asignar-tecnico', 'ExpedienteController@asignarTecnicoIndex')->name('expedientes.asignar')->middleware('can:panel.admin');
    Route::get('/expediente/historial', 'ExpedienteController@getHistorial')->name('expedientes.historial')->middleware('can:panel.admin');
    // Route::resource('/expedientes/agendamientos', 'AgendamientoController')->middleware('can:panel.admin');

    # -- Certificados --
    Route::get('/calibracion/certificados/print/{expedienteId}', [CertificadoController::class, 'print'])->name('calibracion.certificados.print')->middleware('can:panel.admin');
    Route::resource('/calibracion/certificados', 'CertificadoController')->middleware('can:panel.admin');


    # -- Tecnicos --
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


    # -- Formularios --
    Route::resource('/formularios', 'FormularioController')->middleware('can:panel.database');


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
