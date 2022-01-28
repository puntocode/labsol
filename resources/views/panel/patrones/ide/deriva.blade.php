@extends('layouts.panel')

@section('title')IDE |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
	<div class="container-fluid">
        <h3 class="mb-8 card-label">IDE <small class="font-weight-lighter">| {{ $deriva->patronIde->patron->code }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patron_ide.show', $deriva->patronIde->patron->id) }}" class="as-text text-hover-primary" title="Volver al Detalle IDE">
                                <i class="mr-2 fas fa-arrow-left text-hover-primary"></i> Detalles IDE
                            </a>
                            <hr>
                        </div>

                        <div class="flex-grow-1">
                            <a href="{{ route('panel.patrones.show', $deriva->patronIde->patron->id) }}" class="as-text text-hover-primary" title="Ver detalles del Patrón">
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
                                <h4>Patron: <span class="text-black-50">{{ $deriva->patronIde->patron->code }}</span></h4>
                                {{-- <span>Magnitud <span class="ml-2 badge badge-primary font-weight-bold">{{ $deriva->patronIde->patron->magnitude->name }}</span></span> --}}
                                <span>Magnitud
                                    @foreach ($deriva->patronIde->patron->magnitude as $magnitud)
                                        <span class="ml-2 badge badge-primary font-weight-bold">{{ $magnitud->name }}</span>
                                    @endforeach
                                </span>
                            </div>
                            <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                                <h4 class="font-bold w-100">Detalle Rango / Resolución</h4>
                            </div>
                        </div>

                        <deriva-form :data="{{ $deriva }}"></deriva-form>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const unidadesIde = "{{ route('panel.patrones.unidades_medidas') }}";
        const insertDeriva = "{{ route('panel.rango_deriva.insert') }}";
        const OCULTAR = "{{ route('panel.rango_deriva.ocultar') }}"

        window.routes = {
            'ruta_deriva': insertDeriva,
            'unidades_ide': unidadesIde,
            'ocultar': OCULTAR
        }
    </script>
@endsection
