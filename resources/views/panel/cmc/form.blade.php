@extends('layouts.panel')

@section('title')CMC |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">CMC <small class="font-weight-lighter"></small> </h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom card-fixed gutter-b">
					<div class="card-body ">
                        <div class="flex-grow-1">
                            <a href="{{ route('panel.procedimientos.show', $procedimiento) }}" class="as-text text-hover-primary" title="Ir a listado de patrones">
                                <i class="fas fa-arrow-left text-hover-primary mr-2"></i> Vovler
                            </a>
                        </div>
					</div>
				</div>
			</div>

			<div class="col-lg-9 col-xl-10">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="card-title w-100 border-bottom mb-0 text-center">
                            <h3 class="font-weight-bolder">CMC - {{$procedimiento->code}}</h3>
                        </div>
                    </div>

                    <cmc-card :procedimiento="{{ $procedimiento }}"></cmc-card>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const GET_CMCS = "{{ route('panel.cmc.get') }}";
        const INSERT_CMC = "{{ route('panel.cmc.insert') }}";
        const UPDATE_CMC = "{{ route('panel.cmc.update') }}";
        const ELIMINAR_CMC = "{{ route('panel.cmc.delete') }}";
        const GET_SUBMULTIPLOS = "{{ route('panel.patrones.unidades_medidas') }}";

        window.routes = {
            'getCmcs': GET_CMCS,
            'insertar': INSERT_CMC,
            'eliminar': ELIMINAR_CMC,
            'actualizar': UPDATE_CMC,
            'getSubMultiplos': GET_SUBMULTIPLOS
        }
    </script>
@endsection
