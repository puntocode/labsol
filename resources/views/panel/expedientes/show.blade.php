@extends('layouts.panel')

@section('title')Expedientes |@endsection
	@section('styles')
		<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
	@endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Expediente
			<small class="font-weight-lighter"> | Ficha</small>
		</h3>

		<div class="row">
			<div class="col-lg-3 col-xl-2">
				<div class="card card-custom gutter-b card-fixed">
					<div class="card-body ">
						<div class="flex-grow-1">
							<ul class="list-unstyled px-0">
								<li class="mb-5">
									<a href="{{route('panel.expedientes.index')}}" class="as-text text-hover-primary" title="Ir a listado de expedientes">
										<i class="fas fa-arrow-left text-hover-primary"></i>
										Ir a listado
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
							<h3 class="card-title font-weight-bolder text-dark">Expediente:
                                <strong class="ml-2" id="expediente-number">{{$data['expediente']->number}}</strong>
                            </h3>
						</div>
					</div>

					<expediente-form :data="{{ json_encode($data) }}"></expediente-form>
				</div>
				<!--end::Card-->
			</div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const updateTecnicos = "{{ route('panel.expedientes.update_tecnicos') }}";
        const tecnicos = "{{ route('panel.usuarios.tecnicos') }}";
        window.routes = {
            'updateTecnicos': updateTecnicos,
            'tecnicos': tecnicos,
        }
    </script>
@endsection

@section('scripts')
    <script>
        const number = $('#expediente-number').text();
        $('#nro-expediente').html(number);
    </script>
@endsection


