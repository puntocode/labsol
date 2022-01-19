@extends('layouts.panel')

@section('title')Expedientes |@endsection
	@section('styles')
		<link rel="stylesheet" href="{{asset('plugins/custom/kanban/kanban.bundle.css')}}">
	@endsection
@section('content')
	<!--begin::Container-->
	<div class="container-fluid">

        <div class="row mb-6">
            <div class="col-12 d-flex justify-content-between">
                <h3 class="card-label mb-8">Expediente {{ $expediente->number }}<small class="font-weight-lighter"> | Ficha</small></h3>

                @if ($expediente->expediente_estado_id !== 6)
                    <anular-calibracion :expediente_id="{{ $expediente->id }}" ></anular-calibracion>
                @endif
            </div>
        </div>

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
                                    <expediente-form :expediente="{{ $expediente }}"></expediente-form>
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


                {{-- <div class="card card-custom px-5">
                    <div class="card-header border-0">
                        <div class="card-title pt-8 d-flex justify-content-between w-100">
                            <h3 class="card-title font-weight-bolder">Expediente {{ $expediente->number }}</h3>
                            <span class="badge badge-{{$expediente->estados->color}}">{{ $expediente->estados->name }}</span>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        @include('panel.calibracion.certificados.partials.expediente')

                        @if ($expediente->expediente_estado_id > 2 && $expediente->expediente_estado_id !== 11)
                            @include('panel.calibracion.certificados.partials.ficha')
                        @endif
                    </div>
                </div> --}}


			</div>
		</div>
	</div>
@endsection

@section('rutas')
    <script>
        const RESULT_INCERTIDUMBRE = "{{ route('panel.incertidumbre.resultado') }}";
        const VALOR_INCERTIDUMBRE = "{{ route('panel.incertidumbre.valor') }}";
        const ESTADO_EXPEDIENTE = "{{ route('panel.expedientes.update_estado') }}";
        const UPDATE_TECNICOS = "{{ route('panel.expedientes.update_tecnicos') }}";
        const HISTORIAL = "{{ route('panel.expedientes.historial') }}";
        const TECNICOS = "{{ route('panel.usuarios.tecnicos') }}";


        window.asset = "{{ URL::asset('')  }}";
        window.routes = {
            'tecnicos': TECNICOS,
            'historial': HISTORIAL,
            'resultados': RESULT_INCERTIDUMBRE,
            'incertidumbre': VALOR_INCERTIDUMBRE,
            'updateTecnicos': UPDATE_TECNICOS,
            'estadoExpediente': ESTADO_EXPEDIENTE,
        }
    </script>
@endsection


