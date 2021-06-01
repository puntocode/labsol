@extends('layouts.panel')

@section('title')Entrada Instrumentos |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Entrada Instrumentos <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@include('layouts.partials.extras.dropdown._export_list')

						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.instrumentos.create')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear entrada</a>
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
								<th>N° Exp</th>
								<th>Equipo</th>
								<th>Servicio</th>
								<th>Observación</th>
								<th>Prioridad</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($entrada_instrumentos as $i => $entrada)
								<tr>
									<td>{{$entrada->nro_expediente}}</td>
									<td>{{$entrada->equipo}}</td>
									<td>{{$entrada->servicio}}</td>

									<td>{{$entrada->observaciones}}</td>

									<td>
										<span class="badge
										@if($entrada->prioridad == 'Estándar')
											badge-success
										@elseif($entrada->prioridad = 'Urgente - 24 horas')
											badge-danger
										@else
											badge-warning
										@endif
										ml-5 ml-md-0 mt-2 mt-md-0">{{$entrada->prioridad}}
									</span>
								</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.instrumentos.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.instrumentos.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
