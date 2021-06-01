@extends('layouts.panel')

@section('title')Patrones |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Patrones
			<small class="font-weight-lighter">
				@if($patron != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$patron->descripcion}} </strong>
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
									<a href="{{route('panel.patrones.index')}}" class="as-text text-hover-primary" title="Ir a listado de patrones">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if(in_array('crear', $role_actions))
									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.patrones.create')}}" class="as-text text-hover-primary" title="Crear nuevo usuario">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear nuevo
										</a>
									</li>
								@endif

								@if($patron != NULL && in_array('eliminar', $role_actions))
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
							<h3 class="card-title font-weight-bolder text-dark">Datos de patrón</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($patron != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $patron != NULL ? route('panel.patrones.update', ($patron->id -1)) : route('panel.patrones.store')}}">
							{{ csrf_field() }}
							@if ($patron != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Descripción <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="descripcion" required value="{{$patron != NULL ? $patron->descripcion : old('descripcion')}}">
									</div>
								</div>
								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Certificado <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="certificado" required value="{{$patron != NULL ? $patron->certificado : old('certificado')}}">
									</div>
								</div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Próxima calibración</label>
                    <input type="text" class="form-control" name="prox_calibracion" id="prox_calibracion" value="{{$patron != NULL ? $patron->prox_calibracion : old('prox_calibracion')}}">
                  </div>
                </div>




							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$patron != NULL ? 'Guardar' : 'Crear patrón'}}</button>
								@else
									<a href="{{route('panel.patrones.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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
  $('#prox_calibracion').datepicker({
    todayHighlight: true,
    orientation: "bottom left"
  });

  </script>
@endsection
