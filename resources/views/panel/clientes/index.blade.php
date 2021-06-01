@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Clientes <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')

					@if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="{{route('panel.clientes.create')}}" class="btn btn-primary font-weight-bolder mb-5">
						<i class="la la-plus"></i>Agregar Cliente</a>
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
				<table class="table table-separate table-head-custom collapsed" id="tableClientes" style="width:100%">
					<thead>
						<tr>
							<th>Razón Social</th>
							<th>RUC/CI</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>Email</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($clientes as $i => $cliente)
							<tr>
								<td>{{$cliente->razon_social}}</td>
								<td>{{$cliente->documento}}</td>
								<td>{{$cliente->direccion}}</td>
								<td>{{$cliente->telefono}}</td>
								<td>{{$cliente->email}}</td>
								<td>

										<a href="{{route('panel.clientes.ficha', $cliente->id)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>

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
			oTable = $('#tableClientes').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
