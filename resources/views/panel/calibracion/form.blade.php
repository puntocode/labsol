@extends('layouts.panel')
@section('title')Calibración |@endsection

@section('content')

	<div class="container-fluid">
		<div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Calibración <small class="font-weight-lighter">| Crear</small></h3>
            <anular-expediente :expediente_id="{{ $expediente->id }}"></anular-expediente>
        </div>

        <div class="row">
			<div class="col-lg-12 col-xl-12">
				<div class="card card-custom mb-5">
					<div class="card-body">
                        <calibracion-form :data="{{ json_encode($expediente) }}"></calibracion-form>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection

@section('rutas')
    <script>
        window.username = "{{ auth()->user()->fullname }}";
        window.user_id = "{{ auth()->user()->id }}";
        window.asset = "{{ URL::asset('')  }}";

        const INDEX = "{{ route('panel.calibracion.index') }}";
        const AGENDA = "{{ route('panel.expedientes.agenda') }}";
        const CMC_SHOW = "{{ route('panel.cmc.show') }}";
        const MANUALES = "{{ route('panel.patrones.manuales') }}";
        const VALOR_INDEX = "{{ route('panel.valors.index') }}";
        const VALOR_STORE = "{{ route('panel.valors.store') }}";
        const SUBMULTIPLOS = "{{ route('panel.patrones.unidades_medidas') }}";
        const PATRON_UM_IDE = "{{ route('panel.patron.ide.um') }}";
        const INDEX_EXPEDIENTE = "{{ route('panel.expedientes.index') }}";
        const UPDATE_HISTORICO = "{{ route('panel.calibrar.actualizar.historico') }}";
        const STORE_CALIBRACION = "{{ route('panel.calibracion.store') }}";
        const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";
        const VALOR_HISTORIAL_GET = "{{ route('panel.valor-historial.get') }}";
        const VALOR_RESULTADO_STORE = "{{ route('panel.valor.resultados.store') }}";
        const VALOR_HISTORIAL_STORE = "{{ route('panel.valor-historial.store') }}";
        const VALOR_RESULTADO_UPDATE = "{{ route('panel.valor.resultados.update') }}";
        const VALOR_CERTIFICADO_GET = "{{ route('panel.valor-certificados.get') }}";
        const VALOR_CERTIFICADO_STORE = "{{ route('panel.valor-certificados.store') }}";
        const CALIBRACION_UPDATE_CAMPO = "{{ route('panel.calibracion.update.campo') }}";
        const VALOR_CERTIFICADO_UPDATE = "{{ route('panel.valor.certificados.update') }}";
        const VALOR_INCERTIDUMBRE_STORE = "{{ route('panel.valor.incertidumbre.store') }}";
        const VALOR_INCERTIDUMBRE_DELETE = "{{ route('panel.valor.incertidumbre.delete') }}";
        const VALOR_INCERTIDUMBRE_RESULTADO_STORE = "{{ route('panel.incertidumbre.resultados.store') }}";
        const VALOR_INCERTIDUMBRE_RESULTADO_UPDATE = "{{ route('panel.incertidumbre.resultados.update') }}";

        const CALIBRACION_HISTORIAL_STORE = "{{ route('panel.calibracion-historial.store') }}";
        const COMPROBAR_PIN = "{{ route('panel.comprobar.password') }}";

        window.routes = {
            'index': INDEX,
            'agenda': AGENDA,
            'store': STORE_CALIBRACION,
            'cmcShow': CMC_SHOW,
            'manuales': MANUALES,
            'valorIndex': VALOR_INDEX,
            'valorStore': VALOR_STORE,
            'patronUmIde': PATRON_UM_IDE,
            'updateCampo': CALIBRACION_UPDATE_CAMPO,
            'submultiplos': SUBMULTIPLOS,
            'indexExpediente': INDEX_EXPEDIENTE,
            'updateHistorico': UPDATE_HISTORICO,
            'guardarHistorico': VALOR_HISTORIAL_STORE,
            'estadoExpediente': ESTADO_EXPEDIENTE,
            'valorHistorialGet': VALOR_HISTORIAL_GET,
            'valorResultadoStore': VALOR_RESULTADO_STORE,
            'valorResultadoUpdate': VALOR_RESULTADO_UPDATE,
            'valorCertificadoStore': VALOR_CERTIFICADO_STORE,
            'valorCertificadoUpdate': VALOR_CERTIFICADO_UPDATE,
            'valorIncertidumbreStore': VALOR_INCERTIDUMBRE_STORE,
            'valorIncertidumbreDelete': VALOR_INCERTIDUMBRE_DELETE,
            'calibracionHistorialStore': CALIBRACION_HISTORIAL_STORE,
            'valorIncertidumbreResultadoStore': VALOR_INCERTIDUMBRE_RESULTADO_STORE,
            'valorIncertidumbreResultadoUpdate': VALOR_INCERTIDUMBRE_RESULTADO_UPDATE,
        };

        window.routesEdit = {
            'updateCampo': CALIBRACION_UPDATE_CAMPO,
            'comprobarPin': COMPROBAR_PIN,
            'calibracionHistorialStore': CALIBRACION_HISTORIAL_STORE
        };
    </script>
@endsection




