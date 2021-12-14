@extends('layouts.panel')

@section('title')Usuarios |@endsection



@section('content')
    <div class="container-fluid">
        <h3 class="card-label mb-8">Usuarios
            <small class="font-weight-lighter">
                @if ($usuario != null)
                    | {{ isset($view_mode) && $view_mode == 'readonly' ? 'Ver' : 'Editar' }}: {{ $usuario->nombre }}
                    </strong>
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
                                    <a href="{{ route('panel.usuarios.index') }}" class="as-text text-hover-primary"
                                        title="Ir a listado de usuarios">
                                        <i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
                                    </a>
                                </li>

                                @if (isset($usuario))
                                    <li><hr> </li>
                                    <li class="mb-5">
                                        <a href="{{ route('panel.usuarios.create') }}" class="as-text text-hover-primary" title="Crear nuevo usuario">
                                            <i class="far fa-plus-square text-hover-primary"></i> Crear nuevo
                                        </a>
                                    </li>
                                    <li><hr></li>
                                    <li>
                                        <a href="#!" class="as-text text-hover-primary" title="Eliminar registro actual">
                                            <i class="fas fa-trash-alt text-hover-primary"></i> Eliminar
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-xl-10">
                <div class="card card-custom mb-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-block">
                            <h3 class="card-title font-weight-bolder text-dark">Datos de usuario</h3>
                            <p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
                        </div>

                        @if ($usuario != null)
                            <div class="card-toolbar">
                                @include('layouts.partials.extras.dropdown._export_list')
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <form class="mb-5" method="POST" action="{{ $usuario != null ? route('panel.usuarios.update', $usuario->id) : route('panel.usuarios.store') }}" autocomplete="off">
                            {{ csrf_field() }}

                            @if ($usuario != null)
                                {{ method_field('PATCH') }}
                            @endif

                            <div class="row align-items-end">
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Nombre<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required
                                        value="{{ $usuario != null ? $usuario->name : old('name') }}" autofocus>
                                        @error('name')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Apellido<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required
                                        value="{{ $usuario != null ? $usuario->last_name : old('last_name') }}">
                                        @error('last_name')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>C.I. <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="cedula" required value="{{ $usuario != null ? $usuario->cedula : old('cedula') }}">
                                    </div>
                                </div> --}}

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Codigo</label>
                                        <input type="text" class="form-control" name="uuid" value="{{ $usuario != null ? $usuario->uuid : old('uuid') }}">
                                        @error('uuid')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Rol <span class="text-danger">*</span></label>
                                        {{-- <input type="text" class="form-control" name="rol" required value="{{ $usuario != null ? $usuario->rol : old('rol') }}"> --}}
                                        <select class="form-control text-capitalize" name="role" id="sl-role" data-placeholder="Seleccione un rol">
                                            <option selected value="0" disabled>-- Selecciona un rol --</option>
                                            @foreach ($roles as $rol)
                                                <option class="text-capitalize" value="{{$rol->id}}" @if( old('role') == $rol->id || ($usuario != NULL && $usuario->roles[0]->id == $rol->id) ) selected @endif>
                                                    {{$rol->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $usuario != null ? $usuario->email : old('email') }}" required>
                                        @error('email')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <input type="tel" class="form-control" name="phone" value="{{ $usuario != null ? $usuario->phone : old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ $usuario != null ? $usuario->password : old('password') }}">
                                        @error('password')
                                            <span class="text-danger"><strong>Error: {{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Confirmar Contraseña</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                        value="{{ $usuario != null ? $usuario->password : old('password_confirmation') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-5 text-center">
                                <a href="{{ route('panel.usuarios.index') }}" class="btn btn-secondary mr-2" title="Volver a listado">Volver</a>
                                <button type="submit" class="btn btn-primary mx-auto">{{ $usuario != null ? 'Guardar' : 'Crear Usuario' }}</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
