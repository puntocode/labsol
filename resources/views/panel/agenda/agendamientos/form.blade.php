@extends('layouts.panel')

@section('title')Agenda |@endsection

@section('styles')
	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Agenda
			<small class="font-weight-lighter">
				@if($agendamiento != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}} </strong>
				@else
				 	| Crear
				@endif
			</small>
		</h3>
		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom gutter-b">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.expedientes.agenda')}}" class="as-text text-hover-primary" title="Ir a listado de agendamientos">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Volver a Agenda
									</a>
								</li>

								<li><hr></li>

								@if(in_array('crear', $role_actions))
									<li class="mb-5">
										<a href="{{route('panel.agendamientos.create')}}" class="as-text text-hover-primary" title="Crear nuevo agendamiento">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear nuevo
										</a>
									</li>

									<li class="mb-5">
										<a href="#!" class="as-text text-hover-primary" title="Crear nuevo agendamiento a partir de una actividad existente">
											<i class="far fa-calendar-alt text-hover-primary"></i>
											Agendar desde actividad
										</a>
									</li>
								@endif

								@if($agendamiento != NULL && in_array('eliminar', $role_actions))
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
							<h3 class="card-title font-weight-bolder text-dark">Información general</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($agendamiento != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>

					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $agendamiento != NULL ? route('panel.agendamientos.update', ($agendamiento->id -1)) : route('panel.agendamientos.store')}}">
							{{ csrf_field() }}
							@if ($agendamiento != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif

				            @if($agendamiento != NULL)
								<div class="row align-items-end">
									<div class="col-12 col-lg-3">
										<div class="form-group">
											<label class="d-block">Estado</label>
											<span class="badge {{$agendamiento->estado == 'vigente' ? 'bg-success' : 'bg-gray-600'}}">{{$agendamiento->estado}}</span>
										</div>
									</div>
								</div>
							@endif

							<div class="row align-items-end">
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label>Cliente <span class="text-danger">*</span></label>
										<select class="form-control datatable-input" name="cliente" id="clienteSelect">
											<option value="">Seleccione una opción</option>
											@foreach ($clientes as $cliente)
												<option value="{{$cliente->id}}"
													@if($agendamiento != NULL && $agendamiento->cliente == $cliente->razon_social) selected="" @endif
													>
													{{$cliente->razon_social}}
												</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label>Instrumento <span class="text-danger">*</span></label>
										<select class="form-control datatable-input" name="equipo" id="equipoSelect">
											<option value="">Seleccione una opción</option>
											@foreach ($instrumentos as $instrumento)
												<option value="{{$instrumento->id}}"
													@if($agendamiento != NULL && $agendamiento->equipo == $instrumento->nombre) selected="" @endif
													>
													{{$instrumento->nombre}}
												</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-12 mt-5 mb-3">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Horarios</h3>
								</div>

								<div class="col-md-4 col-lg-2">
									<div class="form-group date" title="Fecha">
										<label>Fecha de entrega</label> <span class="text-danger">*</span>
										<input type="text" class="form-control" id="fecha" readonly="readonly" @if($agendamiento != NULL) value="{{$agendamiento->fecha}}" @endif/>
									</div>
								</div>

								<div class="col-12 mt-5 mb-3">
									<h3 class="h4 border-bottom border-primary mt-5 mb-3 pb-3">Información adicional</h3>
								</div>

								<div class="col-12 col-md-6 col-lg-2">
									<div class="form-group">
										<label>Cantidad</label>
										<input type="number" min="0" max="100" class="form-control" name="cantidad" value="{{$agendamiento != NULL ? $agendamiento->cantidad : old('cantidad')}}">
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Detalle de actividad <span class="text-danger">*</span> </label>
										<textarea class="form-control" name="descripcion">{{$agendamiento != NULL ? $agendamiento->descripcion : old('descripcion')}}</textarea>
									</div>
								</div>

								<div class="col-12 my-5">
									<div id="kanbanTecnicos"></div>
								</div>

								<div class="col-12 mt-5 mb-3">
									<h3 class="h4 border-bottom border-primary mt-5 mb-3 pb-3">Información adicional</h3>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Observaciones</label>
										<textarea class="form-control" name="observaciones">{{$agendamiento != NULL ? $agendamiento->observaciones: old('observaciones')}}</textarea>
									</div>
								</div>

								<div class="col-12">
									<div class="form-group">
										<label>Comentarios</label>
										<textarea class="form-control" name="comentarios">{{$agendamiento != NULL ? $agendamiento->comentarios: old('comentarios')}}</textarea>
									</div>
								</div>

							</div>
							@if(!isset($view_mode) || $view_mode != 'readonly')
								<div class="row mt-5">
									<button class="btn btn-primary mx-auto">{{$agendamiento != NULL ? 'Guardar' : 'Crear'}}</button>
								</div>
							@else
								<a href="{{route('panel.agendamientos.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
							@endif
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
		$('#clienteSelect').select2({
         	placeholder: "Seleccione un cliente"
        });

        $('#equipoSelect').select2({
         	placeholder: "Seleccione un instrumento"
        });


        $('#fecha').datepicker({
            todayHighlight: true,
            orientation: "bottom left"
        });

        $('#horaSalida, #horaInicio, #horaFin').timepicker();
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
