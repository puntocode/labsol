@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Equipos <small class="font-weight-lighter">| Clientes</small></h3>

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
				<table class="table table-separate table-head-custom collapsed" id="tableEquipos" style="width:100%">
					<thead>
						<tr>
							<th>Cliente</th>
							<th>Nro. de Contrato</th>
							<th>Vigente desde</th>
							<th>Vigente hasta</th>
							<th>Período de vigencia</th>
							<th>Equipo</th>
							<th>Modelo</th>
							<th>Serie</th>
							<th>Último MP</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($equipos as $i => $equipo)
							<tr>
								<td>{{$equipo->cliente->razon_social}}</td>
								<td>{{$equipo->cliente->nro_contrato}}</td>
								<td>{{$equipo->cliente->vigente_desde}}</td>
								<td>{{$equipo->cliente->vigente_hasta}}</td>
								<td>{{$equipo->cliente->periodo_vigencia}}</td>
								<td>{{$equipo->nombre}}</td>
								<td>{{$equipo->modelo}}</td>
								<td>{{$equipo->serie}}</td>
								<td>{{$equipo->ultimo_mantenimiento}}</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="#!{{--route('panel.clientes.contratos.edit', $i)--}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="fas fa-list text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="#!{{--route('panel.clientes.contratos.edit', $i)--}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
			oTable = $('#tableEquipos').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
