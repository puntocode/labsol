@extends('layouts.panel')

@section('title')CMC |@endsection

@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
        <h3 class="card-label mb-8">CMC <small class="font-weight-lighter">| {{$procedimiento->code}}</small> </h3>

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
                    <div class="card-header border-0 pb-0">
                        <div class="card-title w-100 border-bottom mb-0">
                            <h3 class="font-weight-bolder">CMC</h3>
                        </div>
                    </div>

                    <cmc-form :procedimiento="{{ $procedimiento }}"></cmc-form>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const GET_PATRON  = "{{ route('panel.patron.code.get') }}";
        const INSERT_CMC  = "{{ route('panel.cmc.insert') }}";
        const UPDATE_CMC  = "{{ route('panel.cmc.update') }}";

        window.routes = {
            'getPatron': GET_PATRON,
            'insertCmc': INSERT_CMC,
            'updateCmc': UPDATE_CMC,
        }
    </script>
@endsection
