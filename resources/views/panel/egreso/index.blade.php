@extends('layouts.panel')

@section('title')Salida de instrumento |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Salida de instrumento <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.egreso.create')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear egreso</a>
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
					<table class="table table-separate table-head-custom collapsed" id="tableInstrumentos" style="width:100%">
						<thead>
							<tr>
								<th>Cliente</th>
								<th>Contacto</th>
								<th>Email</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>F. de Creación</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($entradasInstrumentos as $entradaInstrumento)
								<tr>
									<td>{{ $entradaInstrumento->cliente->name }}</td>
									<td>{{ $entradaInstrumento->contact['nombre'] }}</td>
									<td>{{ $entradaInstrumento->contact['email'] }}</td>
									<td>{{ $entradaInstrumento->contact['direccion'] }}</td>
									<td>{{ $entradaInstrumento->contact['telefono'] }}</td>
									<td>{{ $entradaInstrumento->created_at }}</td>
									<td>
										@if(in_array('ver', $role_actions))
											<a href="{{ route('panel.egreso.show', $entradaInstrumento) }}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
												<i class="fas fa-list text-primary"></i>
											</a>
										@endif

										@if(in_array('imprimir', $role_actions))
											<a href="{{ route('panel.egreso.print', $entradaInstrumento) }}" class="btn btn-sm btn-clean btn-icon" title="Imprimir registro">
												<i class="la la-print"></i>
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
		</div>
	@endsection

	@section('scripts')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

		<script>
			$(function() {
				oTable = $('#tableInstrumentos').DataTable({
					responsive: true,
					"bLengthChange": false
				});

				$('#tableInpuntSearch').keyup(function(){
				    oTable.search($(this).val()).draw() ;
				});
			});
		</script>
	@endsection
