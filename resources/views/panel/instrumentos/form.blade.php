@extends('layouts.panel')

@section('title')Entrada Instrumentos |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Entrada Instrumentos
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
									<a href="{{route('panel.instrumentos.index')}}" class="as-text text-hover-primary" title="Ir a listado de instrumentos">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if(in_array('crear', $role_actions))
									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.instrumentos.create')}}" class="as-text text-hover-primary" title="Crear nuevo cliente">
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
						<form class="mb-5" method="POST" action="{{ $entrada_instrumento != NULL ? route('panel.instrumentos.update', ($entrada_instrumento->id -1)) : route('panel.instrumentos.store')}}">
							{{ csrf_field() }}
							@if ($entrada_instrumento != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">
                @if($entrada_instrumento == NULL)
								<div class="col-12 col-lg-5">
									<div class="form-group">
										<label>Cliente <span class="text-danger">*</span></label>
                    <select class="form-control datatable-input" name="cliente" id="clienteSelect">
                      @foreach ($clientes as $i => $cliente)
                        <option value=""></option>
                        <option value="{{$cliente->razon_social}}">{{$cliente->razon_social}}</option>
                      @endforeach
                    </select>
									</div>
								</div>
								<div class="col-12 col-lg-5">
									<div class="form-group">
										<label>Equipo <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="equipo" required value="{{$entrada_instrumento != NULL ? $entrada_instrumento->equipo : old('equipo')}}">
									</div>
								</div>
								<div class="col-12 col-lg-2">
									<div class="form-group">
										<label>Cantidad</label>
										<input type="number" class="form-control" name="cantidad" @if($entrada_instrumento != NULL) value="{{$entrada_instrumento->cantidad}}" @endif/>
									</div>
								</div>
                <div class="col-12 col-lg-3">
                  <div class="form-group">
                    <label>Tipo de expediente</label>
										<select class="form-control datatable-input">
											<option value="LS">LS</option>
											<option value="LSi">LSi</option>
										</select>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="form-group">
                    <label>Servicio</label>
                    <input type="text" class="form-control" name="servicio" value="{{$entrada_instrumento != NULL ? $entrada_instrumento->servicio : old('servicio')}}">
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="form-group">
                    <label>Prioridad</label>
                    <select class="form-control datatable-input" name="prioridad" id="prioridadSelect">
                      <option value="Estándar">Estándar</option>
                      <option value="Urgente - 24 horas">Urgente - 24 horas</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="form-group">
                    <label>Estado</label>
										<select class="form-control datatable-input" name="estado" id="estadoSelect">
											@foreach ($estados as $key => $estado)
												<option value="{{$estado->codigo}}">{{$estado->titulo}}</option>
											@endforeach
										</select>
                  </div>
                </div>
                @endif
								<div class="col-12 col-lg-12">
									<div class="form-group">
										<label>Observaciones</label>
                    <textarea name="observaciones" rows="8" cols="80" class="form-control">{{$entrada_instrumento != NULL ? $entrada_instrumento->observaciones : old('observaciones')}}</textarea>
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Recibido por</label>
                    <select class="form-control datatable-input" name="cliente" id="usuarioSelect">
                      @foreach ($usuarios as $i => $usuario)
                        <option value=""></option>
                        <option value="{{$usuario->nombre}}">{{$usuario->nombre}}</option>
                      @endforeach
                    </select>
									</div>
								</div>

							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$entrada_instrumento != NULL ? 'Guardar' : 'Generar expediente/s'}}</button>
								@else
									<a href="{{route('panel.instrumentos.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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

  $('#clienteSelect').select2({
    placeholder: "Seleccione un cliente"
  });
  $('#usuarioSelect').select2({
    placeholder: "Seleccione un usuario"
  });

  </script>
@endsection
