@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Cliente
			<small class="font-weight-lighter">| Editar</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.clientes.index')}}" class="as-text text-hover-primary" title="Ir a listado de clientes">
										<i class="fas fa-arrow-left text-hover-primary"></i> Ir a listado
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
					<div class="card-header border-0">
						<div class="card-title pt-8 d-block">
							<h3 class="card-title font-weight-bolder text-dark">Datos del cliente</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>
					</div>
					<div class="card-body">

						<form id="form-cliente" class="mb-5" method="POST" action="{{route('panel.clientes.update', $cliente->id)}}" autocomplete="off">
                            @csrf
							<div class="row align-items-end">
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<label>Cliente <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="name" value="{{ $cliente->name }}">
									</div>
								</div>

                                <div class="col-12 col-lg-3">
									<div class="form-group">
										<label>Código <span class="text-danger">*</span></label>
										<input type="number" class="form-control" name="code" value="{{ $cliente->code }}">
									</div>
								</div>

								<div class="col-12 col-lg-3">
									<div class="form-group">
										<label>RUC</label>
										<input type="text" class="form-control" name="ruc" value="{{ $cliente->ruc }}">
									</div>
								</div>

							</div>

                            <div class="d-flex form-group justify-content-between align-items-end m-0 row">
                                <h3>Contacto</h3>
                                <div>
                                    <button id="add-form-contact" type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-primary">
                                        <i class="la la-plus"></i>Agregar
                                    </button>
                                    <button id="delete-form-contact" type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-danger"
                                        @if (count($cliente->contact) == 1) disabled @endif>
                                        <i class="la la-minus"></i>Eliminar
                                    </button>
                                </div>
                            </div>
                            <hr>

                            <div id="form-contact" class="form-group row">
                                @foreach ($cliente->contact as $key => $contacto)

                                    <div class="row w-100 pl-4">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Dirección <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contact[{{ $key }}][direccion]" value="{{ $contacto['direccion'] }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Nombre de Contacto<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contact[{{ $key }}][nombre]" value="{{ $contacto['nombre'] }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="contact[{{ $key }}][email]" value="{{ $contacto['email'] }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input type="number" class="form-control" name="contact[{{ $key }}][telefono]" value="{{ $contacto['telefono'] }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

							<div class="d-flex justify-content-center mt-5 row">
                                <a href="{{ route('panel.clientes.ficha', $cliente->id) }}" class="btn btn-secondary mr-2">Volver</a>
								<button class="btn btn-primary">Actualizar</button>
							</div>
                        </form>

					</div>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    <script src="{{asset('js/pages/crud/forms/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/pages/crud/forms/jquery-validation/dist/localization/messages_es_AR.min.js')}}"></script>
    <script src="{{ asset('js/pages/global/functions.js') }}"></script>
    <script>
        let contactId = "{{ count($cliente->contact) }}";
        const msgToas = 'Cliente actualizado correctamente!!'
        const _method = 'PATCH'
    </script>
    <script src="{{asset('js/pages/crud/panel/clientes/form.js')}}"></script>
@endsection
