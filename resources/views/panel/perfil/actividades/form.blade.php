@extends('layouts.panel')

@section('title')Actividades |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Mis Actividades
			<small class="font-weight-lighter">
				@if($actividad != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$actividad->nro_expediente}} </strong>
				@else
				 	| Crear
				@endif
			</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.perfil.actividades.index')}}" class="as-text text-hover-primary" title="Ir a listado actividades">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if($actividad != NULL && \Auth::user()->hasRole('tecnico'))
									<li><hr></li>
									<li class="mb-5">
										<a href="#!" class="as-text text-hover-primary" title="Marcar actividad como iniciada" id="iniciar">
											<i class="far fa-play-circle text-hover-primary"></i>
											Iniciar
										</a>
									</li>

									<li class="mb-5">
										<a href="#modalEstadoActividad" class="as-text text-hover-primary" data-toggle="modal" data-target="#modalEstadoActividad" title="Marcar actividad como pausada">
											<i class="far fa-pause-circle text-hover-primary"></i>
											Pausar
										</a>
									</li>

									<li class="mb-5">
										<a href="#modalEstadoActividad" class="as-text text-hover-primary" data-toggle="modal" data-target="#modalEstadoActividad" title="Marcar actividad como suspendida">
											<i class="far fa-stop-circle text-hover-primary"></i>
											Suspender
										</a>
									</li>

									<li class="mb-5">
										<a href="#!" class="as-text text-hover-primary" data-toggle="modal" id="finalizar" title="Marcar actividad como finalizada">
											<i class="far fa-check-circle text-hover-primary"></i>
											Finalizar
										</a>
									</li>
									<li class="mb-5">
										<a href="#modalRechazado" class="as-text text-hover-primary" data-toggle="modal" id="rechazar" title="Marcar actividad como rechazada">
											<i class="far fa-times-circle text-hover-primary"></i>
											Rechazar
										</a>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
				<!--begin::Card-->
				<div class="card card-custom mb-5">
					<div class="card-header border-0">
						<div class="card-title pt-8 d-block">
							<h3 class="card-title font-weight-bolder text-dark">Información general</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($actividad != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>

					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $actividad != NULL ? route('panel.perfil.actividades.update', ($actividad->id -1)) : route('panel.perfil.actividades.store')}}">
							{{ csrf_field() }}
							@if ($actividad != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif

				            @if($actividad != NULL)
								<div class="row align-items-end">
									<div class="col-12 col-lg-3">
										<div class="form-group">
											<label class="d-block">Estado</label>
											<span class="badge {{$actividad->estado == 'activo' ? 'bg-success' : 'bg-gray-600'}}">{{$actividad->estado}}</span>
										</div>
									</div>
								</div>
							@endif

							<div class="row align-items-end">
								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Instrumento <span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="instrumento" value="{{$actividad->instrumento}}" readonly="" disabled>
									</div>
								</div>

								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Servicio <span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="servicio" value="{{$actividad->servicio}}" readonly="" disabled="">
									</div>
								</div>

								<div class="col-12">
									<ul class="nav nav-tabs nav-bold nav-tabs-line" role="tablist">
										<li class="nav-item mr-3">
											<a class="nav-link active" data-toggle="tab" href="#tab_general">
												<span class="nav-text font-weight-bold">General</span>
											</a>
										</li>
										<li class="nav-item mr-3">
											<a class="nav-link" data-toggle="tab" href="#tab_documentos">
												<span class="nav-text font-weight-bold">Documentos vinculados</span>
											</a>
										</li>
									</ul>

									<div class="tab-content pt-5 mt-5">
										<!--begin::Tab Content-->
										<div class="tab-pane active" id="tab_general" role="tabpanel">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group date" title="Fecha de inicio">
																<label>Fecha inicio <span class="text-danger">*</span> </label>
																<input type="text" class="form-control disabled" id="fechaInicio" readonly="readonly" required disabled="" value="{{$actividad->fecha_inicio}}" />
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group date" title="Hora de inicio">
																<label>Hora inicio</label>
																<input type="text" class="form-control disabled" id="horaInicio" readonly="readonly" disabled="" value="{{$actividad->hora_inicio}}" disabled="" />
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group date" title="Fecha fin">
																<label>Fecha fin</label>
																<input type="text" class="form-control disabled" id="fechaFin" readonly="readonly" disabled="" value="{{$actividad->fecha_fin}}" disabled="" />
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group date" title="Hora fin">
																<label>Hora fin</label>
																<input type="text" class="form-control disabled" id="horaFin" readonly="readonly" disabled="" value="{{$actividad->hora_fin}}" disabled="" />
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 border-l-lg">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label>Duracion</label>
																<input type="number" class="form-control disabled" name="duracion" value="4 horas" readonly="" disabled="">
															</div>
														</div>

														<div class="col-md-6 mb-lg-0 mb-6">
															<div class="form-group">
																<label>Prioridad</label>
																<input type="text" class="form-control disabled" name="prioridad" value="Normal" readonly="" disabled="">
															</div>
														</div>

													<div class="col-md-6 mb-lg-0 mb-6">
														<div class="form-group">
															<label>Repetición</label>
															<input type="text" class="form-control disabled" name="repeticion" value="Ninguna" readonly="" disabled="">
														</div>
													</div>
													</div>
												</div>

												<div class="col-12 mt-10">
													<div class="form-group">
														<label>Comentarios</label>
														<textarea class="form-control disabled" name="descripcion" readonly="" disabled="">Lorem ipsum dolor sit, amet, consectetur adipisicing elit. Sapiente, enim, veniam. Repellendus, obcaecati, minima corrupti molestiae, ut inventore quo consectetur fuga pariatur asperiores odit maiores in reiciendis quidem, nulla. Tenetur.
														</textarea>
													</div>
												</div>
											</div>
										</div>
										<!--end::Tab Content-->

										<!--begin::Tab Content-->
										<div class="tab-pane" id="tab_documentos" role="tabpanel">
											<div class="row">
												@foreach ($documentos as $documento)
													<div class="col-lg-6">
														<!--begin::Mixed Widget 7-->
														<div class="card card-custom gutter-b card-stretch border shadow">
															<!--begin::Body-->
															<div class="card-body">
																<div class="d-flex flex-wrap align-items-center py-1">
																	<i class="far {{ $documento->tipo == 'pdf' ? 'fa-file-pdf' : 'fa-file-excel'}} fa-2x text-primary mr-3"></i>
																	<!--begin:Title-->
																	<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
																		<a href="#" class="text-dark font-weight-bolder text-hover-primary">{{$documento->titulo}}</a>
																		<span class="text-muted font-weight-bold font-size-lg">{{$documento->fecha}}</span>
																	</div>
																	<div class="w-100">
																		<p class="mt-5 mb-0">{{$documento->descripcion}}</p>
																	</div>
																	<!--end:Title-->
																</div>
															</div>
															<!--end::Body-->
														</div>
														<!--end::Mixed Widget 7-->
													</div>
												@endforeach
											</div>
										</div>
										<!--end::Tab Content-->
									</div>
								</div>
							</div>

							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$actividad != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.perfil.actividades.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
								@endif
							</div>
						@if(!isset($view_mode) || $view_mode != 'readonly')
							</form>
						@else
							</div>
						@endif
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection

@section('modales')
	<div class="modal fade" id="modalEstadoActividad" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	        <div class="modal-content">
	            <div class="modal-header bg-primary rounded-0">
	                <h5 class="modal-title text-white" id="exampleModalLabel">Actualizar estado de actividad</h5>
	                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	                    <i aria-hidden="true" class="ki ki-close text-white"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	               <form action="#!">
		               	<div class="row">
		               		<div class="col-12 mt-10">
								<div class="form-group">
									<label>Comentarios</label>
									<textarea class="form-control" name="descripcion"></textarea>
								</div>
							</div>
		               	</div>
		            </form>
	            </div>
	            <div class="modal-footer justify-content-center border-0">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Guardar</button>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="modal fade" id="modalRechazado" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
	        <div class="modal-content">
	            <div class="modal-header bg-primary rounded-0">
	                <h5 class="modal-title text-white" id="exampleModalLabel">Especificar el motivo de rechazo</h5>
	                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	                    <i aria-hidden="true" class="ki ki-close text-white"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	               <form action="#!">
		               	<div class="row">
		               		<div class="col-12 mt-10">
								<div class="form-group">
									<label>Comentarios</label>
									<textarea class="form-control" name="descripcion"></textarea>
								</div>
							</div>
		               	</div>
		            </form>
	            </div>
	            <div class="modal-footer justify-content-center border-0">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Guardar</button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('scripts')
	<script>
		$('#iniciar').click(function (e) {
			Swal.fire("Estado de actividad", "La actividad ha sido marcada como iniciada", "success");
		});

		$('#finalizar').click(function (e) {
			Swal.fire("Estado de actividad", "La actividad ha sido marcada como finalizada", "success");
		});
	</script>
@endsection
