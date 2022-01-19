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
        const MANUALES = "{{ route('panel.patrones.manuales') }}";
        const VALOR_INDEX = "{{ route('panel.valors.index') }}";
        const VALOR_STORE = "{{ route('panel.valors.store') }}";
        const CERTIFICADOS = "{{ route('panel.certificados.index') }}";
        const SUBMULTIPLOS = "{{ route('panel.patrones.unidades_medidas') }}";
        const PATRON_UM_IDE = "{{ route('panel.patron.ide.um') }}";
        const INDEX_EXPEDIENTE = "{{ route('panel.expedientes.index') }}";
        const UPDATE_HISTORICO = "{{ route('panel.calibrar.actualizar.historico') }}";
        const STORE_CALIBRACION = "{{ route('panel.calibracion.store') }}";
        const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";
        const VALOR_HISTORIAL_GET = "{{ route('panel.valor-historial.get') }}";
        const VALOR_RESULTADO_INDEX = "{{ route('panel.valor-resultado.index') }}";
        const VALOR_RESULTADO_STORE = "{{ route('panel.valor-resultado.store') }}";
        const VALOR_HISTORIAL_STORE = "{{ route('panel.valor-historial.store') }}";
        const VALOR_CERTIFICADO_STORE = "{{ route('panel.valor-certificados.store') }}";
        const VALOR_INCERTIDUMBRE_STORE = "{{ route('panel.valor-incertidumbre.store') }}";
        const VALOR_INCERTIDUMBRE_RESULTADO_STORE = "{{ route('panel.incertidumbre-resultados.store') }}";

        window.routes = {
            'index': INDEX,
            'store': STORE_CALIBRACION,
            'manuales': MANUALES,
            'valorIndex': VALOR_INDEX,
            'valorStore': VALOR_STORE,
            'patronUmIde': PATRON_UM_IDE,
            'certificados': CERTIFICADOS,
            'submultiplos': SUBMULTIPLOS,
            'indexExpediente': INDEX_EXPEDIENTE,
            'updateHistorico': UPDATE_HISTORICO,
            'estadoExpediente': ESTADO_EXPEDIENTE,
            'valorHistorialGet': VALOR_HISTORIAL_GET,
            'valorResultadoStore': VALOR_RESULTADO_STORE,
            'valorCertificadoStore': VALOR_CERTIFICADO_STORE,
            'valorIncertidumbreStore': VALOR_INCERTIDUMBRE_STORE,
            'valorIncertidumbreResultadoStore': VALOR_INCERTIDUMBRE_RESULTADO_STORE,
        };

        window.routesEdit = {
            'valorIndex': VALOR_INDEX,
            'patronUmIde': PATRON_UM_IDE,
            'guardarHistorico': VALOR_HISTORIAL_STORE,
            'valoresHistorial': VALOR_HISTORIAL_GET,
            'valorResultadoIndex': VALOR_RESULTADO_INDEX
        };
    </script>
@endsection




