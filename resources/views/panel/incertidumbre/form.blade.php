@extends('layouts.panel')

@section('title')Incertidumbre |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Incertidumbre
			<small class="font-weight-lighter">
				@if($incertidumbre != NULL)
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

								@if($incertidumbre != NULL && in_array('eliminar', $role_actions))
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

						@if($incertidumbre != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $incertidumbre != NULL ? route('panel.incertidumbre.update', ($incertidumbre->id -1)) : route('panel.incertidumbre.store')}}">
							{{ csrf_field() }}
							@if ($incertidumbre != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Simbolo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="simbolo" required value="{{$incertidumbre != NULL ? $incertidumbre->simbolo : old('simbolo')}}">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Componente <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="componente" required value="{{$incertidumbre != NULL ? $incertidumbre->componente : old('componente')}}">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Valor = Estimativa (xi)	</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Formula</label>
                    <input type="text" class="form-control" name="valor_formula" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Calculado</label>
                    <input type="text" class="form-control" name="valor_calculado" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Unidad</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Unidad</label>
										<input type="text" class="form-control" name="unidad" value="{{$incertidumbre != NULL ? $incertidumbre->unidad : old('unidad')}}">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Probabilidad	</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Tipo</label>
                    <input type="text" class="form-control" name="p_tipo" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Distribucion</label>
                    <input type="text" class="form-control" name="p_distribucion" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Divisor o (k)	</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Formula</label>
                    <input type="text" class="form-control" name="k_formula" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Calculado</label>
                    <input type="text" class="form-control" name="k_calculado" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Coeficiente de sensibilidad	</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Formula</label>
                    <input type="text" class="form-control" name="s_formula" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Calculado</label>
                    <input type="text" class="form-control" name="s_calculado" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Contribución para incertidumbre patrón</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Formula</label>
                    <input type="text" class="form-control" name="p_formula" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>ui</label>
                    <input type="text" class="form-control" name="ui" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Grados de libertad</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Formula Vi</label>
										<input type="text" class="form-control" name="l_formula_vi" value="">
									</div>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Calculado</label>
										<input type="text" class="form-control" name="l_calculado" value="">
									</div>
								</div>
								<div class="col-12">
									<h3 class="h4 border-bottom border-primary my-5 pb-3">Porcentual</h3>
								</div>
								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Porcentual</label>
										<input type="text" class="form-control" name="porcentual" value="{{$incertidumbre != NULL ? $incertidumbre->porcentual : old('porcentual')}}">
									</div>
								</div>

							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$incertidumbre != NULL ? 'Guardar' : 'Crear valor'}}</button>
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
