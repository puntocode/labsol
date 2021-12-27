@extends('layouts.panel')

@section('title')Expedientes |@endsection
	@section('styles')
		<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
	@endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">
		<h3 class="card-label mb-8">Expediente {{ $data['expediente']->number }}
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
				<div class="card card-custom">
                    <div class="card-body">
                        <div class="card-toolbar position-relative">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab_datos">
                                        <span class="nav-text">Datos Generales</span>
                                    </a>
                                </li>

                                @if (isset($patrones))
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_historial">
                                            <span class="nav-text">Datos de Calibración</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab_datos" role="tabpanel" aria-labelledby="tab_datos">
                                <div class="shadow-none card card-custom gutter-b card-stretch">
                                    <expediente-form :data="{{ json_encode($data) }}"></expediente-form>
				                </div>
				            </div>

                            @if (isset($patrones))
                                <div class="tab-pane fade" id="tab_historial" role="tabpanel" aria-labelledby="tab_historial">
                                    <div class="shadow-none card card-custom gutter-b card-stretch">
                                        <div class="pb-16 card-body">
                                            @include('panel.calibracion.certificados.partials.ficha')
                                        </div>
                                    </div>
                                </div>

                            @endif
				        </div>
				    </div>
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


