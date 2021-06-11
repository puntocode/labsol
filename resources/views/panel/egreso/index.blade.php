@extends('layouts.panel')

@section('title')Salida de instrumento |@endsection

	@section('styles')
		{{--<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />--}}
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Salida de instrumento <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@include('layouts.partials.extras.dropdown._export_list')

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
								<th>N° Exp</th>
								<th>Equipo</th>
								<th>Servicio</th>
								<th>Observación</th>
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
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.egreso.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.egreso.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
											<i class="la la-edit"></i>
										</a>
									@endif
									@if(in_array('imprimir', $role_actions))
										<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Imprimir registro">
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
		{{--<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>--}}

		<script>

		</script>
	@endsection
