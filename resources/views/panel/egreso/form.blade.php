@extends('layouts.panel')

@section('title')Salida de Instrumento |@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/partials/partials.css') }}">
@endsection


@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <h3 class="mb-8 card-label">Salida de Instrumento <small class="font-weight-lighter">| Crear</small></h3>
        <div class="row">
            <div class="col-lg-3 col-xl-2">
                <div class="card card-custom card-fixed gutter-b">
                    <div class="card-body ">
                        <div class="flex-grow-1">
                            <ul class="px-0 list-unstyled">
                                <li class="mb-5">
                                    <a href="{{ route('panel.egreso.create') }}" class="as-text text-hover-primary" title="Ir a listado">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
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
                            <h3 class="card-title font-weight-bolder">Salida de Instrumento</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
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

						<form class="mb-5" autocomplete="off" method="POST" action="{{ route('panel.egreso.store') }}">
							{{ csrf_field() }}

							<div class="mt-8 row">
								<div class="col-12 table-responsive">
									<table class="table table-separate">
										<thead class="thead-light">
											<tr>
												<th id="check-all">Todos</th>
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
											@foreach ($expedientes as $expediente)
												<tr>
													<td><input type="checkbox" name='expedientes[]' value="{{ $expediente->id }}" class="chk"></td>
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

							<div class="text-right col-12">
								<hr>
								<button type="button" class="btn btn-secondary" id="uncheck-all">Limpiar</button>
								<button type="button" class="btn btn-primary" id="dar-salida">Dar Salida</button>

								@error('expedientes')
									<br>
									<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
								@enderror
							</div>

							<div class="modal fade" id="modal-salida" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header bg-primary rounded-0">
											<h5 class="text-white modal-title" id="modal-label">Salida de Instrumento</h5>
										</div>

										<div class="modal-body">
											<div class="row">

												<div class="col-12">
													<div class="form-group">
														<label>Fecha:</label>
														<input class="form-control" value="{{ now()->format('d-m-Y') }}" disabled/>
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Entregado por: <span class="text-danger">*</span></label>
														<select class="form-control" name="entregado_por" required>
															<option value="">Seleccione una opción</option>
															@foreach ($usuarios as $usuario)
																<option value="{{ $usuario->id }}"
																	{{ old('entregado_por')==$usuario->id ? 'selected' : '' }}>
																	{{ $usuario->fullname }}
																</option>
															@endforeach
														</select>

														@error('entregado_por')
															<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
														@enderror
													</div>
												</div>

												<div class="col-12">
													<div class="form-group">
														<label>Recibido por: <span class="text-danger">*</span></label>
														<input class="form-control" name="recibido_por" value="{{ old('recibido_por') }}" required/>
													</div>
												</div>
												<div class="col-12">
													<div class="form-group">
														<label>C.I: <span class="text-danger">*</span></label>
														<input type="number" class="form-control" name="identificacion" value="{{ old('identificacion') }}" required/>
													</div>
												</div>



												<div class="col-12">
													<div class="form-group">
														<label>Observaciones</label>
														<textarea class="form-control" name="observaciones"></textarea>

														@error('observaciones')
															<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
														@enderror
													</div>
												</div>


											</div>
										</div>

										<div class="border-0 modal-footer justify-content-center">
											<button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" id="btn-cancelar">
												Cancelar
											</button>

											<button class="btn btn-primary font-weight-bold">
												Guardar
											</button>
										</div>

									</div>
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
	<script>

		$('#check-all').click(function(){
			$('[name="expedientes[]"]').prop('checked', true)
		})

		$('#uncheck-all').click(function(){
			$('[name="expedientes[]"]').prop('checked', false)
		})

		$('#dar-salida').click(function () {

			if ($('[name="expedientes[]"]:checked').length > 0) {
				$('#modal-salida').modal()
			} else {
				Swal.fire('Error', 'Debe seleccionar al menos un Expediente', 'error')
			}
		})

	</script>
@endsection
