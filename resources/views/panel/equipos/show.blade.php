@extends('layouts.panel')

@section('title')Equipo |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="card-label mb-8">Equipo <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled px-0">

                                <li class="mb-5">
                                    <a href="{{ route('panel.equipos.index') }}" class="as-text text-hover-primary" title="Ir a listado de equipo">
                                        <i class="fas fa-arrow-left text-hover-primary mr-2"></i>  Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipo.hojaVida', $equipo->id) }}" class="as-text text-hover-primary" title="Ver hoja de vida">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Ver hoja de Vida
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipo.calibration-history', [$equipo, 0]) }}" class="as-text text-hover-primary" title="Cargar/actualizar historial de Calibración">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Calibración
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipo.maintenance-history', [$equipo, 0]) }}" class="as-text text-hover-primary" title="Cargar/actualizar historial de Mantenimiento">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Mantenimiento
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipos.doc', $equipo) }}" class="as-text text-hover-primary" title="Cargar/Editar documentos">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Cargar Documentos
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipos.create') }}" class="as-text text-hover-primary" title="Crear nuevo equipo">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Crear nuevo
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.equipos.destroy', $equipo) }}" class="as-text text-hover-primary" title="Crear nuevo equipo">
                                        <i class="fas fa-trash text-hover-primary mr-2"></i> Eliminar Equipo
                                    </a>
                                </li>

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
                                    <a class="nav-link" data-toggle="tab" href="#tab_historial">
                                        <span class="nav-text">Historial de Calibración</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_expedientes">
                                        <span class="nav-text">Historial de Mantenimiento</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_documentos">
                                        <span class="nav-text">Documentos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body px-0">
                            <div class="tab-content">
                                <!--begin: Tab Datos-->
                                <div class="tab-pane fade show active" id="tab_datos" role="tabpanel" aria-labelledby="tab_datos">
                                    <div class="card card-custom gutter-b card-stretch shadow-none">
                                        <div class="card-body">

                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label>Identificación</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->code }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Descripcion</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->description }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Marca</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->brand }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Modelo</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->model }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Tipo</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->type }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Nr. de Serie</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->serie_number }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Ubicación</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->ubication }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Incertidumbre</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->uncertainty }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Tolerancia</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->tolerance }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label>Nr. de Certificado</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->certificate_no }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Procedimiento de Calibración</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->procedimiento_id > 0 ? $equipo->procedimientos->code : '-' }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4"></div>


                                                    <div class="form-group col-md-4">
                                                        <label>Estado</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="badge badge-primary font-weight-bold text-uppercase">{{ $equipo->condition->name }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Magnitud</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="badge badge-info font-weight-bold">{{ $equipo->magnitude->name }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Alerta de Calibración</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="badge badge-danger font-weight-bold">{{ $equipo->alertCalibration->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>


                                                <div class="row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label>Periodo de Calibración</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->periodo }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Última Calibración</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->last_calibration }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Próxima Calibración</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->next_calibration }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="form-group col-md-4">
                                                        <label>Rango</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            @foreach ($equipo->rank as $rank)
                                                                <span class="font-weight-bold">{{ $rank }}</span> <br>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Resolución</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->resolution }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-md-4">
                                                        <label>Error Máximo</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->error_max }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row mt-3">
                                                    <div class="form-group col-md-4">
                                                        <label>Código (Hoja de Vida)</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->headboard['codigo'] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Revisión</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->headboard['revision'] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label>Vigencia</label>
                                                        <div class="form-control p-0 border-0 h-auto">
                                                            <span class="font-weight-bold">{{ $equipo->headboard['vigencia'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <hr>
                                                        <a href="{{ route('panel.equipos.edit', $equipo->id) }}" class="btn btn-primary">Editar datos</a>
                                                    </div>
                                                </div>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <!--end: Tab Datos-->


                                <!--begin: Tab Historial Calibracion-->
                                <div class="tab-pane fade" id="tab_historial" role="tabpanel" aria-labelledby="tab_historial">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-separate table-head-custom collapsed" id="tableFacturas" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>N° de Certificado</th>
                                                        <th>Elaborado Por</th>
                                                        <th>F. de Calibración</th>
                                                        <th>Prox. Calibración</th>
                                                        <th>Obs.</th>
                                                        <th class="text-center">Certificado</th>
                                                        <th class="text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($historyCalibration as $key => $history)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $history->certificate_no }}</td>
                                                            <td>{{ $history->done }}</td>
                                                            <td>{{ $history->calibration?->toDateString() }}</td>
                                                            <td>{{ $history->next_calibration }}</td>
                                                            <td>{{ $history->obs }}</td>
                                                            <td class="text-center">
                                                                @if (isset($history->certificate))
                                                                    <a href="{{ $history->getUrlCertificate() }}" target="_blank"><i class="far fa-file-alt text-primary pr-2"></i> Ver Certificado</a>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                               <a href="{{ route('panel.equipo.calibration-history', [$equipo, $history->id]) }}" title="Editar registro">
                                                                   <i class="la la-edit text-primary"></i>
                                                               </a>
                                                               {{-- <table-delete url=""></table-delete> --}}
                                                           </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                               </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Tab-->


                                <!--begin: Tab Historial Mantenimiento-->
                                <div class="tab-pane fade" id="tab_expedientes" role="tabpanel" aria-labelledby="tab_expedientes">
                                    <table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo Mantenimiento</th>
                                                <th>F. de Mantenimiento</th>
                                                <th>Prox. Mantenimiento</th>
                                                <th>Realizado por</th>
                                                <th>Observaciones</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($historyMaintenance as $key => $history)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $history->description }}</td>
                                                    <td>{{ $history->maintenance_date }}</td>
                                                    <td>{{ $history->next_maintenance }}</td>
                                                    <td>{{ $history->done }}</td>
                                                    <td>{{ $history->obs }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('panel.equipo.maintenance-history', [$equipo, $history->id]) }}" title="Editar registro">
                                                            <i class="la la-edit text-primary"></i>
                                                        </a>
                                                        {{-- <table-delete url=""></table-delete> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end: Datatable-->
                                </div>
                                <!--end: Tab-->


                                <!--begin: Tab Documentos-->
                                <div class="tab-pane fade" id="tab_documentos" role="tabpanel" aria-labelledby="tab_documentos">
                                    <list-doc :documents="{{ json_encode($documentos) }}"></list-doc>
                                </div>
                                <!--end: Tab-->
                            </div>
                        </div>
                    </div>
                </div>
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
