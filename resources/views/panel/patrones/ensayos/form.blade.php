@extends('layouts.panel')

@section('title')Ensayos |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="mb-8 card-label">Ensayos <small class="font-weight-lighter">| {{ $patron->code }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.show', $patron) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
                                <i class="mr-2 fas fa-arrow-left text-hover-primary"></i> Ir al Patrón
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="mr-2 fas fa-list text-hover-primary"></i> Ir a la Lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-lg-9 col-xl-10">
                <div class="mb-5 card card-custom card-step">
                    <div class="border-0 card-header">
                        <div class="pt-8 card-title border-bottom w-100">
                            <h3 class="card-title font-weight-bolder text-dark">Cargar Ensayos <small class="pl-2 text-danger"> *Campos requeridos</small></h3>
                            <hr>
                        </div>
                    </div>
                    <patron-ensayo :data="{{ $patron }}"></patron-ensayo>
                </div>
            </div>
		</div>
	</div>
@endsection


@section('rutas')
    <script>
        const store = "{{ route('panel.patron.ensayo.store') }}";
        const index = "{{ route('panel.patron.ensayo.update' ) }}";
        const showPatron = "{{ route('panel.patrones.show', $patron->id) }}";
        const unidadesIde = "{{ route('panel.patrones.unidades_medidas') }}";

        window.routes = {
            'show': showPatron,
            'index': index,
            'store': store,
            'unidades_ide': unidadesIde,
        }
    </script>
@endsection
