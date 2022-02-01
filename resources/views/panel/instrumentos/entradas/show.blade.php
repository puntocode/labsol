@extends('layouts.panel')

@section('title')Entrada de Instrumento |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="mb-8 card-label">Entrada de Instrumento <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.entrada-instrumentos.index') }}" class="as-text text-hover-primary" title="Ir a listado de clientes">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.entrada-instrumentos.create') }}" class="as-text text-hover-primary" title="Crear nuevo cliente">
                                        <i class="far fa-plus-square text-hover-primary"></i> Crear nuevo
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.entrada-instrumentos.print', $entradaInstrumento) }}" class="as-text text-hover-primary" title="Crear nuevo cliente">
                                        <i class="fas fa-print text-hover-primary"></i> Imprimir
                                    </a>
                                </li>


                                {{-- <li>
                                    <a href="#!" class="as-text text-hover-primary" title="Eliminar registro actual">
                                        <i class="fas fa-trash-alt text-hover-primary"></i>
                                        Eliminar
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom px-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder">Entrada de Instrumento #{{ $entradaInstrumento->id }}</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <x-entrada-instrumento-cliente :data=$entradaInstrumento></x-entrada-instrumento-cliente>

                        <certificados-edit :expedientes="{{ $expedientes }}"></certificados-edit>

                        <div class="mt-6 row">
                            <div class="col-12"><hr></div>
                            <div class="form-group col-md-9">
                                <label>Obs General</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{!! $entradaInstrumento->obs_general == null ? '-' : $entradaInstrumento->obs_general !!}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Tipo</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="badge badge-primary">{{ $entradaInstrumento->type }}</span>
                                </div>
                            </div>

                            @if ($entradaInstrumento->type == 'LS')
                                <div class="form-group col-md-5">
                                    <label>Recibido Por</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $entradaInstrumento->user->fullname }}</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Entregado por</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $entradaInstrumento->delivered }}</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>CI N°</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $entradaInstrumento->identification }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>

        </div>
    </div>
@endsection

@section('rutas')
<script>
    const expIndex = "{{ route('panel.expedientes.index') }}";

    window.routes = {
        'expIndex': expIndex,
    }
</script>
@endsection




