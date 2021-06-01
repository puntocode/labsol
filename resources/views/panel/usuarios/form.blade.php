@extends('layouts.panel')

@section('title')Usuarios |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Usuarios
			<small class="font-weight-lighter">
				@if($usuario != NULL)
					| {{isset($view_mode) && $view_mode == 'readonly' ? 'Ver': 'Editar'}}: {{$usuario->nombre}} </strong>
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
									<a href="{{route('panel.usuarios.index')}}" class="as-text text-hover-primary" title="Ir a listado de usuarios">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
									</a>
								</li>

								@if(in_array('crear', $role_actions))
									<li><hr></li>

									<li class="mb-5">
										<a href="{{route('panel.usuarios.create')}}" class="as-text text-hover-primary" title="Crear nuevo usuario">
											<i class="far fa-plus-square text-hover-primary"></i>
											Crear nuevo
										</a>
									</li>
								@endif

								@if($usuario != NULL && in_array('eliminar', $role_actions))
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
							<h3 class="card-title font-weight-bolder text-dark">Datos de usuario</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($usuario != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $usuario != NULL ? route('panel.usuarios.update', ($usuario->id -1)) : route('panel.usuarios.store')}}">
							{{ csrf_field() }}
							@if ($usuario != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif
							<div class="row align-items-end">

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Nombre y Apellido <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nombre" required value="{{$usuario != NULL ? $usuario->nombre : old('nombre')}}">
									</div>
								</div>
								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>C.I. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="cedula" required value="{{$usuario != NULL ? $usuario->cedula : old('cedula')}}">
									</div>
								</div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Codigo</label>
                    <input type="text" class="form-control" name="codigo" value="{{$usuario != NULL ? $usuario->codigo : old('codigo')}}">
                  </div>
                </div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Rol <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="rol" required value="{{$usuario != NULL ? $usuario->rol : old('rol')}}">
									</div>
								</div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{$usuario != NULL ? $usuario->email : old('email')}}">
                  </div>
                </div>

                <div class="col-12 col-lg-4">
                  <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" value="{{$usuario != NULL ? $usuario->telefono : old('telefono')}}">
                  </div>
                </div>



							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$usuario != NULL ? 'Guardar' : 'Crear Usuario'}}</button>
								@else
									<a href="{{route('panel.usuarios.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
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
  $('#prioridadSelect').select2({
    placeholder: "Seleccione una prioridad"
  });

  $('#usuarioselect').select2({
    placeholder: "Seleccione un usuario"
  });
  $('#usuarioSelect').select2({
    placeholder: "Seleccione un usuario"
  });

  </script>
@endsection
