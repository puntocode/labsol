@extends('layouts.panel')

@section('title')Expedientes |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Expedientes <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')
					@if(in_array('crear', $role_actions))
						<!--begin::Button-->
						<a href="#modalTecnicos" data-toggle="modal" class="btn btn-primary font-weight-bolder mb-5">
						<i class="la la-plus"></i>Asignar Calibración</a>
						<!--end::Button-->
					@endif
				</div>
			</div>

			<div class="card-body pt-0">
				<!--begin: Search Form-->
				<form class="mb-15">
					<div class="row mb-6 align-items-end">
						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Prioridad</label>
							<select class="form-control datatable-input" data-col-index="4">
								<option value="">Todas</option>
									<option value="Estándar">Estándar</option>
									<option value="Urgente - 24 Horas">Urgente - 24 Horas</option>
							</select>
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Estado</label>
							<select class="form-control datatable-input" data-col-index="5">
								<option value="">Todas</option>
								@foreach ($estados as $estado)
									<option value="{{$estado->titulo}}">{{$estado->titulo}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Plazo de entrega</label>
							<input type="text" class="form-control" id="fecha_entrega" readonly="readonly"/>
						</div>

						<div class="col-lg-2 mb-lg-0 mb-6">
							<label>Modalidad</label>
							<select class="form-control datatable-input" data-col-index="4">
								<option value="">Todas</option>
								<option value="Estándar">LS</option>
								<option value="Urgente - 24 Horas">LSi</option>
							</select>
						</div>

						<div class="col-lg-3">
							<button class="btn btn-primary btn-primary--icon" id="kt_search" title="Filtrar registros">
								<span>
									<i class="fas fa-filter"></i>
									<span>Filtrar</span>
								</span>
							</button>&#160;&#160;
							<button class="btn btn-secondary btn-secondary--icon" id="kt_reset" title="Reiniciar filtros">
								<span>
									<i class="la la-close pr-0"></i>
								</span>
							</button>
						</div>
					</div>
				</form>
				<!--end: Search form-->

				<!--begin: Datatable-->
				<table class="table table-separate table-head-custom collapsed" id="tableExpedientes" style="width:100%">
					<thead>
						<tr>
							<th>N° Exp</th>
							<th>Instrumento</th>
							<th>Servicio</th>
							<th>Estado</th>
							<th>Prioridad</th>
							<th>Observaciones</th>
							<th>Técnico asignado</th>
							<th>Fecha de entrega</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($expedientes as $i => $expediente)
							<tr>
								<td>{{$expediente->nro_expediente}}</td>
								<td>{{$expediente->instrumento}}</td>
								<td>{{$expediente->servicio}}</td>
								<td>{{$expediente->estado}}</td>
								<td>
									<span class="badge
									@if($expediente->prioridad == 'Estándar')
										badge-success
									@else
										badge-danger
									@endif
									ml-5 ml-md-0 mt-2 mt-md-0">{{$expediente->prioridad}}
								</span>

								</td>
								<td>{{$expediente->observaciones}}</td>
								<td>
									@if($expediente->tecnicos_asignados == NULL)
										<a href="modalTecnicos" class="btn btn-primary" title="Asignar técnico(s)"  data-toggle="modal" data-target="#modalTecnicos">Asignar técnico</a>
									@else
										{{$expediente->tecnicos_asignados}}
									@endif
								</td>
								<td>{{$expediente->fecha_entrega}}</td>
								<td>
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.expedientes.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver registro">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.expedientes.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar registro">
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
@section('modales')
	<div class="modal fade" id="modalTecnicos" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header bg-primary rounded-0">
	                <h5 class="modal-title text-white" id="exampleModalLabel">Asignar Técnico(s)</h5>
	                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	                    <i aria-hidden="true" class="ki ki-close text-white"></i>
	                </button>
	            </div>
	            <div class="modal-body">
	               <form action="#!">
									 <div class="row">
										 <div class="col-md-8">
											 <div class="form-group">
												 <label>Expediente Nro</label>
												 <select class="form-control datatable-input" name="nro_expediente" id="expedienteSelect" multiple="multiple">
													 @foreach ($expedientes as $i => $expediente)
														 <option value=""></option>
														 <option value="{{$expediente->nro_expediente}}">{{$expediente->nro_expediente}}</option>
													 @endforeach
												 </select>
											 </div>
										 </div>
										 <div class="col-12 my-5">
											 <div id="kanbanTecnicos"></div>
										 </div>

									 </div>
		            </form>
	            </div>
	            <div class="modal-footer justify-content-center border-0">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Asignar</button>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
	$('#expedienteSelect').select2({
		placeholder: "Seleccione uno o varios expedientes"
	});
	</script>
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
	<script>
        $('#fecha_entrega').datepicker({
            todayHighlight: true,
            orientation: "bottom left"
        });

	</script>
	<script>
		$(function() {
			oTable = $('#tableExpedientes').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
	<script src="{{asset('plugins/custom/kanban/kanban.bundle.js')}}"></script>
	<script>

			var _kanbanTecnicos = function() {
					var kanban = new jKanban({
							element: '#kanbanTecnicos',
							gutter: '0',
							click: function(el) {
									/*alert(el.innerHTML);*/
							},
							dropEl :function(el){
								if($(el).find('div.not-draggable').length !== 0){
									return false;
								}
								return true;
							},
							dragBoards: false,
							boards: [{
											'id': '_tecnicosDisponibles',
											'title': 'Técnicos',
											'class': 'light-sucess',
											'item': [
												@foreach ($tecnicos as $i => $tecnico)
													{
																'title': `
																	@include('layouts.partials.extras.items.duallist_image_text', ['item' => $tecnico])
																`
														 },
												@endforeach
											]
									},
									{
											'id': '_tecnicosAsignados',
											'title': 'Técnicos asignados',
											'class': 'light-success',
											'item': []
									}
							]
					});
			}

			_kanbanTecnicos();
	</script>
@endsection
