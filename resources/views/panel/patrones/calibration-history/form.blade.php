ficha@extends('layouts.panel')

@section('title')Patrones |@endsection
@section('meta')<meta name="csrf-token" content="{{ csrf_token() }}">@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="card-label mb-8">Patrón <small class="font-weight-lighter">| {{ $patron->code }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.show', $patron) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
                                <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al Patrón
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patron.maintenance-history', [$patron, 0]) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
                                <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Mantenimiento
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.doc', $patron) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
                                <i class="far fa-plus-square text-hover-primary mr-2"></i> Cargar Documentos
                            </a>
                            <hr>
                        </div>

                        {{-- <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Patrón
                            </a>
                            <hr>
                        </div> --}}

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas fa-list text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <patron-historial :id="{{ $id }}"></patron-historial>
                </div>

            </div>
		</div>
    </div>
@endsection
@section('rutas')
<script>
    const ficha = "{{ route('panel.patrones.show', $patron) }}";
    const storeHis    = "{{ route('panel.patron.calibration-history.store', $patron->id) }}";
    const hisNew      = "{{ route('panel.patron.calibration-history', [$patron, 0]) }}";
    const updateHis   = "{{ route('panel.history-calibration.update', $patron->id) }}";
    const getHis      = "{{ route('panel.history-calibration.get', $id) }}";
    window.routes = {
        'ficha' : ficha,
        'getHis': getHis,
        'hisNew': hisNew,
        'updateHis' : updateHis,
        'storeHis': storeHis,
    }
</script>
@endsection
