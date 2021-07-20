@extends('layouts.panel')

@section('title')Clientes |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">Clientes <small class="font-weight-lighter">| {{ (isset($cliente)) ? 'Editar' : 'Crear' }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						@if (isset($cliente))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.clientes.show', $cliente) }}" class="as-text text-hover-primary" title="Ver detalles del Cliente">
                                    <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al Cliente
                                </a>
                                <hr>
                            </div>

                            <div class="flex-grow-1">
                                <a href="{{ route('panel.clientes.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Cliente
                                </a>
                                <hr>
                            </div>

                            {{-- <div class="flex-grow-1">
                                <a href="{{ route('panel.patrones.destroy', $patrone) }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="fas fa-trash text-hover-primary mr-2"></i> Eliminar Patrón
                                </a>
                                <hr>
                            </div> --}}
                        @endif


                        <div class="flex-grow-1">
                            <a href="{{ route('panel.clientes.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas {{ (isset($cliente)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="font-weight-bolder text-dark">Datos de cliente <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                        </div>
                    </div>
                    <cliente-card id="{{ isset($cliente) ? $cliente->id : 0 }}"></cliente-card>
                </div>



				<!--begin::Card-->
				{{-- <div class="card card-custom mb-5">
					<div class="card-header border-0">
						<div class="card-title pt-8 d-block">
							<h3 class="card-title font-weight-bolder text-dark">Datos del cliente</h3>
							<p class="text-muted font-size-sm"><span class="text-danger">*</span> Campos requeridos</p>
						</div>

						@if($cliente != NULL)
							<div class="card-toolbar">
								@include('layouts.partials.extras.dropdown._export_list')
							</div>
						@endif
					</div>
					<div class="card-body">
						@if(!isset($view_mode) || $view_mode != 'readonly')
						<form class="mb-5" method="POST" action="{{ $cliente != NULL ? route('panel.clientes.update', ($cliente->id -1)) : route('panel.clientes.store')}}">
							{{ csrf_field() }}
							@if ($cliente != NULL)
				              {{ method_field('PATCH') }}
				            @endif
				        @else
				        	<div class="mb-5 form-readonly">
				        @endif

							<div class="row align-items-end">
								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Cliente <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="razon_social" required value="{{$cliente != NULL ? $cliente->razon_social : old('razon_social')}}">
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>RUC</label>
										<input type="text" class="form-control" name="documento" value="{{$cliente != NULL ? $cliente->documento : old('documento')}}">
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Nombre de contacto <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="nombre_contacto" required value="{{$cliente != NULL ? $cliente->nombre_contacto : old('nombre_contacto')}}">
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Teléfono/Cel <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="telefono" required value="{{$cliente != NULL ? $cliente->telefono : old('telefono')}}">
									</div>
								</div>

								<div class="col-12 col-lg-4">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" value="{{$cliente != NULL ? $cliente->email : old('email')}}">
									</div>
								</div>

								<div class="col-12 col-lg-8">
									<div class="form-group">
										<label>Dirección</label>
										<input type="text" class="form-control" name="direccion" value="{{$cliente != NULL ? $cliente->direccion : old('direccion')}}">
									</div>
								</div>


							</div>
							<div class="row mt-5">
								@if(!isset($view_mode) || $view_mode != 'readonly')
									<button class="btn btn-primary mx-auto">{{$cliente != NULL ? 'Guardar' : 'Crear'}}</button>
								@else
									<a href="{{route('panel.clientes.index')}}" class="btn btn-primary mx-auto" title="Volver a listado">Volver</a>
								@endif
							</div>
						@if(!isset($view_mode) || $view_mode != 'readonly')
							</form>
						@else
							</div>
						@endif
					</div>
				</div> --}}
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection
