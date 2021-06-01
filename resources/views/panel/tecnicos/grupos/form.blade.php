@extends('layouts.panel')

@section('title')Grupos de Técnicos |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Grupos de técnicos
			<small class="font-weight-lighter">
				@if($grupo_tecnico != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$grupo_tecnico->titulo}}</strong>
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
									<a href="{{route('panel.tecnicos.grupos.index')}}" class="as-text text-hover-primary" title="Ir a listado de grupos">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>	
								</li>

								@if(in_array('crear', $role_actions))

									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.tecnicos.grupos.create')}}" class="as-text text-hover-primary" title="Crear grupo de técnicos">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear grupo
										</a>
									</li>

									<li class="mb-5">
										<a href="{{route('panel.tecnicos.create')}}" class="as-text text-hover-primary" title="Crear nuevo técnico">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear técnico
										</a>	
									</li>
								@endif

								<li><hr></li>

								<li class="mb-5">
									<a href="{{route('panel.tecnicos.index')}}" class="as-text text-hover-primary" title="Ver listado de técnicos">
										<i class="far fa-user text-hover-primary"></i>
										Técnicos
									</a>	
								</li>

								@if($grupo_tecnico != NULL 	&& in_array('eliminar', $role_actions))							
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

						@if($grupo_tecnico != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>

					<div class="card-body">
					@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $grupo_tecnico != NULL ? route('panel.tecnicos.grupos.update', ($grupo_tecnico->id -1)) : route('panel.tecnicos.grupos.store')}}">
							{{ csrf_field() }}
							@if ($grupo_tecnico != NULL)
				              {{ method_field('PATCH') }}
				            @endif
					@else
				        <div class="mb-5 form-readonly">				        	
				    @endif
							<div class="row align-items-end">
								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Título <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="titulo" value="{{$grupo_tecnico != NULL ? $grupo_tecnico->titulo : old('titulo')}}">
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Encargado</label>
										<input type="text" class="form-control" name="encargado" value="{{$grupo_tecnico != NULL ? $grupo_tecnico->encargado : old('encargado')}}">
									</div>
								</div>
							</div>

							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')								
									<button class="btn btn-primary mx-auto">{{$grupo_tecnico != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.tecnicos.grupos.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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