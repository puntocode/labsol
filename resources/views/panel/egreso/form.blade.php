@extends('layouts.panel')

@section('title')Salida de instrumento |@endsection
  @section('styles')
  	<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
  @endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Salida de instrumento
			<small class="font-weight-lighter">
				@if($salida_instrumento != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$salida_instrumento->nro_expediente}} </strong>
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

								@if($salida_instrumento != NULL && in_array('eliminar', $role_actions))
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

						@if($salida_instrumento != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $salida_instrumento != NULL ? route('panel.egreso.update', ($salida_instrumento->id -1)) : route('panel.egreso.store')}}">
							{{ csrf_field() }}
							@if ($salida_instrumento != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">
                @if($salida_instrumento == NULL)
                  <div class="col-12 col-lg-4">
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
								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Equipo <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="equipo" required value="{{$salida_instrumento != NULL ? $salida_instrumento->equipo : old('equipo')}}">
									</div>
								</div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Servicio</label>
                    <input type="text" class="form-control" name="servicio" value="{{$salida_instrumento != NULL ? $salida_instrumento->servicio : old('servicio')}}">
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
                    <label>Retirado por</label>
                    <input type="text" class="form-control" name="retirado_por" value="{{$salida_instrumento != NULL ? $salida_instrumento->retirado_por : old('retirado_por')}}">
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Fecha de entrega</label>
                    <input type="text" class="form-control" id="fecha_entrega" readonly="readonly" @if($salida_instrumento != NULL) value="{{$salida_instrumento->fecha_entrega}}" @endif/>
                  </div>
                </div>

                @endif
								<div class="col-12 col-lg-12">
									<div class="form-group">
										<label>Observaciones</label>
                    <textarea name="observaciones" rows="8" cols="80" class="form-control">{{$salida_instrumento != NULL ? $salida_instrumento->observaciones : old('observaciones')}}</textarea>
									</div>
								</div>

							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$salida_instrumento != NULL ? 'Guardar' : 'Crear'}}</button>
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

	$('#expedienteSelect').select2({
		placeholder: "Seleccione uno o varios expedientes"
	});
	</script>
@endsection
