@extends('layouts.panel')

@section('title')Patrones |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">Patrones <small class="font-weight-lighter">| {{ (isset($patrone)) ? 'Editar' : 'Crear' }}</small> </h3>


		<div class="row">
			<div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        @if (isset($patrone))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.patrones.show', $patrone) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
                                    <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al Patrón
                                </a>
                                <hr>
                            </div>

                            <div class="flex-grow-1">
                                <a href="{{ route('panel.patrones.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Patrón
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
                            <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas {{ (isset($patrone)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-lg-9 col-xl-10">
                <div class="card card-custom card-step mb-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="card-title font-weight-bolder text-dark">Datos de patrón <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                            <hr>
                        </div>
                    </div>
                    <patron-card id="{{ isset($patrone) ? $patrone->id : 0 }}"></patron-card>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const showRoute        = '{{ route('panel.patrones.show', isset($patrone) ? $patrone->id : 0) }}'
        const updateRoute      = '{{ route('panel.patrones.update', isset($patrone) ? $patrone->id : 0) }}'
        const getPatron        = '{{ route('panel.patron.get', isset($patrone) ? $patrone->id : 0) }}'
        const procedimientos   = '{{ route('panel.procedimientos.index') }}'
        const formularios      = '{{ route('panel.formularios.index') }}'
        const alertCalibration = '{{ route('panel.alert.calibration') }}'
        const createRoute      = '{{ route('panel.patrones.create') }}'
        const indexRoute       = '{{ route('panel.patrones.index') }}'
        const storeRoute       = '{{ route('panel.patrones.store') }}'
        const patronCondition  = '{{ route('panel.condition.all') }}'
        const patronMagnitud   = '{{ route('panel.magnitud.all') }}'

        window.routes = {
            'show': showRoute,
            'store': storeRoute,
            'index': indexRoute,
            'update': updateRoute,
            'create': createRoute,
            'getPatron': getPatron,
            'formularios': formularios,
            'magnitud': patronMagnitud,
            'condition': patronCondition,
            'alertCal': alertCalibration,
            'procedimientos': procedimientos,
        }
    </script>
@endsection
