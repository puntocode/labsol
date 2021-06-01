@extends('layouts.panel')

@section('title')Grupos de Técnicos |@endsection

@section('styles')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Grupos de técnicos <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')
					
					@if(in_array('crear', $role_actions))					
						<!--begin::Button-->
						<a href="{{route('panel.tecnicos.grupos.create')}}" class="btn btn-primary font-weight-bolder mb-4">
						<i class="la la-plus"></i>Agregar Grupo</a>
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
				<table class="table table-separate table-head-custom collapsed" id="tableGruposTecnicos" style="width:100%">
					<thead>
						<tr>
							<th>Título</th>
							<th>Integrantes</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($grupos_tecnicos as $i => $grupo)
							<tr>
								<td>{{$grupo->titulo}}</td>
								<td>
									<ul class="list-unstyled">
										@foreach ($grupo->tecnicos as $j => $tecnico)
											<li class="mb-6">										
												<a href="{{route('panel.tecnicos.edit', $j)}}" class="" title="Ver ficha de técnico">{{$tecnico->nombre}}</a>
											</li>
										@endforeach
									</ul>
								</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.tecnicos.grupos.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.tecnicos.grupos.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
			oTable = $('#tableGruposTecnicos').DataTable({
				responsive:true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});		
	</script>
@endsection