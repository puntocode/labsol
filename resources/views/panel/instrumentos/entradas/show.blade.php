@extends('layouts.panel')

@section('title')Entrada de Instrumento |@endsection



@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label mb-8">Entrada de Instrumento <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled px-0">
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
                <div class="card card-custom">
                    <div class="card-header align-items-center">
                        <h3 class="pt-5">Datos Generales</h3>
                    </div>

                    @include('layouts.partials.print.entrada-instrumento-details')

                    <div class="card-footer" style="text-align: right">
                        <a href="" class="btn btn-primary">Editar Entrada</a>
                        {{-- <a href="" class="btn btn-info">Editar Expedientes</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection
