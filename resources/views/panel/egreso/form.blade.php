@extends('layouts.panel')

@section('title')Egreso Instrumentos |@endsection
  @section('styles')
  	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
  @endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Egreso Instrumentos
			<small class="font-weight-lighter">
				@if($entrada_instrumento != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$entrada_instrumento->nro_expediente}} </strong>
				@else
				 	| Crear
				@endif
			</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.egreso.index')}}" class="as-text text-hover-primary" title="Ir a listado de instrumentos">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if(in_array('crear', $role_actions))
									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.egreso.create')}}" class="as-text text-hover-primary" title="Crear nuevo cliente">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear nuevo
										</a>
									</li>
								@endif

								@if($entrada_instrumento != NULL && in_array('eliminar', $role_actions))
									<li><hr></li>

									<li>
										<a href="#!" class="as-text text-hover-primary" title="Eliminar registro actual">
											<i class="fas fa-trash-alt text-hover-primary"></i>
											Eliminar
										</a>
									</li>
								@endif
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
							<h3 class="card-title font-weight-bolder text-dark">Datos de entrada</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($entrada_instrumento != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $entrada_instrumento != NULL ? route('panel.egreso.update', ($entrada_instrumento->id -1)) : route('panel.egreso.store')}}">
							{{ csrf_field() }}
							@if ($entrada_instrumento != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">
                @if($entrada_instrumento == NULL)
								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Equipo <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="equipo" required value="{{$entrada_instrumento != NULL ? $entrada_instrumento->equipo : old('equipo')}}">
									</div>
								</div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Servicio</label>
                    <input type="text" class="form-control" name="servicio" value="{{$entrada_instrumento != NULL ? $entrada_instrumento->servicio : old('servicio')}}">
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control datatable-input" name="estado" id="estadoSelect">
                      <option value="Estándar">Estándar</option>
                      <option value="Urgente - 24 horas">Urgente - 24 horas</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Fecha de entrega</label>
                    <input type="text" class="form-control" id="fecha_entrega" readonly="readonly" @if($entrada_instrumento != NULL) value="{{$entrada_instrumento->fecha_entrega}}" @endif/>
                  </div>
                </div>
                  <div class="col-12 my-5">
                    <div id="kanbanTecnicos"></div>
                  </div>
                @endif
								<div class="col-12 col-lg-12">
									<div class="form-group">
										<label>Observaciones</label>
                    <textarea name="observaciones" rows="8" cols="80" class="form-control">{{$entrada_instrumento != NULL ? $entrada_instrumento->observaciones : old('observaciones')}}</textarea>
									</div>
								</div>

							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$entrada_instrumento != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.egreso.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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
		$('#estadoSelect').select2({
         	placeholder: "Seleccione un estado"
        });

        $('#fecha_entrega').datepicker({
            todayHighlight: true,
            orientation: "bottom left"
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
