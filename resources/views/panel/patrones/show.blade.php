@extends('layouts.panel')

@section('title')Patron |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="card-label mb-8">Patron <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="list-unstyled px-0">
                                <li class="mb-5">
                                    <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patron">
                                        <i class="fas fa-arrow-left text-hover-primary mr-2"></i>  Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.hojaVida', $patrone->id) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="far fa-file-alt text-hover-primary mr-2"></i> Ver Hoja de Vida
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.calibration-history', [$patrone, 0]) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Calibración
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.maintenance-history', [$patrone, 0]) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Historial de Mantenimiento
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.doc', $patrone) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Cargar Documentos
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.create') }}" class="as-text text-hover-primary" title="Crear nuevo patron">
                                        <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Patrón
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.destroy', $patrone) }}" class="as-text text-hover-primary" title="Crear nuevo patron">
                                        <i class="fas fa-trash text-hover-primary mr-2"></i> Eliminar Patrón
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
                                <div class="tab-pane fade show active" id="tab_datos" role="tabpanel" aria-labelledby="tab_datos">
                                    <div class="card card-custom gutter-b card-stretch shadow-none">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label>Identificación</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->code }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Descripcion</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->description }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Marca</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->brand }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row mt-3">
                                                <div class="form-group col-md-3">
                                                    <label>Nr. de Certificado</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->certificate_no }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Estado</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="badge badge-primary font-weight-bold text-uppercase">{{ $patrone->condition->name }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Magnitud</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="badge badge-info font-weight-bold">{{ $patrone->magnitude->name }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label>Alerta de Calibración</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="badge badge-danger font-weight-bold">{{ $patrone->alertaCalibracion()  }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>


                                            <div class="row mt-3">
                                                <div class="form-group col-md-4">
                                                    <label>Periodo de Calibración</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->calibration_period }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Última Calibración</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->last_calibration }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Próxima Calibración</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        <span class="font-weight-bold">{{ $patrone->next_calibration }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="form-group col-md-4">
                                                    <label>Rango</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        @foreach ($patrone->rank as $rank)
                                                            <span class="font-weight-bold">{{ $rank  }}</span> <br>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Precisión</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        @foreach ($patrone->precision as $precision)
                                                            <span class="font-weight-bold">{{ $precision['title'] == 'precision' ? '' : $precision['title']  }}</span><br>
                                                            @foreach ($precision['value'] as $value)
                                                                {{ $value }} <br>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label>Error Máximo</label>
                                                    <div class="form-control p-0 border-0 h-auto">
                                                        @foreach ($patrone->error_max as $error)
                                                            <span class="font-weight-bold">{{ $error['title'] == 'error' ? '' : $error['title']  }}</span><br>
                                                            @foreach ($error['value'] as $value)
                                                                {{ $value }} <br>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <hr>
                                                    <a href="{{ route('panel.patrones.edit', $patrone->id) }}" class="btn btn-primary">Editar datos</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                            <td>{{ $history->calibration }}</td>
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
                                                               <a href="{{ route('panel.patron.calibration-history', [$patrone, $history->id]) }}" title="Editar registro">
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

                                <div class="tab-pane fade" id="tab_expedientes" role="tabpanel" aria-labelledby="tab_expedientes">
                                    <div class="col-12">
                                        <!--begin: Datatable-->
                                        <table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Descripción / Verificación</th>
                                                    <th>Motivo</th>
                                                    <th>F. de Realización</th>
                                                    <th>Realizado por</th>
                                                    <th>Observaciones</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($historyMaintenance as $key => $history)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>{{ $history->description }}</td>
                                                        <td>{{ $history->reason }}</td>
                                                        <td>{{ $history->maintenance_date }}</td>
                                                        <td>{{ $history->done }}</td>
                                                        <td>{{ $history->obs }}</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('panel.patron.maintenance-history', [$patrone, $history->id]) }}" title="Editar registro">
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
                                </div>

                                <div class="tab-pane fade" id="tab_documentos" role="tabpanel" aria-labelledby="tab_documentos">
                                    <list-doc :documents="{{ json_encode($documentos) }}"></list-doc>
                                    {{-- @include('layouts.partials.extras.items.documentos_for', $documentos) --}}
                                </div>
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
