@extends('layouts.panel')

@section('title')Mis informes |@endsection
@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Mis Informes <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="{{route('panel.perfil.informes.create')}}" class="btn btn-primary font-weight-bolder mb-4 mr-2">
						<i class="la la-file-upload"></i>Subir Informe</a>
						<!--end::Button-->
					@endif
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
				<table class="table table-separate table-head-custom collapsed" id="tableInformes" style="width:100%">
					<thead>
						<tr>
							<th>Equipo</th>
							<th>Fecha</th>
							<th>Motivo</th>
							<th>Cliente</th>
							<th>Modalidad</th>
							<th>Tipo de equipo</th>
							<th>Estado del Equipo</th>
							<th>Informe</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($informes as $i => $informe)
							<tr>
								<td>{{$informe->equipo}}</td>
								<td>{{$informe->fecha}}</td>
								<td>{{$informe->motivo}}</td>
								<td>{{$informe->cliente}}</td>
								<td>{{$informe->modalidad}}</td>
								<td>{{$informe->tipo_equipo}}</td>
								<td>{{$informe->estado_equipo}}</td>
								<td><a href="javascript:void(0)">Ver PDF</a></td>

								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.perfil.informes.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver informe">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.perfil.informes.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar informe">
											<i class="la la-edit"></i>
										</a>
									@endif

									@if(in_array('eliminar', $role_actions))
										<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar informe">
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
			oTable = $('#tableInformes').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
