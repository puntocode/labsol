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
                                <span>Magnitud
                                    @foreach ($patron->magnitude as $magnitud)
                                        <span class="ml-2 badge badge-primary font-weight-bold">{{ $magnitud->name }}</span>
                                    @endforeach
                                </span>
                            </div>
                            <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                                <h4 class="font-bold w-100">Magnitudes</h4>
                            </div>
                        </div>

                        @if (count($ides))
                            <x-ide :data=$ides :tipo="$patron->type"></x-ide>
                        @else
                            <div class="mt-10 row">
                                <div class="text-center col-12">
                                    <h3>-- No exiten magnitudes cargadas --</h3>
                                    <hr>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="mt-4 text-center col-12">
                                <a href="{{ route('panel.patron.ide.form', $patron->id) }}" class="btn btn-primary">Cargar Magnitudes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
@endsection
