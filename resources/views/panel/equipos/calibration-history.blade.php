@extends('layouts.panel')

@section('title')Equipos |@endsection
@section('meta')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="card-label mb-8">Equipo <small class="font-weight-lighter">| {{ $equipo->code }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.equipos.show', $equipo) }}" class="as-text text-hover-primary" title="Ver detalles del Equipo">
                                <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al Equipo
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.equipo.maintenance-history', [$equipo, 0]) }}" class="as-text text-hover-primary" title="Ver detalles del Equipo">
                                <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Mantenimiento
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.equipos.index') }}" class="as-text text-hover-primary" title="Ir a listado de equipos">
                                <i class="fas fa-list text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <equipo-historial :id="{{ $id }}"></equipo-historial>
                </div>

            </div>
		</div>
    </div>
@endsection
@section('rutas')
<script>
    window.anho = "{{ $equipo->calibration_period }}";
    const ficha     = "{{ route('panel.equipos.show', $equipo) }}";
    const getHis    = "{{ route('panel.history-calibration.get', $id) }}";
    const updateHis = "{{ route('panel.history-calibration.update') }}";
    const hisNew    = "{{ route('panel.equipo.calibration-history', [$equipo, 0]) }}";
    const storeHis  = "{{ route('panel.equipo.calibration-history.store', $equipo->id) }}";
    window.routes = {
        'ficha' : ficha,
        'getHis': getHis,
        'hisNew': hisNew,
        'storeHis': storeHis,
        'updateHis' : updateHis,
    }
</script>
@endsection
