@extends('layouts.panel')

@section('title')Patron |@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Patron <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.patrones.index') }}" class="as-text text-hover-primary" title="Ir a listado de patron">
                                        <i class="mr-2 fas fa-arrow-left text-hover-primary"></i>  Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.hojaVida', $patrone->id) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="mr-2 far fa-file-alt text-hover-primary"></i> Ver Hoja de Vida
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.calibration-history', [$patrone, 0]) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Historial de Calibración
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patron.maintenance-history', [$patrone, 0]) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Historial de Mantenimiento
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.doc', $patrone) }}" class="as-text text-hover-primary" title="Ver Hoja de Vida">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Cargar Documentos
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.create') }}" class="as-text text-hover-primary" title="Crear nuevo patron">
                                        <i class="mr-2 far fa-plus-square text-hover-primary"></i> Nuevo Patrón
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.patrones.destroy', $patrone) }}" class="as-text text-hover-primary" title="Crear nuevo patron">
                                        <i class="mr-2 fas fa-trash text-hover-primary"></i> Eliminar Patrón
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

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_ide">
                                        <span class="nav-text">IDE</span>
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="px-0 card-body">

                            <div class="tab-content">

                                {{-- tab datos generales -----------------------------------------------------------------------------------------------}}
                                <div class="tab-pane fade show active" id="tab_datos" role="tabpanel" aria-labelledby="tab_datos">
                                    <div class="shadow-none card card-custom gutter-b card-stretch">
                                        <div class="card-body">
                                            @include('layouts.partials.patrones_equipos.datos_generales', ['data' => $patrone])
                                            <div class="row">
                                                <div class="text-right col-md-12">
                                                    <hr>
                                                    <a href="{{ route('panel.patrones.edit', $patrone->id) }}" class="btn btn-primary">Editar datos</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- tab historial calibracion -------------------------------------------------------------------------------------}}
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
                                                        <tr id="calibration-{{ $history->id }}">
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $history->certificate_no }}</td>
                                                            <td>{{ $history->done }}</td>
                                                            <td>{{ $history->calibration }}</td>
                                                            <td>{{ $history->next_calibration }}</td>
                                                            <td>{{ $history->obs }}</td>
                                                            <td class="text-center">
                                                                @if (isset($history->certificate))
                                                                    <a href="{{ $history->getUrlCertificate() }}" target="_blank"><i class="pr-2 far fa-file-alt text-primary"></i> Ver Certificado</a>
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                               <a href="{{ route('panel.patron.calibration-history', [$patrone, $history->id]) }}" title="Editar registro">
                                                                   <i class="la la-edit text-primary"></i>
                                                               </a>
                                                               <eliminar-historial
                                                                    ruta="{{ route('panel.history-calibration.destroy', $history->id) }}"
                                                                    titulo="calibration-{{ $history->id }}">
                                                                </eliminar-historial>
                                                           </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                               </table>
                                        </div>
                                    </div>
                                </div>


                                {{-- tab historial mantenimiento -------------------------------------------------------------------------------------}}
                                <div class="tab-pane fade" id="tab_expedientes" role="tabpanel" aria-labelledby="tab_expedientes">
                                    <div class="col-12">
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
                                                    <tr id="maintenance-{{ $history->id }}">
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
                                                            <eliminar-historial
                                                                ruta="{{ route('panel.history-maintenance.destroy', $history->id) }}"
                                                                titulo="maintenance-{{ $history->id }}">
                                                            </eliminar-historial>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                {{-- tab documentos ------------------------------------------------------------------------------------------------------}}
                                <div class="tab-pane fade" id="tab_documentos" role="tabpanel" aria-labelledby="tab_documentos">
                                    <list-doc :alldocs="{{ json_encode($documentos) }}" ruta="{{ route('panel.document.destroy') }}"></list-doc>
                                </div>


                                {{-- tab ide ------------------------------------------------------------------------------------------------------------}}
                                <div class="tab-pane fade" id="tab_ide" role="tabpanel" aria-labelledby="tab_ide">
                                    <div class="px-4 row">
                                        <div class="px-0 col-12 d-flex justify-content-between">
                                            <h4>Patron: <span class="text-black-50">{{ $patrone->code }}</span></h4>
                                            <span>Magnitud
                                                @foreach ($patrone->magnitude as $magnitud)
                                                    <span class="badge badge-primary font-weight-bold">{{ $magnitud->name }}</span>
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                                            <h4 class="font-bold w-100">Magnitudes</h4>
                                        </div>
                                    </div>

                                    @if (count($ide))
                                        <x-ide :data="$ide" :tipo="$patrone->type"></x-ide>
                                    @else
                                        <div class="mt-10 row">
                                            <div class="text-center col-12">
                                                <h3>-- No exiten magnitudes cargadas --</h3>
                                                <hr>
                                            </div>
                                        </div>
                                    @endif


                                    @if (count($ensayos))
                                        <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                                            <h4 class="font-bold w-100">Ensayos</h4>
                                        </div>
                                        <x-ensayo :data="$ensayos"></x-ensayo>

                                    @endif

                                    <div class="row">
                                        <div class="mt-8 text-center col-12">
                                            <a href="{{ route('panel.patron.ide.form', $patrone->id) }}" class="btn btn-primary">Cargar Magnitudes</a>
                                            <a href="{{ route('panel.patron.ensayo.form', $patrone->id) }}" class="btn btn-info">Cargar Ensayos</a>
                                        </div>
                                    </div>
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
