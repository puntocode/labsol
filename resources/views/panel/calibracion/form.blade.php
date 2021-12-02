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

        const patronUmIde = "{{ route('panel.patron.ide.um') }}";
        const submultiplos = "{{ route('panel.patrones.unidades_medidas') }}";
        const storeCalibracion = "{{ route('panel.calibracion.store') }}";
        const indexCalibracion = "{{ route('panel.calibracion.index') }}";
        const estadoExpediente = "{{ route('panel.expedientes.update_estado') }}";

        window.routes = {
            'index': indexCalibracion,
            'store': storeCalibracion,
            'patronUmIde': patronUmIde,
            'submultiplos': submultiplos,
            'estadoExpediente': estadoExpediente
        }
    </script>
@endsection




