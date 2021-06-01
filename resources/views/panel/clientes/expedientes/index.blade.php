@extends('layouts.panel')

@section('title')Service Tickets |@endsection

@section('content')
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container-fluid">
			<h3 class="card-label mb-8">Service Tickets <small class="font-weight-lighter">| Listado</small></h3>

			<div class="row">
				<div class="col-md-6 col-lg-5">
					<!--begin::List Widget 13-->
					<div class="card card-custom gutter-b">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<div class="input-icon my-5 w-100">
								<input type="text" class="form-control" placeholder="Término de búsqueda">
								<span>
									<i class="flaticon2-search-1 icon-md"></i>
								</span>
							</div>
						</div>
						<!--end::Header-->
						
						<!--begin::Body-->
						<div class="card-body pb-5 pt-5">
							<div class="card-content">
								<div class="row">
									<div class="col-md-6 mb-6">
										<div class="form-group date mb-0">
											<label>Fecha desde</label>
											<input type="text" class="form-control" id="fechaDesde" readonly="readonly"/>
										</div>
									</div>

									<div class="col-md-6 mb-6">
										<div class="form-group date mb-0">
											<label>Fecha hasta</label>
											<input type="text" class="form-control" id="fechaHasta" readonly="readonly"/>
										</div>
									</div>

									<div class="col-md-6 mb-6">
										<label>Tipo de actividad</label>
										<select class="form-control datatable-input" data-col-index="4">
											<option value="">Todas</option>
											@foreach ($tipos_actividades as $tipo_actividad)
												<option value="{{$tipo_actividad->titulo}}">{{$tipo_actividad->titulo}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-6 mb-6">
										<label>Tipo de equipo</label>
										<select class="form-control datatable-input" data-col-index="5">
											<option value="">Todas</option>
											@foreach ($tipos_equipos as $tipo_equipo)
												<option value="{{$tipo_equipo->titulo}}">{{$tipo_equipo->titulo}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-6 mb-6">
										<label>Estado de equipo</label>
										<select class="form-control datatable-input" data-col-index="6">
											<option value="">Todos</option>
											@foreach ($estados_equipos as $estado_equipo)
												<option value="{{$estado_equipo->titulo}}">{{$estado_equipo->titulo}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-12 mt-2 mb-5">
										<p class="h6 border-bottom border-primary pb-5 mb-5 mt-5">
											Filtros específicos
										</p>
									</div>

									<div class="col-12 mb-6">
										<label>Equipo</label>
										<select class="form-control datatable-input" data-col-index="6">
											<option value="">Todos</option>
											@foreach ($equipos as $i => $equipo)
												<option value="{{$i}}">{{ ($equipo->serie != NULL ?  $equipo->serie .' - ' : '') . $equipo->nombre}}</option>
											@endforeach
										</select>
									</div>							

									<div class="col-12 mb-6">
										<label>Técnico</label>
										<select class="form-control datatable-input" data-col-index="6">
											<option value="">Todos</option>
											@foreach ($tecnicos as $i => $tecnico)
												<option value="{{$i}}">{{$tecnico->nombre}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-12 mb-6">
										<label>Cliente</label>
										<select class="form-control datatable-input" data-col-index="6">
											<option value="">Todos</option>
											@foreach ($clientes as $i => $cliente)
												<option value="{{$i}}">{{$cliente->razon_social}}</option>
											@endforeach
										</select>
									</div>

									<div class="col-12 mt-5">
										<a href="#!" class="btn btn-primary float-right"><i class="fas fa-filter"></i> Filtrar</a>
									</div>

								</div>
							</div>
						</div>
						<!--end::Body-->
					</div>
					<!--end::List Widget 13-->
				</div>

				<div class="col-md-6 col-lg-7">	
					<div class="card card-custom card-stretch gutter-b pt-7">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title font-weight-bolder text-dark">Entradas</h3>

							<div class="card-toolbar mt-0 justify-content-between w-100">
								<p class="font-size-sm text-muted mb-5">183 Service-Tickets</p>

								@include('layouts.partials.extras.dropdown._export_list')
							</div>
							<!--end::Header-->

							<!--begin::Body-->
							<div class="card-body pt-2 px-0">
								@for ($i = 0; $i < 10; $i++)
									@include('layouts.components.service_ticket_item_list')
								@endfor
							</div>
						</div>
						<!--end::Body-->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$('#fechaDesde').datepicker({
            todayHighlight: true,
            orientation: "bottom left"
        });

        $('#fechaHasta').datepicker({
            todayHighlight: true,
            orientation: "bottom left"
        });
	</script>
@endsection