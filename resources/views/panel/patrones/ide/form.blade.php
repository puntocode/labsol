@extends('layouts.panel')

@section('title')Patrones |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="card-label mb-8">Patron <small class="font-weight-lighter">| {{ $patron->code }}</small> </h3>

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
                            <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas fa-list text-hover-primary mr-2"></i> Ir a la Lista
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
                    <patron-ide :data="{{ $patron }}"></patron-ide>
                </div>
            </div>
		</div>
	</div>
@endsection


@section('rutas')
    <script>
        const store = "{{ route('panel.patrones-ide.store') }}";
        const index = "{{ route('panel.patrones-ide.index' ) }}";
        const patronIde = "{{ route('panel.patron_ide.all', $patron->id) }}";
        const showPatron = "{{ route('panel.patrones.show', $patron->id) }}";
        const unidadesIde = "{{ route('panel.patrones.unidades_medidas') }}";

        window.routes = {
            'show': showPatron,
            'index': index,
            'store': store,
            'patronIde': patronIde,
            'unidades_ide': unidadesIde
        }
    </script>
@endsection
