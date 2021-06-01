@extends('layouts.panel')

@section('title')Informes |@endsection
@section('styles')
<style media="screen">
  .dropzone.dropzone-default .dz-remove{
    font-size: 10px;
  }
</style>
@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Mis Informes
			<small class="font-weight-lighter">
				@if($informe != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$informe->motivo}} </strong>
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
									<a href="{{route('panel.perfil.informes.index')}}" class="as-text text-hover-primary" title="Ir a listado actividades">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if($informe != NULL && \Auth::user()->hasRole('tecnico'))
									<li><hr></li>
									{{-- <li class="mb-5">
										<a href="#!" class="as-text text-hover-primary" title="Marcar actividad como iniciada" id="iniciar">
											<i class="far fa-play-circle text-hover-primary"></i>
											Iniciar
										</a>
									</li> --}}

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

						@if($informe != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>

					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $informe != NULL ? route('panel.perfil.informes.update', ($informe->id -1)) : route('panel.perfil.informes.store')}}">
							{{ csrf_field() }}
							@if ($informe != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif



							<div class="row align-items-end">
								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Equipo <span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="tipo_actividad" value="{{$informe != NULL ? $informe->equipo : old('equipo')}}" readonly="" disabled>
									</div>
								</div>

								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Tipo de equipo<span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="tipo_actividad" value="{{$informe != NULL ? $informe->tipo_equipo : old('tipo_equipo')}}" readonly="" disabled="">
									</div>
								</div>
								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Estado del equipo<span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="tipo_actividad" value="{{$informe != NULL ? $informe->estado_equipo : old('estado_equipo')}}" readonly="" disabled="">
									</div>
								</div>

								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Motivo <span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="asunto" value="{{$informe != NULL ? $informe->motivo : old('motivo')}}" readonly="" disabled="">
									</div>
								</div>
								<div class="col-md-6 col-xl-4">
									<div class="form-group">
										<label>Modalidad <span class="text-danger">*</span></label>
										<input type="text" class="form-control disabled" name="asunto" value="{{$informe != NULL ? $informe->modalidad : old('modalidad')}}" readonly="" disabled="">
									</div>
								</div>

                  <div class="col-md-12 col-xl-6">
  									<div class="form-group">
  										<label>Subir documento</label>
                      <div class="dropzone dropzone-default" id="kt_dropzone_3">
                        <div class="dropzone-msg dz-message needsclick">
                          <h6 class="dropzone-msg-title">Soltar documento aquí or click para seleccionar.</h6>
                          <span class="dropzone-msg-desc">PDF, .doc, .docx</span>
                        </div>
                      </div>
  									</div>
  								</div>



							</div>

							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$informe != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.perfil.informes.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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
<script src="{{asset('js/pages/crud/file-upload/dropzonejs.js')}}"></script>
@endsection
