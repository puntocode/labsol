@extends('layouts.panel')

@section('title')Equipos y Ensayos |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Equipos y Ensayos <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@include('layouts.partials.extras.dropdown._export_list')

						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.equipos.create')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear equipo</a>
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
					<table class="table table-separate table-head-custom collapsed" id="tableEquipos" style="width:100%">
						<thead>
							<tr>
								<th>Identificacion</th>
                <th>Titulo</th>
								<th>Servicio</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($equipos as $i => $equipo)
								<tr>
                  <td>{{$equipo->codigo}}</td>
                  <td>{{$equipo->titulo}}</td>
									<td>{{$equipo->servicio}}</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.equipos.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver patrón">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.equipos.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar patrón">
											<i class="la la-edit"></i>
										</a>
									@endif

										@if(in_array('eliminar', $role_actions))
											<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar patrón">
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
