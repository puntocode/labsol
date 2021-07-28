@extends('layouts.panel')

@section('title')Servicio |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">Procedimientos <small class="font-weight-lighter">| {{ (isset($procedimiento)) ? 'Editar' : 'Crear' }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						@if (isset($procedimiento))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.procedimientos.show', $procedimiento) }}" class="as-text text-hover-primary" title="Ver detalles del procedimiento">
                                    <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al procedimiento
                                </a>
                                <hr>
                            </div>

                            <div class="flex-grow-1">
                                <a href="{{ route('panel.procedimientos.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo procedimiento
                                </a>
                                <hr>
                            </div>

                            {{-- <div class="flex-grow-1">
                                <a href="{{ route('panel.patrones.destroy', $patrone) }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="fas fa-trash text-hover-primary mr-2"></i> Eliminar Patrón
                                </a>
                                <hr>
                            </div> --}}
                        @endif

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas {{ (isset($procedimiento)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

            <div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="font-weight-bolder text-dark">Datos del Procedimiento <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                        </div>
                    </div>
                    <procedimiento-card id="{{ isset($procedimiento) ? $procedimiento->id : 0 }}"></procedimiento-card>
                </div>

            </div>
		</div>



    </div>
@endsection
@section('rutas')
<script>
    const getProcedimiento = `{{ route('panel.procedimientos.get', isset($procedimiento) ? $procedimiento->id : 0) }}`
    const showRoute = `{{ route('panel.procedimientos.show', isset($procedimiento) ? $procedimiento->id : 0) }}`
    const updateRoute = `{{ route('panel.procedimientos.update', isset($procedimiento) ? $procedimiento->id : 0) }}`
    const createRoute = `{{ route('panel.procedimientos.create') }}`
    const indexRoute = `{{ route('panel.procedimientos.index') }}`
    const storeRoute = `{{ route('panel.procedimientos.store') }}`
    const getPatron = `{{ route('panel.patrones.index') }}`
    const getInstrumentos = `{{ route('panel.instrumentos.all') }}`

    window.routes = {
        'show': showRoute,
        'store': storeRoute,
        'update': updateRoute,
        'index': indexRoute,
        'create': createRoute,
        'getProcedimiento': getProcedimiento,
        'getPatron': getPatron,
        'getInstrumentos': getInstrumentos,
    }
</script>
@endsection
