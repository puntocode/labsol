Expedientes de Calibración
@extends('layouts.panel')

@section('title')Expedientes de Calibración |@endsection

@section('styles')
	@if($vista == 'calendario')
		<link href="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
	@elseif($vista == 'agenda')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endif
@endsection

@section('content')

{{--	<div class="container mb-2 mt-n5">
		<ul class="list-inline text-center mb-5 d-flex justify-content-center">
			<li class="px-5 list-inline-item py-2 px-1 d-flex align-items-center">
				<a href="#!" class="text-center text-dark" title="Técnicos disponibles">
					<i class="far fa-user d-block text-dark mb-2"></i>
					<span class="d-block">Técnicos</span>
				</a>
			</li>
		</ul>
	</div>--}}

	<div class="container-fluid">
		<h3 class="card-label mb-8">Agenda <small class="font-weight-lighter">| {{\Auth::user()->hasRole('tecnico') ? 'Mis actividades' : 'Expedientes de Calibración'}}</small></h3>
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<div class="card card-custom card-stretch gutter-b">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5 mb-5">
						<h3 class="card-title font-weight-bolder text-dark">Estados de calibraciones</h3>
					</div>
					<!--end::Header-->

					<!--begin::Body-->
					<div class="card-body pb-5 pt-0">
						<div class="card-content">
							<div class="flex-grow-1">
								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-warning mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-warning">
													<i class="fas fa-clock text-warning"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-warning font-weight-bolder" title="Filtrar por:">24
												<div class="font-size-sm font-weight-bold mt-1">En espera</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-primary">
													<i class="fas fa-tools  text-primary"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder" title="Filtrar por:">145
												<div class="font-size-sm font-weight-bold mt-1">En proceso</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-success mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-danger">
													<i class="fas fa-calendar-check text-success"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-success font-weight-bolder" title="Filtrar por:">14
												<div class="font-size-sm font-weight-bold mt-1">Completada</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-info mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-info">
													<i class="fas fa-certificate text-info"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-info font-weight-bolder" title="Filtrar por:">183
												<div class="font-size-sm font-weight-bold mt-1">Aprobada</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-success mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-success">
													<i class="fas fa-receipt text-success"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-success font-weight-bolder" title="Filtrar por:">183
												<div class="font-size-sm font-weight-bold mt-1">Facturada</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-danger mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-danger">
													<i class="fas fa-times text-danger"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-danger font-weight-bolder" title="Filtrar por:">183
												<div class="font-size-sm font-weight-bold mt-1">Anulada</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->

								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-warning mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-warning">
													<i class="fas fa-pause text-warning"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-warning font-weight-bolder" title="Puesta en marcha" title="Filtrar por: Previsión de repuestos">183
												<div class="font-size-sm font-weight-bold mt-1">En suspensión</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-info mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-info">
													<i class="fas fa-clipboard-list text-info"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-info font-weight-bolder" title="Puesta en marcha" title="Filtrar por: Previsión de repuestos">183
												<div class="font-size-sm font-weight-bold mt-1">En revisión</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-danger mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-danger">
													<i class="fas fa-redo text-danger"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-danger font-weight-bolder" title="Puesta en marcha" title="Filtrar por: Previsión de repuestos">183
												<div class="font-size-sm font-weight-bold mt-1">Rechazada</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->
								<!--begin::Item-->
								<div class="d-flex align-items-center justify-content-between mb-10">
									<div class="d-flex align-items-center mr-2">
										<div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
											<div class="symbol-label">
												<span class="svg-icon svg-icon-lg svg-icon-primary">
													<i class="fas fa-clipboard-check text-primary"></i>
												</span>
											</div>
										</div>
										<div>
											<a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder" title="Puesta en marcha" title="Filtrar por: Previsión de repuestos">183
												<div class="font-size-sm font-weight-bold mt-1">Prefacturado</div>
											</a>
										</div>
									</div>
								</div>
								<!--end::Item-->
							</div>
						</div>
					</div>
					<!--end::Body-->
				</div>
			</div>

			<div class="col-md-8 col-lg-9">
				<!--begin::Card-->
				<div class="card card-custom">
					<div class="card-header flex-wrap border-0 pt-6 pb-0">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label font-weight-bolder text-dark">Actividades planificadas</span>
							<p class="text-muted font-size-sm mt-3">31 Actividades planeadas</p>
						</h3>

						@if(in_array('crear', $role_actions) && \Auth::user()->hasRole('administrador'))
							<div class="card-toolbar">
								<a class="btn btn-primary font-weight-bold py-3 px-6" href="{{route('panel.agendamientos.create')}}" title="Agregar nuevo agendamiento">
									<i class="ki ki-plus icon-1x mr-2"></i>Agregar actividad
								</a>
							</div>
						@endif
					</div>

					<div class="card-body pt-5">
						<ul class="nav nav-tabs nav-bold nav-tabs-line mb-5">
							<li class="nav-item">
								<a class="nav-link @if($vista == 'agenda') active @endif" href="?vista=agenda">
									<span class="nav-text">Agenda</span>
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link @if($vista == 'calendario') active @endif" href="?vista=calendario">
									<span class="nav-text">Calendario</span>
								</a>
							</li>


						</ul>

						<div class="tab-content pt-5">
							@if($vista == 'agenda')
								<!--begin: Search Form-->
								<form class="mb-15">
									<div class="row mb-6 align-items-end">

										<div class="col-lg-3 mb-lg-0 mb-6">
											<label>Prioridad</label>
											<select class="form-control datatable-input" data-col-index="5">
												<option value="Todas">Todas</option>
												<option value="Estándar">Estándar</option>
												<option value="Urgente - 24 Horas">Urgente - 24 Horas</option>
											</select>
										</div>

										<div class="col-lg-3 mb-lg-0 mb-6">
											<label>Estado de calibraciones</label>
											<select class="form-control datatable-input" data-col-index="6">
												<option value="">Todos</option>
												@foreach ($estados_calibraciones as $estado_calibracion)
													<option value="{{$estado_calibracion->titulo}}">{{$estado_calibracion->titulo}}</option>
												@endforeach
											</select>
										</div>

										<div class="col-lg-3">
											<button class="btn btn-primary btn-primary--icon mb-5 mb-md-0" id="kt_search" title="Filtrar registros">
												<span>
													<i class="fas fa-filter"></i>
													<span>Filtrar</span>
												</span>
											</button>&#160;&#160;
											<button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
												<span>
													<i class="la la-close pr-0"></i>
												</span>
											</button>
										</div>
									</div>
								</form>
								<!--end: Search form-->

								<!--begin: Datatable-->
								<table class="table table-separate table-head-custom collapsed" id="kt_datatable">
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
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($expedientes as $i => $expediente)
											<tr>
												<td>{{$expediente->nro_expediente}}</td>
												<td>{{$expediente->instrumento}}</td>
												<td>{{$expediente->servicio}}</td>
												<td>{{$expediente->estado}}</td>
												<td>
													<span class="badge
													@if($expediente->prioridad == 'Estándar')
														badge-success
													@else
														badge-danger
													@endif
													ml-5 ml-md-0 mt-2 mt-md-0">{{$expediente->prioridad}}
												</span>

												</td>
												<td>{{$expediente->observaciones}}</td>
												<td>
													@if($expediente->tecnicos_asignados == NULL)
														David Gonzalez
													@else
														{{$expediente->tecnicos_asignados}}
													@endif
												</td>
												<td>{{$expediente->fecha_entrega}}</td>
												<td>
													@if(in_array('ver', $role_actions))
														<a href="#!" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
															<i class="la la-eye text-primary"></i>
														</a>
													@elseif(in_array('editar', $role_actions))
														<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
															<i class="la la-edit"></i>
														</a>
													@endif

													@if(in_array('eliminar', $role_actions))
														<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar registro">
															<i class="la la-trash"></i>
														</a>
													@endif
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="10" class="text-center">-- No hay registros --</td>
											</tr>
										@endforelse
									</tbody>
								</table>
								<!--end: Datatable-->
							@elseif($vista == 'calendario')
								<div id="kt_calendar"></div>
							@endif
						</div>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
	<!--end::Container-->
@endsection

@section('scripts')
	@if($vista == 'agenda')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<script src="{{asset('js/pages/crud/datatables/search-options/advanced-search.js')}}"></script>

	@elseif($vista == 'calendario')
		<script src="{{asset('plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="{{asset('js/pages/custom/education/student/calendar.js')}}"></script>
	@endif
@endsection
