@extends('layouts.panel')

@section('title')Entrada de Instrumento |@endsection



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
                <div class="card card-custom">


                    <div class="card-body">
                        <div class="card-toolbar position-relative">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab_datos">
                                        <span class="nav-text">Datos Generales</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_expedientes">
                                        <span class="nav-text">Expedientes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="m-8 tab-content">
                            {{-- tab datos generales -----------------------------------------------------------------------------------------------}}
                            <div class="tab-pane fade show active " id="tab_datos" role="tabpanel" aria-labelledby="tab_datos">
                                {{-- @include('layouts.partials.print.entrada-instrumento-details') --}}
                                <x-entrada-instrumento-cliente :data=$entradaInstrumento></x-entrada-instrumento-cliente>

                                <div class="mt-8 row">
                                    <div class="col-12">
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Equipo</th>
                                                <th scope="col">Servicio</th>
                                                <th scope="col">Acciones</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($expedientesCantidad as $expediente)
                                                    <tr>
                                                      <th>{{ $expediente->cantidad }}</th>
                                                      <td>{{ $expediente->instrumentos->name }}</td>
                                                      <td>Calibración</td>
                                                      <td>
                                                          <a href="" title="Editar solo equipo"><i class="fas fa-thermometer-half text-info"></i></a>
                                                          <a href="" title="Editar solo certificado" class="mx-3"><i class="far fa-file-alt text-warning"></i></a>
                                                          <a href="" title="Editar ambos"><i class="fas fa-edit text-primary"></i></a>
                                                      </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="mt-6 row">
                                    <div class="col-12"><hr></div>
                                    <div class="form-group col-md-9">
                                        <label>Obs General</label>
                                        <div class="h-auto p-0 border-0 form-control">
                                            <span class="font-weight-bold">{{ $entradaInstrumento->obs_general == null ? '-' : $entradaInstrumento->obs_general }}</span>
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

                                <div class="row">
                                    <div class="mt-8 text-right col-12">
                                        <hr>
                                        <a href="{{ route('panel.entrada-instrumentos.edit', $entradaInstrumento) }}" class="btn btn-primary">Editar todas las entradas</a>
                                    </div>
                                </div>
                            </div>

                            {{-- tab expedientes ---------------------------------------------------------------------------------------------------}}
                            <div class="tab-pane fade show" id="tab_expedientes" role="tabpanel" aria-labelledby="tab_datos">
                                <x-entrada-instrumento-cliente :data=$entradaInstrumento></x-entrada-instrumento-cliente>

                                <div class="mt-8 row">
                                    <div class="col-12">
                                        <table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>N°. Exped</th>
                                                    <th>Certificado</th>
                                                    <th>RUC</th>
                                                    <th>Direccion</th>
                                                    <th>Equipo</th>
                                                    <th>Servicio</th>
                                                    <th>Estado</th>
                                                    <th>Prioridad</th>
                                                    <th>Observaciones</th>
                                                    <th class="text-center">Acciones</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($expedientes as $expediente)
                                                    <tr>
                                                        <td>{{ $expediente->number }}</td>
                                                        <td>{{ $expediente->certificate == null ? '-' : $expediente->certificate }}</td>
                                                        <td>{{ $expediente->certificate_ruc == null ? '-' : $expediente->certificate_ruc }}</td>
                                                        <td>{{ $expediente->certificate_adress == null ? '-' : $expediente->certificate_adress }}</td>
                                                        <td>{{ $expediente->instrumentos->name }}</td>
                                                        <td>{{ $expediente->service }}</td>
                                                        <td>
                                                            <span class="badge badge-{{ $expediente->estados->color }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                                {{ $expediente->estados->name }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-{{ $expediente->priority['color'] }} ml-5 ml-md-0 mt-2 mt-md-0">
                                                                {{ $expediente->priority['prioridad'] }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $expediente->obs }}</td>
                                                        <td class="text-center">
                                                            <a href="" title="Editar ambos"><i class="fas fa-edit text-primary"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(function() {
            oTable = $('#tableExpedientes').DataTable({
                responsive: true,
                "bLengthChange": false
            });
        });

    </script>
@endsection


