@extends('layouts.panel')

@section('title')Ficha Cliente |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label mb-8">Cliente <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled px-0">
                                <li class="mb-5">
                                    <a href="{{ route('panel.clientes.index') }}" class="as-text text-hover-primary"
                                        title="Ir a listado de clientes">
                                        <i class="fas fa-arrow-left text-hover-primary"></i>
                                        Ir a listado
                                    </a>
                                </li>

                                @if (in_array('crear', $role_actions))
                                    <li>
                                        <hr>
                                    </li>

                                    <li class="mb-5">
                                        <a href="{{ route('panel.clientes.create') }}" class="as-text text-hover-primary"
                                            title="Crear nuevo cliente">
                                            <i class="far fa-plus-square text-hover-primary"></i>
                                            Crear nuevo
                                        </a>
                                    </li>

                                @endif

                                @if ($cliente != null && in_array('eliminar', $role_actions))
                                    <li>
                                        <hr>
                                    </li>

                                    <li>
                                        <a href="#!" class="as-text text-hover-primary" title="Eliminar registro actual">
                                            <i class="fas fa-trash-alt text-hover-primary"></i>
                                            Eliminar
                                        </a>
                                    </li>
                                @endif
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
                                    <a class="nav-link" data-toggle="tab" href="#tab_facturacion">
                                        <span class="nav-text">Facturación</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_expedientes">
                                        <span class="nav-text">Expedientes</span>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <div class="card-body px-0">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab_datos" role="tabpanel"
                                    aria-labelledby="tab_datos">
                                    <div class="card card-custom gutter-b card-stretch shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap align-items-center py-1">
                                                <div class="row">

                                                    <div class="form-group col-md-2">
                                                        <label>Código</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $cliente->code }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label>Cliente</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $cliente->name }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>RUC</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $cliente->ruc }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-12 mt-4">
                                                        <h3>Contacto</h3>
                                                        <hr>
                                                    </div>

                                                    @foreach ($cliente->contact as $key => $contacto)
                                                        <div class="form-group col-md-6">
                                                            <label>Dirección</label>
                                                            <div class="form-control p-0 border-0 h-auto">
                                                                <span class="font-weight-bold">{{ $contacto['direccion'] }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>Nombre</label>
                                                            <div class="form-control p-0 border-0 h-auto">
                                                                <span class="font-weight-bold">{{ $contacto['nombre'] }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <div class="form-control p-0 border-0 h-auto">
                                                                <span class="font-weight-bold">{{ $contacto['email'] }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>Telefono</label>
                                                            <div class="form-control p-0 border-0 h-auto">
                                                                <span class="font-weight-bold">{{ $contacto['telefono'] }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-12">
                                                            <hr>
                                                        </div>
                                                    @endforeach


                                                    <div class="col-md-12 text-right">
                                                        <a href="{{ route('panel.clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar datos</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="tab_facturacion" role="tabpanel"
                                    aria-labelledby="tab_facturacion">
                                    <!--begin: Datatable-->
                                    <table class="table table-separate table-head-custom collapsed" id="tableFacturas"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Número</th>
                                                <th>Fecha de Emisión</th>
                                                <th>Estado</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facturas as $i => $factura)
                                                <tr>
                                                    <td>{{ $factura->numero }}</td>
                                                    <td>{{ $factura->fecha_emision }}</td>
                                                    <td>
                                                        <span class="badge
                              @if ($factura->estado == 'Abonada') badge-success
                                                        @else
                                                            badge-warning @endif
                                                            ml-5 ml-md-0 mt-2 mt-md-0">{{ $factura->estado }}
                                                        </span>

                                                    </td>
                                                    <td>{{ $factura->total }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>

                                <div class="tab-pane fade" id="tab_expedientes" role="tabpanel"
                                    aria-labelledby="tab_expedientes">
                                    <!--begin: Datatable-->
                                    <table class="table table-separate table-head-custom collapsed" id="tableExpedientes"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>N° Exp</th>
                                                <th>Instrumento</th>
                                                <th>Servicio</th>
                                                <th>Estado</th>
                                                <th>Prioridad</th>
                                                <th>Observaciones</th>
                                                <th>Técnico asignado</th>
                                                <th>Fecha de entrega</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expedientes as $i => $expediente)
                                                <tr>
                                                    <td>{{ $expediente->nro_expediente }}</td>
                                                    <td>{{ $expediente->instrumento }}</td>
                                                    <td>{{ $expediente->servicio }}</td>
                                                    <td>{{ $expediente->estado }}</td>
                                                    <td>
                                                        <span class="badge
                              @if ($expediente->prioridad == 'Estándar') badge-success
                                                        @else
                                                            badge-danger @endif
                                                            ml-5 ml-md-0 mt-2 mt-md-0">{{ $expediente->prioridad }}
                                                        </span>

                                                    </td>
                                                    <td>{{ $expediente->observaciones }}</td>
                                                    <td>{{ $expediente->tecnicos_asignados }}</td>
                                                    <td>{{ $expediente->fecha_entrega }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>
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
