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
                                    <a href="{{ route('panel.facturas.prefacturas.create') }}" class="as-text text-hover-primary" title="Ir a listado de liquidaciones">
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

						<form class="mb-5" id="form-agregar" method="POST" action="{{ route('panel.facturas.prefacturas.update', $prefactura) }}">
							@csrf
							@method('PUT')

							<div class="mt-8 row">
								<div class="col-12 table-responsive">
                                    <table class="table table-separate table-head-custom collapsed" id="tableDatalles" style="width:100%">
										<thead class="thead-light">
											<tr>
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
													<td>
														<input type="text" value="{{ $prefacturaDetalle->sector }}" class="form-control"
															name="sector-{{ $prefacturaDetalle->id }}">

														@error("sector-$prefacturaDetalle->id")
															<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
														@enderror
													</td>
													<td>{{ $prefacturaDetalle->expediente->instrumentos->name }}</td>
													<td>{{ $prefacturaDetalle->expediente->calibracion->identificacion }}</td>
													<td>{{ $prefacturaDetalle->expediente->number }}</td>
                                                    <td>
														<input type="number" class="form-control costo"
														value="{{ old("costo-$prefacturaDetalle->id", $prefacturaDetalle->costo) }}"
															name="costo-{{ $prefacturaDetalle->id }}">

														@error("costo-$prefacturaDetalle->id")
															<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
														@enderror
													</td>
													<td>{{ $prefacturaDetalle->expediente->fecha_envio_certificado ?: '' }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>

							<div class="row mt-4">
								<div class="form-group col-12">
									<label>Observación</label>
									<textarea class="form-control" name="observacion" rows="3">{{ old('observacion', $prefactura->observacion) }}</textarea>

									@error('observacion')
										<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
									@enderror
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-6">
									<p class="h4">Costo Total: <span class="total font-bold">{{ Helper::currencyFormat($prefactura->total) }}</span></p>
								</div>

								<div class="col-6 text-right">
									<button class="btn btn-success font-bold" name="guardar" value="1">Solo Guardar</button>
									<button class="btn btn-primary font-bold" name="cerrada" value="1">Guardar y Cerrar Planilla</button>

									@error('expedientes.*')
										<br>
										<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
									@enderror

									@error('expedientes')
										<br>
										<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
									@enderror
								</div>
							</div>

						</form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>

        $(function() {
            oTable = $('#tableDatalles').DataTable({
                responsive: true,
                "bLengthChange": false,
                paging: false
            });
        });

		let total = {{ $prefactura->total }}

		$('.costo').focusout(function () {

			if ($(this).val() < 0 || $(this).val() == '') {
				$(this).val(0)
			}

			total = 0
			$('.costo').each(function(){
				total += parseFloat($(this).val())
			});

			$('.total').html(total)
		})
	</script>
@endsection
