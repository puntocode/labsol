@extends('layouts.panel')

@section('title')Incertidumbres |@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Incertidumbres <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.incertidumbre.index') }}" class="as-text text-hover-primary" title="Ir a listado">
                                        <i class="mr-2 fas fa-arrow-left text-hover-primary"></i>  Ir a listado
                                    </a>
                                    <hr>
                                </li>

                                <li class="mb-5">
                                    <a href="{{ route('panel.incertidumbre.create') }}" class="as-text text-hover-primary" title="Crear nuevo">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Crear nuevo
                                    </a>
                                    <hr>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom mb-5 px-5">

                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder">Datos de Incertidumbre</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Nombre</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->nombre }}</span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="mt-3 row">

                            <div class="form-group col-md-4">
                                <label>Contribución</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->contribucion }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Tipo</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->tipo }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Grados de Libertad</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->grados_libertad_for }}</span>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="mt-3 row">

                            <div class="form-group col-md-4">
                                <label>Distribución</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->distribucion }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Fórmula (Nombre)</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->formula }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Fórmula (Imagen)</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <img src="{{ asset("media/formulas/$incertidumbre->formula.jpg") }}" alt="{{ $incertidumbre->formula }}" width='64px'>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="mt-3 row">

                            <div class="form-group col-md-4">
                                <label>Fuente</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->fuente }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Divisor (Nombre)</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->divisor }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Coeficiente</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->coeficiente }}</span>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="mt-3 row">

                            <div class="form-group col-md-4">
                                <label>Contribución du</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $incertidumbre->contribucion_du }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="mt-6 row">
                            <div class="text-right col-md-12">
                                <hr>
                                <a href="{{ route('panel.incertidumbre.edit', $incertidumbre->id) }}" class="btn btn-primary">Editar datos</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
