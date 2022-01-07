@extends('layouts.panel')

@section('title')Salida de Instrumento |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Salida de Instrumento <small class="font-weight-lighter">| Ficha</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.egreso.index') }}" class="as-text text-hover-primary" title="Ir a listado">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.egreso.create') }}" class="as-text text-hover-primary" title="Crear nuevo">
                                        <i class="far fa-plus-square text-hover-primary"></i> Crear nuevo
                                    </a>
                                </li>

                                <li class="mb-5">
                                    <hr>
                                    <a href="{{ route('panel.egreso.print', $entradaInstrumento) }}" class="as-text text-hover-primary" title="Imprimir">
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
                    <div class="card-body">
                        <h3>Datos del Cliente</h3>
                        <hr>
                        <div class="row mb-4">
							<div class="form-group col-md-7">
								<label>Cliente</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->name }}</span>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label>RUC</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->ruc }}</span>
								</div>
							</div>

							<div class="form-group col-md-7">
								<label>Contacto</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->contact[0]['nombre'] }}</span>
								</div>
							</div>
							<div class="form-group col-md-5">
								<label>Teléfono</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->contact[0]['telefono'] }}</span>
								</div>
							</div>
							<div class="form-group col-md-7">
								<label>Dirección</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->contact[0]['direccion'] }}</span>
								</div>
							</div>

							<div class="form-group col-md-5">
								<label>Email</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $entradaInstrumento->cliente->contact[0]['email'] }}</span>
								</div>
							</div>
						</div>

                        <h3>Datos de Entrada</h3>
                        <hr>

                        <div class="row mb-4">
                            <div class="form-group col-md-7">
                                <label>Fecha de Recepción</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ date('d/m/Y H:i:s', strtotime($entradaInstrumento->getRawOriginal('created_at'))) }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-5">
                                <label>Entregado por (Nombre)</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $entradaInstrumento->delivered }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-7">
                                <label>Recibido por</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $entradaInstrumento->user->fullname }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-5">
                                <label>Entregado por (C.I.)</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $entradaInstrumento->identification }}</span>
                                </div>
                            </div>

                            <div class="form-group col-md-7">
                                <label>Observación</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $entradaInstrumento->obs_general ?? '-'}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 table-responsive">
                                <table class="table table-separate">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>N°. Exped</th>
                                            <th>Certificado</th>
                                            <th>RUC</th>
                                            <th>Direccion</th>
                                            <th>Equipo</th>
                                            <th>Servicio</th>
                                            {{-- <th>Estado</th> --}}
                                            <th>Prioridad</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expedientesIngresados as $expediente)
                                            <tr>
                                                <td>{{ $expediente->number }}</td>
                                                <td>{{ $expediente->certificate }}</td>
                                                <td>{{ $expediente->certificate_ruc }}</td>
                                                <td>{{ $expediente->certificate_adress }}</td>
                                                <td>{{ $expediente->instrumentos->name }}</td>
                                                <td>{{ $expediente->service }}</td>
                                                {{-- <td>
                                                    <span class="mt-2 ml-5 badge ml-md-0 mt-md-0 badge-{{ $expediente->estados->color }}">
                                                        {{ $expediente->estados->name }}
                                                    </span>
                                                </td> --}}
                                                <td>
                                                    <span class="mt-2 ml-5 badge ml-md-0 mt-md-0 badge-{{ $expediente->prioridad['color'] }}">
                                                        {{ $expediente->priority }}
                                                    </span>
                                                </td>
                                                <td>{{ $expediente->obs }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h3>Historial de Salidas</h3>
                        <hr>

                        @foreach ($entradaInstrumento->egresoInstrumentos as $egresoInstrumento)
                            <div class="row mb-4">
                                <div class="form-group col-md-7">
                                    <label>Fecha de Retiro</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->created_at->format('d/m/Y H:i:s') }}</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-5">
                                    <label>Tipo de Retiro</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->tipo_retiro }}</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-7">
                                    <label>Entregado por</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->entregadoPor->fullname }}</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-5">
                                    <label>Recibido por (Nombre)</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->recibido_por }}</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-7">
                                    <label>Observaciones</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->observaciones ?? '-'}}</span>
                                    </div>
                                </div>

                                <div class="form-group col-md-5">
                                    <label>Recibido por (C.I.)</label>
                                    <div class="h-auto p-0 border-0 form-control">
                                        <span class="font-weight-bold">{{ $egresoInstrumento->identificacion }}</span>
                                    </div>
                                </div>


                            </div>

                            <div class="row mb-4">
                                <div class="col-12 table-responsive">
                                    <table class="table table-separate">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>N°. Exped</th>
                                                <th>Certificado</th>
                                                <th>RUC</th>
                                                <th>Direccion</th>
                                                <th>Equipo</th>
                                                <th>Servicio</th>
                                                {{-- <th>Estado</th> --}}
                                                <th>Prioridad</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($egresoInstrumento->detalleEgresoInstrumentos->pluck('expediente') as $expediente)
                                                <tr>
                                                    <td>{{ $expediente->number }}</td>
                                                    <td>{{ $expediente->certificate }}</td>
                                                    <td>{{ $expediente->certificate_ruc }}</td>
                                                    <td>{{ $expediente->certificate_adress }}</td>
                                                    <td>{{ $expediente->instrumentos->name }}</td>
                                                    <td>{{ $expediente->service }}</td>
                                                    {{-- <td>
                                                        <span class="mt-2 ml-5 badge ml-md-0 mt-md-0 badge-{{ $expediente->estados->color }}">
                                                            {{ $expediente->estados->name }}
                                                        </span>
                                                    </td> --}}
                                                    <td>
                                                        <span class="mt-2 ml-5 badge ml-md-0 mt-md-0 badge-{{ $expediente->prioridad['color'] }}">
                                                            {{ $expediente->priority }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $expediente->obs }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
