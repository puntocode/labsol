@extends('layouts.panel')

@section('title')Patron |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="card-label mb-8">Procedimientos <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled px-0">
                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.index') }}" class="as-text text-hover-primary" title="Ir a listado de procedimientos">
                                        <i class="fas fa-arrow-left text-hover-primary mr-2"></i>  Ir a listado
                                    </a>
                                </li>

                                <li><hr></li>

                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.create') }}" class="as-text text-hover-primary" title="Crear nuevo procedimiento">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Crear nuevo
                                    </a>
                                </li>

                                <li><hr></li>

                                <li class="mb-5">
                                    <a href="{{ route('panel.procedimientos.destroy', $procedimiento) }}" class="as-text text-hover-primary" title="Eliminar procedimiento">
                                        <i class="fas fa-trash text-hover-primary mr-2"></i> Eliminar procedimiento
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-9 col-xl-10">

                <div class="card card-custom">

                    <div class="card-header align-items-end">
                        <h3>Datos Generales</h3>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Código</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->code }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <label>Nombre</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->name }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-3">
                            <div class="form-group col-md-3">
                                <label>Revisión</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->revision }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Detentor</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->valve }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Vigencia</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->validity }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Alcance Acreditado</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="badge badge-{{$procedimiento->getAlcanceColor() }} font-weight-bold">{{ $procedimiento->accreditedScope() }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="row mt-3">
                            <div class="form-group col-md-12 mb-1">
                                <label>Instrumentos</label>
                            </div>

                            @forelse ($procedimiento->instrumento as $instrumento)
                                <div class="form-group col-md-3">
                                    <span class="font-weight-bold"><i class="fas fa-thermometer-empty"></i> {{ $instrumento->name }}</span>
                                </div>
                            @empty
                                <div class="col-12">
                                    <span class="font-weight-bold">-- No tiene ningun instrumento --</span>
                                </div>
                            @endforelse

                        </div>

                        {{-- <div class="row mt-4">
                            <div class="form-group col-md-4">
                                <label>Rango</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    @foreach ($procedimiento->rank as $rank)
                                        <span class="font-weight-bold">{{ $rank  }}</span> <br>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Resolución</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->resolution }}</span>
                                </div>
                            </div>


                            <div class="form-group col-md-4">
                                <label>Error Máximo</label>
                                <div class="form-control p-0 border-0 h-auto">
                                    <span class="font-weight-bold">{{ $procedimiento->error_max }}</span>
                                </div>
                            </div>

                        </div> --}}

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <hr>
                                <a href="{{ route('panel.procedimientos.edit', $procedimiento->id) }}" class="btn btn-primary">Editar datos</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            oTable = $('#tableFacturas, #tableExpedientes').DataTable({
                responsive: true,
                "bLengthChange": false
            });

            $('#tableInpuntSearch').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>
@endsection
