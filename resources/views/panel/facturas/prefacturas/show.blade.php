@extends('layouts.panel')

@section('title')Facturación |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Planilla de Liquidación</h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.facturas.prefacturas.create') }}" class="as-text text-hover-primary" title="Ir a listado de clientes">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>

                                <li class="mb-5">
                                    Total: <span class="total font-bold">{{ Helper::currencyFormat($prefactura->total) }}</span>
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
                            <h3 class="card-title font-weight-bolder">Planilla de Liquidación</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
							<div class="form-group col-md-6">
								<label>Cliente</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $prefactura->cliente->name }}</span>
								</div>
							</div>

                            <div class="form-group col-md-6">
								<label>Código</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $prefactura->cliente->code }}</span>
								</div>
							</div>

							<div class="form-group col-md-6">
								<label>RUC</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $prefactura->cliente->ruc }}</span>
								</div>
							</div>


							<div class="form-group col-md-6">
								<label>Planilla de Liquidación N°:</label>
								<div class="h-auto p-0 border-0 form-control">
									<span class="font-weight-bold">{{ $prefactura->id }}</span>
								</div>
							</div>
						</div>

                        <div class="mt-8 row">
                            <div class="col-12 table-responsive">
                                <table class="table table-separate">
                                    <thead class="thead-light">
                                            <th>Sector</th>
                                            <th>Instrumento</th>
                                            <th>Tag Nuevo</th>
                                            <th>N°. Exped</th>
                                            <th class="w-125px">Costo</th>
                                            <th class="w-150px">Certificado Enviado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prefactura->prefacturaDetalles as $prefacturaDetalle)
                                            <tr>
                                                <td>{{ $prefacturaDetalle->sector }}</td>
                                                <td>{{ $prefacturaDetalle->expediente->instrumentos->name }}</td>
                                                <td>{{ $prefacturaDetalle->expediente->calibracion->identificacion }}</td>
                                                <td>{{ $prefacturaDetalle->expediente->number }}</td>
                                                <td>{{ Helper::currencyFormat($prefacturaDetalle->costo) }}</td>
                                                <td>{{ $prefacturaDetalle->expediente->fecha_envio_certificado ?: '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <label>Observación</label>
                                <div class="h-auto p-0 border-0 form-control">
                                    <span class="font-weight-bold">{{ $prefactura->observacion }}</span>
                                </div>
                            </div>

                            <div class="col-6 text-right">
                                <p class="h4">Costo Total: <span class="total font-bold">{{ Helper::currencyFormat($prefactura->total) }}</span></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
