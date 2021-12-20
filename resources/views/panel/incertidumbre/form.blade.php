@extends('layouts.panel')

@section('title')Incertidumbre |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Incertidumbre
			<small class="font-weight-lighter">
				@if($incertidumbre->exists)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$incertidumbre->componente}} </strong>
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
									<a href="{{route('panel.incertidumbre.index')}}" class="as-text text-hover-primary" title="Ir a listado de incertidumbre">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if(in_array('crear', $role_actions))
									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.incertidumbre.create')}}" class="as-text text-hover-primary" title="Crear nuevo usuario">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear nuevo
										</a>
									</li>
								@endif

								@if($incertidumbre->exists && in_array('eliminar', $role_actions))
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
							<h3 class="card-title font-weight-bolder text-dark">Datos de incertidumbre</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
							<form class="mb-5" method="POST" action="{{ $incertidumbre->exists ? route('panel.incertidumbre.update', ($incertidumbre)) : route('panel.incertidumbre.store')}}">
							{{ csrf_field() }}
							@if ($incertidumbre->exists)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row">

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Contribución <span class="text-danger">*</span></label>
                    					<select class="form-control" name="contribucion" required>
											<option value="">Seleccione una opción</option>
											<option value="EBC" {{ old('contribucion', $incertidumbre->contribucion)=='EBC' ? 'selected' : '' }}>EBC</option>
											<option value="PATRON" {{ old('contribucion', $incertidumbre->contribucion)=='PATRON' ? 'selected' : '' }}>PATRÓN</option>
										</select>

										@error('contribucion')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Tipo <span class="text-danger">*</span></label>
                    					<select class="form-control" name="tipo" required>
											<option value="">Seleccione una opción</option>
											<option value="A" {{ old('tipo', $incertidumbre->tipo)=='A' ? 'selected' : '' }}>A</option>
											<option value="B" {{ old('tipo', $incertidumbre->tipo)=='B' ? 'selected' : '' }}>B</option>
										</select>

										@error('tipo')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label>Nombre <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="nombre" required
											value="{{ old('nombre', $incertidumbre->nombre) }}">

										@error('nombre')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Distribución <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="distribucion" required
											value="{{ old('distribucion', $incertidumbre->distribucion) }}">

										@error('distribucion')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Fórmula <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="formula" required
											value="{{ old('formula', $incertidumbre->formula) }}">

										@error('formula')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Fuente <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="fuente" required
											value="{{ old('fuente', $incertidumbre->fuente) }}">

										@error('fuente')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Divisor <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="divisor" required
											value="{{ old('divisor', $incertidumbre->divisor) }}">

										@error('divisor')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Grados de libertad<span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="grados_libertad_for" required
											value="{{ old('grados_libertad_for', $incertidumbre->grados_libertad_for) }}">

										@error('grados_libertad_for')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Coeficiente<span class="text-danger">*</span></label>
                    					<input type="number" class="form-control" name="coeficiente" required
											value="{{ old('coeficiente', $incertidumbre->coeficiente) }}">

										@error('coeficiente')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Contribución<span class="text-danger">*</span></label>
                    					<input type="number" class="form-control" name="contribucion_du" required
											value="{{ old('contribucion_du', $incertidumbre->contribucion_du) }}">

										@error('contribucion_du')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{ $incertidumbre->exists ? 'Guardar' : 'Crear Incertidumbre' }}</button>
								@else
									<a href="{{route('panel.incertidumbre.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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
