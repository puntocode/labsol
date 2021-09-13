@extends('layouts.panel')

@section('title')Expedientes |@endsection
	@section('styles')
		<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
	@endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Expedientes
			<small class="font-weight-lighter">
				@if($expediente != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$expediente->nro_expediente}}</strong>
				@else
				 	| Crear
				@endif
			</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom gutter-b card-fixed">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.expedientes.index')}}" class="as-text text-hover-primary" title="Ir a listado de expedientes">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
				<!--begin::Card-->
				<div class="card card-custom mb-5">
					<div class="card-header border-0">
						<div class="card-title pt-8 d-block">
							<h3 class="card-title font-weight-bolder text-dark">Expedientes </h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($expediente != NULL)
							<div class="card-toolbar pt-8">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>

					<div class="card-body">
					@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $expediente != NULL ? route('panel.expedientes.update', ($expediente->id -1)) : route('panel.expedientes.store')}}">
							{{ csrf_field() }}
							@if ($expediente != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				    @else
				      	<div class="mb-5 form-readonly">
				    @endif
						@if($expediente != NULL)
							<div class="row align-items-star">
								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Fecha de entrega</label>
										<input type="text" class="form-control" name="fecha_entrega" id="fecha_entrega" value="{{$expediente != NULL ? $expediente->fecha_entrega : old('fecha_entrega')}}" readonly="">

									</div>
								</div>

							</div>
						@endif

							<div class="row align-items-end">
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Asignación de técnicos</h3>
								</div>

								<div class="col-12 col-lg-12">
									<div id="kanbanTecnicos"></div>
								</div>


								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Historial de asignaciones</h3>
								</div>
								<div class="col-12">
									<table class="table table-separate table-head-custom collapsed">
										<thead>
											<tr>
												<td>Fecha</td>
												<td>Técnico asignado</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>27/04/2021</td>
												<td>Sergio Martínez, Evelyn Riveros</td>
											</tr>
											<tr>
												<td>03/05/2021</td>
												<td>Diego Cristaldo</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$expediente != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.expedientes.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
								@endif
							</div>
					@if(!isset($view_mode) || $view_mode != 'readonly')
						</form>
					@else
						</div>
					@endif
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection



@section('scripts')
	<script>
		$(function(){
			$('#fecha_entrega').datepicker({
	            todayHighlight: true,
	            orientation: "bottom left"
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
