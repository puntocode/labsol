@extends('layouts.panel')

@section('title')IDE |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="mb-8 card-label">IDE <small class="font-weight-lighter">| {{ $patron->code }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patron_ide.show', $patron->id) }}" class="as-text text-hover-primary" title="Volver al Detalle IDE">
                                <i class="mr-2 fas fa-arrow-left text-hover-primary"></i> Detalles IDE
                            </a>
                            <hr>
                        </div>

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
                    <div class="card-body">
                        <div class="px-4 row">
                            <div class="px-0 col-12 d-flex justify-content-between">
                                <h4>Patron: <span class="text-black-50">{{ $patron->code }}</span></h4>
                                <span>Magnitud <span class="ml-2 badge badge-primary font-weight-bold">{{ $patron->magnitude->name }}</span></span>
                            </div>
                            <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                                <h4 class="font-bold w-100">Editar IDE</h4>
                            </div>
                        </div>

                        <magnitud-form :data="{{ $patronIde }}" :patron="{{ $patron }}"></magnitud-form>

                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection


@section('rutas')
    <script>
        const unidadesIde = "{{ route('panel.patrones.unidades_medidas') }}";
        const actualizar = "{{ route('panel.patrones-ide.update', $patronIde->id) }}";
        const patronIdeShow = "{{ route('panel.patron_ide.show', $patron->id) }}";
        const patronIdeRank = "{{ route('panel.ide_rango.index') }}";

        window.routes = {
            'ideRank': patronIdeRank,
            'actualizar': actualizar,
            'unidades_ide': unidadesIde,
            'patronIdeShow': patronIdeShow
        }
    </script>
@endsection
