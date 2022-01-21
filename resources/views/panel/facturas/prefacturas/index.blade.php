@extends('layouts.panel')

@section('title')Facturación |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Planillas de Liquidación <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.facturas.prefacturas.clientes')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear Planilla</a>
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
					<table class="table table-separate table-head-custom collapsed" id="tablePrefacturas" style="width:100%">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Código</th>
								<th>RUC</th>
								<th>N° de Planilla</th>
								<th>F. de Cierre</th>
								<th>Total</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($prefacturas as $prefactura)
								<tr>
									<td>{{ $prefactura->cliente->name }}</td>
									<td>{{ $prefactura->cliente->code }}</td>
									<td>{{ $prefactura->cliente->ruc }}</td>
									<td>{{ $prefactura->cliente->id }}</td>
									<td data-order="{{ $prefactura->fecha_cierre->timestamp }}">
										{{ $prefactura->fecha_cierre }}
									</td>
									<td data-order="{{ $prefactura->total }}">
										{{ Helper::currencyFormat($prefactura->total) }}
									</td>
									<td>
										@if(in_array('ver', $role_actions))
											<a href="{{ route('panel.facturas.prefacturas.show', $prefactura) }}"
												class="btn btn-sm btn-clean btn-icon" title="Ver Planilla">
												<i class="fas fa-list text-primary"></i>
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
		</div>
	@endsection

	@section('scripts')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

		<script>
			$(function() {
				oTable = $('#tablePrefacturas').DataTable({
					responsive: true,
					"bLengthChange": false
				});

				$('#tableInpuntSearch').keyup(function(){
				    oTable.search($(this).val()).draw() ;
				});
			});
		</script>
	@endsection
