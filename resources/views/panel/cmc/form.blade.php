@extends('layouts.panel')

@section('title')CMC |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">CMC <small class="font-weight-lighter">| {{ (isset($cmc)) ? 'Editar' : 'Crear' }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
						{{-- @if (isset($cmc))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.clientes.ficha', $cmc) }}" class="as-text text-hover-primary" title="Ver detalles del Cliente">
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
                        @endif --}}


                        <div class="flex-grow-1">
                            <a href="{{ route('panel.cmc.index') }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas {{ (isset($cmc)) ? 'fa-list' : 'fa-arrow-left' }} text-hover-primary mr-2"></i> Ir a la Lista
                            </a>
                        </div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title pt-8 border-bottom w-100 mb-0">
                            <h3 class="font-weight-bolder text-dark">CMC <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <cmc-form></cmc-form>
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        // const showRoute   = `{{ route('panel.clientes.show',   isset($cliente) ? $cliente->id : 0) }}`
        // const updateRoute = `{{ route('panel.clientes.update', isset($cliente) ? $cliente->id : 0) }}`
        // const fichaRoute  = `{{ route('panel.clientes.ficha',  isset($cliente) ? $cliente->id : 0) }}`
        // const indexRoute  = `{{ route('panel.clientes.index') }}`
        // const storeRoute  = `{{ route('panel.clientes.store') }}`

        // window.routes = {
        //     'show'  : showRoute,
        //     'store' : storeRoute,
        //     'update': updateRoute,
        //     'ficha' : fichaRoute,
        //     'index' : indexRoute,
        // }
    </script>
@endsection
