@extends('layouts.panel')

@section('title')Incertidumbre |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Incertidumbre
			<small class="font-weight-lighter">
				@if($incertidumbre->exists)
					| Editar
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
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
				<!--begin::Card-->
				<div class="card card-custom mb-5">
					<div class="pb-0 border-0 card-header">
						<div class="pt-8 card-title border-bottom w-100">
							<h3 class="font-weight-bolder text-dark">Datos de incertidumbre <small class="pl-2 text-danger"> *Campos requeridos</small></h3>
						</div>
					</div>

					<div class="card-body">
						<form class="mb-5" method="POST" enctype="multipart/form-data"
							action="{{ $incertidumbre->exists ? route('panel.incertidumbre.update', $incertidumbre) : route('panel.incertidumbre.store')}}">
							{{ csrf_field() }}
							@if ($incertidumbre->exists)
				              {{ method_field('PATCH') }}
				            @endif

							<div class="row">

								<div class="col-12">
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

								<div class="col-12 col-lg-4">
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

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Tipo <span class="text-danger">*</span></label>
                    					<select class="form-control" name="tipo" required>
											<option value="">Seleccione una opción</option>
											<option value="A" {{ old('tipo', $incertidumbre->tipo)=='A' ? 'selected' : '' }}>A (n-1 Grados de Libertad)</option>
											<option value="B" {{ old('tipo', $incertidumbre->tipo)=='B' ? 'selected' : '' }}>B (∞ Grados de Libertad)</option>
										</select>

										@error('tipo')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Distribución <span class="text-danger">*</span></label>
																								<input type="text" class="form-control" name="distribucion" required
											value="{{ old('distribucion', $incertidumbre->distribucion) }}">

										@error('distribucion')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Fórmula (Nombre)<span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="formula" required
											value="{{ old('formula', $incertidumbre->formula) }}">

										@error('formula')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Fórmula (Imagen)<span class="text-danger">*</span></label>
										<div class="custom-file">
											<input type="file" name="formula_img" class="custom-file-input" accept=".jpg, .jpeg"
												{{ $incertidumbre->exists ? '' : 'required' }}>
											<label class="custom-file-label" for="formula_img" data-browse="Buscar">
												@if ($incertidumbre->exists)
													{{ "$incertidumbre->formula.jpg" }}
												@else
													Seleccione una Imagen .jpg
												@endif
											</label>
										</div>

										@error('formula_img')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Fuente <span class="text-danger">*</span></label>
																								<input type="text" class="form-control" name="fuente" required
											value="{{ old('fuente', $incertidumbre->fuente) }}">

										@error('fuente')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Divisor <span class="text-danger">*</span></label>
                    					<input type="text" class="form-control" name="divisor" required
											value="{{ old('divisor', $incertidumbre->divisor) }}">

										@error('divisor')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Coeficiente<span class="text-danger">*</span></label>
                    					<input type="number" class="form-control" name="coeficiente" required
											value="{{ old('coeficiente', $incertidumbre->coeficiente) }}">

										@error('coeficiente')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Contribución du<span class="text-danger">*</span></label>
                    					<input type="number" class="form-control" name="contribucion_du" required
											value="{{ old('contribucion_du', $incertidumbre->contribucion_du) }}">

										@error('contribucion_du')
											<span class="error invalid-feedback" style="display:inline">{{ $message }}</span>
										@enderror
									</div>
								</div>

							</div>

							<div class="row border-top">
								<div class="text-right col">
									<a href="{{route('panel.incertidumbre.index')}}" class="mt-10 btn btn-secondary" title="Volver a listado">Volver</a>

									<button type="submit" class="mt-10 btn btn-primary">
										{{ $incertidumbre->exists ? 'Guardar' : 'Crear' }}
									</button>
								</div>
							</div>

						</form>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection
