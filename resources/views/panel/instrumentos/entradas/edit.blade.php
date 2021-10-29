@extends('layouts.panel')

@section('title')Entrada Instrumentos |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Entrada Instrumentos
            <small class="font-weight-lighter">| Editar General</small>
        </h3>

        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.entrada-instrumentos.show', $data['entrada']->id) }}" class="as-text text-hover-primary" title="Volver a la entrada de instrumento">
                                        <i class="mr-2 fas fa-arrow-left text-hover-primary"></i> Volver
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.entrada-instrumentos.index') }}" class="as-text text-hover-primary" title="Ir a listado de instrumentos">
                                        <i class="mr-2 fas fa-list text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10">
                <div class="mb-5 card card-custom">
                    <div class="card-header border-bottom">
                        <div class="py-4 card-title d-block ">
                            <h3 class="card-title font-weight-bolder text-dark">Entrada de Instrumento
                                <small class="ml-5"><span class="text-danger">*</span> Campos requeridos</small>
                            </h3>
                        </div>
                    </div>

                    <entrada-edit :data="{{ json_encode($data) }}"></entrada-edit>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @section('rutas')
    <script>
        const createRoute = `{{ route('panel.entrada-instrumentos.create') }}`;
        const indexRoute  = `{{ route('panel.entrada-instrumentos.index') }}`;
        const storeRoute  = `{{ route('panel.entrada-instrumentos.store') }}`;
        const showRoute   = `{{ route('panel.entrada-instrumentos.show', $data['id']) }}`;
        const updateRoute = "{{ route('panel.entrada-instrumentos.update', $data['id']) }}";

        window.routes = {
            'create': createRoute,
            'index': indexRoute,
            'show': showRoute,
            'store': storeRoute,
            'update': updateRoute,
        }
    </script>
@endsection --}}
