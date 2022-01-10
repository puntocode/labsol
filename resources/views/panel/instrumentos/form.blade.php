@extends('layouts.panel')

@section('title')Instrumento |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">Istrumento <small class="font-weight-lighter">| {{ (isset($instrumento)) ? 'Editar' : 'Crear' }}</small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.instrumentos.index') }}" class="as-text text-hover-primary">
                                <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Ir al listado
                            </a>
                            <hr>
                        </div>

                        @if (isset($instrumento))
                            <div class="flex-grow-1">
                                <a href="{{ route('panel.instrumentos.create') }}" class="as-text text-hover-primary" title="Eliminar este Patrón">
                                    <i class="far fa-plus-square text-hover-primary mr-2"></i> Nuevo Instrumento
                                </a>
                                <hr>
                            </div>

                        @endif

					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title pt-8 border-bottom w-100">
                            <h3 class="font-weight-bolder text-dark">Datos del Instrumento <small class="text-danger pl-2"> *Campos requeridos</small></h3>
                        </div>
                    </div>
                    <instrumento-form :instrumento="{{ json_encode($instrumento) }}"></instrumento-form>
                </div>
            </div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const indexRoute  = `{{ route('panel.instrumentos.index') }}`
        const storeRoute  = `{{ route('panel.instrumentos.store') }}`

        window.routes = {
            'store' : storeRoute,
            'index' : indexRoute,
        }
    </script>
@endsection
