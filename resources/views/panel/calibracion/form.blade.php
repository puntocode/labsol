@extends('layouts.panel')
@section('title')Calibración |@endsection

@section('content')

	<div class="container-fluid">
		<h3 class="card-label mb-8">Calibración <small class="font-weight-lighter">| Crear</small>
		</h3>

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
        const VALOR_STORE = "{{ route('panel.valors.store') }}";
        const SUBMULTIPLOS = "{{ route('panel.patrones.unidades_medidas') }}";
        const PATRON_UM_IDE = "{{ route('panel.patron.ide.um') }}";
        const STORE_CALIBRACION = "{{ route('panel.calibracion.store') }}";
        const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";
        const VALOR_RESULTADO_STORE = "{{ route('panel.valor-resultado.store') }}";
        const VALOR_INCERTIDUMBRE_STORE = "{{ route('panel.valor-incertidumbre.store') }}";
        const VALOR_INCERTIDUMBRE_RESULTADO_STORE = "{{ route('panel.incertidumbre-resultados.store') }}";

        window.routes = {
            'index': INDEX,
            'store': STORE_CALIBRACION,
            'manuales': MANUALES,
            'valorStore': VALOR_STORE,
            'patronUmIde': PATRON_UM_IDE,
            'submultiplos': SUBMULTIPLOS,
            'estadoExpediente': ESTADO_EXPEDIENTE,
            'valorResultadoStore': VALOR_RESULTADO_STORE,
            'valorIncertidumbreStore': VALOR_INCERTIDUMBRE_STORE,
            'valorIncertidumbreResultadoStore': VALOR_INCERTIDUMBRE_RESULTADO_STORE,
        }
    </script>
@endsection




