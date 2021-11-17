@extends('layouts.panel')

@section('title')Procedimiento |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="mb-8 card-label">Procedimientos <small class="font-weight-lighter">| {{ (isset($procedimiento)) ? 'Editar' : 'Crear' }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						@if (isset($procedimiento))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.procedimientos.show', $procedimiento) }}" class="as-text text-hover-primary" title="Ver detalles del procedimiento">
                                    <i class="mr-2 fas fa-arrow-left text-hover-primary"></i> Ir al procedimiento
                                </a>
                                <hr>
                            </div>

                            <div class="flex-grow-1">
                                <a href="{{ route('panel.procedimientos.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="mr-2 far fa-plus-square text-hover-primary"></i> Nuevo procedimiento
                                </a>
                                <hr>
                            </div>

                            {{-- <div class="flex-grow-1">
                                <a href="{{ route('panel.patrones.destroy', $patrone) }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="mr-2 fas fa-trash text-hover-primary"></i> Eliminar Patrón
                                </a>
                                <hr>
                            </div> --}}
                        @endif

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas {{ (isset($procedimiento)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                <i class="mr-2 far fa-plus-square text-hover-primary"></i> Crear Patron
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.equipos.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                <i class="mr-2 far fa-plus-square text-hover-primary"></i> Crear Equipo
                            </a>
                            <hr>
                        </div>
					</div>
				</div>
			</div>

            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="pb-0 border-0 card-header">
                        <div class="pt-8 card-title border-bottom w-100">
                            <h3 class="font-weight-bolder text-dark">Datos del Procedimiento <small class="pl-2 text-danger"> *Campos requeridos</small></h3>
                        </div>
                    </div>
                    <procedimiento-card :procedimiento="{{ json_encode($procedimiento) }}"></procedimiento-card>
                </div>

            </div>
		</div>



    </div>
@endsection
@section('rutas')
<script>
    const getInstrumentos = "{{ route('panel.instrumentos.all') }}";
    const getMagnitudes = "{{ route('panel.magnitud.all') }}";
    const updateRoute = "{{ route('panel.procedimientos.update', isset($procedimiento) ? $procedimiento->id : 0) }}";
    const createRoute = `{{ route('panel.procedimientos.create') }}`
    const indexRoute = "{{ route('panel.procedimientos.index') }}";
    const storeRoute = "{{ route('panel.procedimientos.store') }}";
    const getPatron = "{{ route('panel.patrones.index') }}";
    const getEquipos = "{{ route('panel.equipos.index') }}";

    window.routes = {
        'getInstrumentos': getInstrumentos,
        'getMagnitudes': getMagnitudes,
        'getEquipos': getEquipos,
        'getPatron': getPatron,
        'create': createRoute,
        'update': updateRoute,
        'index': indexRoute,
        'store': storeRoute
    }
</script>
@endsection
