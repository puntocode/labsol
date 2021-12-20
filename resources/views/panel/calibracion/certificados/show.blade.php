@extends('layouts.panel')

@section('title')Certificado de Calibración |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
    <link rel="stylesheet" href="{{ asset('media/svg/icons/icomoon/style.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Card-->
        <h3 class="mb-8 card-label">Certificado de Calibración</h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.certificados.index') }}" class="as-text text-hover-primary" title="Ir a listado de clientes">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>


                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.calibracion.certificados.print', $expediente->id) }}" class="as-text text-hover-primary" title="Imprimir Certificado">
                                        <i class="fas fa-print text-hover-primary"></i> Imprimir
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom px-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder">Expediente {{ $expediente->number }}</h3>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>1. Solicitante</h3>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Solicitante</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->certificate }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>RUC</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->certificate_ruc }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Dirección</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->certificate_adress }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>2. Datos del Equipo Calibrado</h3>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Instrumento</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->instrumentos->name }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>N° de Serie</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->nro_serie }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Identificación</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->identificacion }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Intervalo</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">
                                        {{"
                                            {$expediente->calibracion->intervalo_desde}
                                            {$expediente->calibracion->intervalo_medida}
                                            a {$expediente->calibracion->intervalo_hasta}
                                            {$expediente->calibracion->intervalo_medida}
                                        "}}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Marca</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->marca }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>{{ $expediente->calibracion->tipo === 'DIGITAL' ? 'Resolución' : 'División' }}</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->resolucion }} {{$expediente->calibracion->resolucion_medida }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Modelo</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->modelo }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tipo</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->tipo }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>3. Patrones utilizados</h3>
                            </div>

                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="text-center">Identificación</th>
                                        <th scope="col" class="text-center">Descripción</th>
                                        <th scope="col" class="text-center">Certificado</th>
                                        <th scope="col" class="text-center">Próx. Calibración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patrones as $patron)
                                        <tr>
                                            <td>{{ $patron->code }}</td>
                                            <td>{{ $patron->description }}</td>
                                            <td>{{ $patron->certificate }}</td>
                                            <td>{{ $patron->next_calibration }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>4. Datos de Calibración</h3>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Procedimiento</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->instrumentos->procedimiento[0]->code }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Lugar de Calibración</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->lugar }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fecha de Calibración Inicial</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->fecha_inicio }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fecha de Calibración Final</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->fecha_fin }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Temperatura Inicial</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_inicial }} °C</span>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Temperatura Final</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_final }} °C</span>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Humedad Relativa Inicial</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->humedad_inicial }} %</span>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label>Temperatura Relativa Final</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->temperatura_final }} %</span>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Observaciones</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->obs }} %</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>5. Resultados</h3>
                            </div>

                            <div class="col-md-6 max-auto">

                            </div>
                        </div>

                        <div class="mt-6 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>6. Responsables</h3>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Realizado por</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->realizado }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Autorizado por</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->calibracion->autorizado }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Observaciones Generales</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $expediente->entradaInstrumentos->obs_general }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 mb-18 row">
                            <div class="col-12 border-bottom border-primary mb-6">
                                <h3>Acciones</h3>
                            </div>

                            <estado-calibracion
                                :expediente_id="{{ $expediente->id }}"
                                :estado="{{ $expediente->estados }}">
                            </estado-calibracion>
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
    const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";

    window.routes = {
        'updateEstado': ESTADO_EXPEDIENTE,
    }
</script>
@endsection




