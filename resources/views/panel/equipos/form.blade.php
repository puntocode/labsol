@extends('layouts.panel')

@section('title')Equipos y Ensayos |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Equipos y Ensayos
			<small class="font-weight-lighter">| {{ (isset($equipo)) ? 'Editar' : 'Crear' }}</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        @if (isset($equipo))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.equipos.show', $equipo) }}" class="as-text text-hover-primary" title="Ver detalles del Equipo">
                                    <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al Equipo
                                </a>
                                <hr>
                            </div>

                            <div class="flex-grow-1">
                                <a href="{{ route('panel.equipos.create') }}" class="as-text text-hover-primary" title="Eliminar este Equipo">
                                    <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Equipo
                                </a>
                                <hr>
                            </div>
                         @endif

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.equipos.index') }}" class="as-text text-hover-primary" title="Ir a listado de equipos">
                                <i class="fas {{ (isset($equipo)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
                <div class="card card-custom card-step mb-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="card-title font-weight-bolder text-dark">Datos de equipo <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                            <hr>
                        </div>
                    </div>
                    <equipo-card id="{{ isset($equipo) ? $equipo->id : 0 }}"></equipo-card>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const showRoute   = `{{ route('panel.equipos.show',  isset($equipo) ? $equipo->id : 0) }}`
        const updateRoute = `{{ route('panel.equipos.update',isset($equipo) ? $equipo->id : 0) }}`
        const getEquipo   = `{{ route('panel.equipos.get',   isset($equipo) ? $equipo->id : 0) }}`
        const indexRoute  = `{{ route('panel.equipos.index') }}`
        const createRoute = `{{ route('panel.equipos.create') }}`
        const storeRoute  = `{{ route('panel.equipos.store') }}`
        const condition   = `{{ route('panel.condition.all') }}`
        const magnitud    = `{{ route('panel.magnitud.all') }}`
        const alertCal    = `{{ route('panel.alert.calibration') }}`

        window.routes = {
            'show'      : showRoute,
            'store'     : storeRoute,
            'update'    : updateRoute,
            'index'     : indexRoute,
            'create'    : createRoute,
            'getEquipo' : getEquipo,
            'condition' : condition,
            'magnitud'  : magnitud,
            'alertCal'  : alertCal,
        }
    </script>
@endsection
