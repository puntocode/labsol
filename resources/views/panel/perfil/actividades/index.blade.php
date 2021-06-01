@extends('layouts.panel')

@section('title')Mis actividades |@endsection
@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Mis Actividades <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')
				</div>
			</div>

			<div class="card-body pt-0">
				<!--begin: Search Form-->
				<form class="mb-15">
					<div class="input-icon float-left">
						<input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
						<span>
							<i class="flaticon2-search-1 icon-md"></i>
						</span>
					</div>
				</form>
				<!--end: Search form-->

				<!--begin: Datatable-->
				<table class="table table-separate table-head-custom collapsed" id="tableActividades" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Instrumento</th>
							<th>Servicio</th>
							<th>Estado</th>
							<th>Fecha inicio</th>
							<th>Fecha fin</th>
							<th>Prioridad</th>
							<th>Fecha de Creación</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($actividades_tecnico as $i => $actividad)
							<tr>
								<td>{{$actividad->nro_expediente}}</td>
								<td>{{$actividad->instrumento}}</td>
								<td>{{$actividad->servicio}}</td>
								<td>{{$actividad->estado}}</td>
								<td>{{$actividad->fecha_inicio}} {{$actividad->hora_inicio}}</td>
								<td>{{$actividad->fecha_fin}} {{$actividad->hora_fin}}</td>
								<td>
									<span class="badge
										@if($actividad->prioridad == 'Estándar')
											badge-success
										@else
											badge-danger
										@endif
										ml-5 ml-md-0 mt-2 mt-md-0">{{$actividad->prioridad}}
									</span>
								</td>
								<td>{{$actividad->fecha_creacion}}</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.perfil.actividades.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.perfil.actividades.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
						@endforeach
					</tbody>
				</table>
				<!--end: Datatable-->
			</div>
		</div>
		<!--end::Card-->
	</div>
@endsection

@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

	<script>
		$(function() {
			oTable = $('#tableActividades').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
