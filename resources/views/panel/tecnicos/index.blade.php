@extends('layouts.panel')

@section('title')Técnicos |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Técnicos <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')
					
					@if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="{{route('panel.clientes.create')}}" class="btn btn-primary font-weight-bolder mb-5">
						<i class="la la-plus"></i>Agregar Técnico</a>
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
				<table class="table table-separate table-head-custom collapsed" id="tableTecnicos" style="width:100%">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>CI</th>
							<th>Teléfono</th>
							<th>Grupo</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tecnicos as $i => $tecnico)
							<tr>
								<td>{{$tecnico->nombre}}</td>
								<td>{{$tecnico->cedula}}</td>
								<td>{{$tecnico->telefono}}</td>
								<td>{{$tecnico->grupo}}</td>
								<td>
									<span class="badge text-white {{$tecnico->estado == 'activo' ? 'bg-success' : 'bg-gray-600'}}">
										{{$tecnico->estado}}	
									</span>									
								</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.tecnicos.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.tecnicos.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
			oTable = $('#tableTecnicos').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});		
	</script>
@endsection