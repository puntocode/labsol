@extends('layouts.panel')
@section('title')Calibración |@endsection

@section('content')

	<div class="container-fluid">
		<h3 class="card-label mb-8">Calibración <small class="font-weight-lighter">| Crear</small>
		</h3>

        <div class="row">
			<div class="col-lg-12 col-xl-12">
				<div class="card card-custom mb-5">
					<div class="card-body">
                        <calibracion-form :data="{{ json_encode($expediente) }}"></calibracion-form>
                    </div>
                </div>
            </div>
        </div>

		{{-- <div class="row">

			<div class="col-lg-12 col-xl-12">
				<!--begin::Card-->
				<div class="card card-custom mb-5">

					<div class="card-body">
            <div class="wizard wizard-2" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
              <!--begin: Wizard Nav-->
              <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                <!--begin::Wizard Step 1 Nav-->
                <div class="wizard-steps">
                  <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Nro. Expediente</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 1 Nav-->
                  <!--begin::Wizard Step 2 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Solicitante</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 2 Nav-->
                  <!--begin::Wizard Step 3 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Datos del equipo calibrado</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 3 Nav-->
                  <!--begin::Wizard Step 4 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Patrones utilizados</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 4 Nav-->
                  <!--begin::Wizard Step 5 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Datos de calibración</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 5 Nav-->
                  <!--begin::Wizard Step 6 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Valores obtenidos</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 6 Nav-->
                  <!--begin::Wizard Step 7 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Datos finales de la calibración</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 7 Nav-->
                  <!--begin::Wizard Step 8 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                    <div class="wizard-wrapper">

                      <div class="wizard-label">
                        <h3 class="wizard-title">Firma</h3>
                      </div>
                    </div>
                  </div>
                  <!--end::Wizard Step 8 Nav-->
                </div>
              </div>
              <!--end: Wizard Nav-->
              <!--begin: Wizard Body-->
              <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                <!--begin: Wizard Form-->
                <div class="row">
                  <div class="offset-xxl-2 col-xxl-8">
                      <form class="form mb-5"  id="kt_form" method="POST" action="{{ $calibracion != NULL ? route('panel.calibracion.update', ($calibracion->id -1)) : route('panel.calibracion.store')}}">
                        {{ csrf_field() }}

                      <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                        <h4 class="mb-10 font-weight-bold text-dark">Selecciona un Expediente</h4>
                        <div class="form-group">
                          <label>Expediente Nro</label>
                          <select class="form-control datatable-input" name="nro_expediente" id="expedienteSelect">
                            @foreach ($expedientes as $i => $expediente)
                              <option value=""></option>
                              <option value="{{$expediente->nro_expediente}}">{{$expediente->nro_expediente}}</option>
                            @endforeach
                          </select>
                        </div>

                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Solicitante</h4>
                        <div class="row">
                          <div class="col-xl-8">
                            <div class="form-group">
                              <label>Solicitante</label>
                              <select class="form-control datatable-input" name="solicitante" id="solicitanteSelect">
                                @foreach ($clientes as $i => $cliente)
                                  <option value=""></option>
                                  <option value="{{$cliente->razon_social}}">{{$cliente->razon_social}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Datos del equipo calibrado</h4>
                        <div class="row">
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Instrumento</label>
                              <select class="form-control datatable-input" name="solicitante" id="instrumentoSelect">
                                @foreach ($instrumentos as $i => $instrumento)
                                  <option value=""></option>
                                  <option value="{{$instrumento->nombre}}">{{$instrumento->nombre}}</option>
                                @endforeach
                              </select>
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Identificación <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="identificacion" required value="0">
                            </div>
                            <!--end::Input-->
                          </div>

                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Marca</label>
                              <select class="form-control" name="marca" id="marcaSelect">
                                <option value="Genérico">Genérico</option>
                                <option value="Otro">Otro</option>
                              </select>
                              <br>
                              <input type="text" class="form-control" name="input_marca" id="input_marca" required disabled placeholder="Especificar marca" value="{{$calibracion != NULL ? $calibracion->marca : old('marca')}}">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Modelo</label>
                              <input type="text" class="form-control" name="modelo" value="{{$calibracion != NULL ? $calibracion->modelo : old('modelo')}}">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>N° de serie</label>
                              <input type="text" class="form-control" name="nro_serie" value="{{$calibracion != NULL ? $calibracion->nro_serie : old('nro_serie')}}">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Intervalo<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="intervalo" value="(0 a 600) A">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Resolucion<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="resolucion" value="0,01">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-6 col-xl-6">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Tipo<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="tipo" value="Digital">
                            </div>
                            <!--end::Input-->
                          </div>
                        </div>
                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Patrones utilizados</h4>
                        <!--begin::Select-->
                        <div class="form-group">
                          <label>Identificación:<span class="text-danger">*</span></label>
                          <select name="patron1" required class="form-control form-control-lg" id="patronSelect">
                            @foreach ($patrones as $i => $patron)
                              <option value=""></option>
                              <option value="{{$patron->descripcion}}">{{$patron->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Select-->
                        <div class="form-group">
                          <label>Identificación:</label>
                          <select name="patron2" class="form-control form-control-lg" id="patronSelect2">
                            @foreach ($patrones as $i => $patron)
                              <option value=""></option>
                              <option value="{{$patron->descripcion}}">{{$patron->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Select-->
                        <div class="form-group">
                          <label>Identificación:</label>
                          <select name="patron3" class="form-control form-control-lg" id="patronSelect3">
                            @foreach ($patrones as $i => $patron)
                              <option value=""></option>
                              <option value="{{$patron->descripcion}}">{{$patron->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Select-->
                        <div class="form-group">
                          <label>Identificación:</label>
                          <select name="patron4" class="form-control form-control-lg" id="patronSelect4">
                            @foreach ($patrones as $i => $patron)
                              <option value=""></option>
                              <option value="{{$patron->descripcion}}">{{$patron->descripcion}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!--end::Select-->

                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Datos de calibración</h4>
                        <div class="row">
                          <div class="col-12 col-lg-6 col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Fecha de calibración <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="fecha_calibracion" id="fecha_calibracion" required value="{{$calibracion != NULL ? $calibracion->fecha_calibracion : old('fecha_calibracion')}}">
                            </div>
                            <!--end::Input-->
                          </div>
                          <div class="col-12 col-lg-12 col-xl-8">
                            <div class="row align-items-center">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="lugar">Lugar de calibración<span class="text-danger">*</span></label>
                                  <select class="form-control datatable-input" name="lugar" id="lugarSelect">
                                    <option value=""></option>
                                    <option value="Laboratorio Labsol" selected>Laboratorio Labsol</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                </div>

                              </div>
                              <div class="col-md-6 lugar-otro">
                                <div class="form-group">
                                  <label>Especificar lugar</label>
                                  <input type="text" class="form-control" name="lugar_otro" id="input_lugar" value="{{old('lugar')}}" disabled>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-12 col-lg-4">
                            <div class="form-group">
                              <label for="temperatura">Temperatura<span class="text-danger">*</span></label>
                              <input type="text" class="form-control temperatura-mask" name="temperatura" value="15">
                            </div>
                          </div>
                          <div class="col-12 col-lg-4">
                            <div class="form-group">
                              <label>Humedad relativa<span class="text-danger">*</span></label>
                              <input type="text" class="form-control porcentaje-mask" name="humedad_relativa" value="15">
                            </div>
                          </div>
                          <div class="col-xl-4">
                            <div class="form-group">
                              <label>Procedimiento<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="procedimiento" required value="LS-PRO-C03 Rev.00">
                            </div>
                          </div>
                          <div class="col-xl-12">
                            <div class="form-group">
                              <label>Observaciones</label>
                              <textarea name="observaciones" rows="8" cols="80" class="form-control" value="{{$calibracion != NULL ? $calibracion->observaciones : old('observaciones')}}"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <!--begin::Section-->
                        <h4 class="mb-10 font-weight-bold text-dark">Valores obtenidos</h4>
                        <h6 class="font-weight-bolder mb-3">CORRIENTE ELÉCTRICA (A) 50 Hz</h6>
                        <div id="kt_repeater_1">
                            <div class="form-group row" id="kt_repeater_1">
                                <div data-repeater-list="" class="col-lg-12">
                                    <div data-repeater-item class="form-group row align-items-center">
                                        <div class="col-md-3 pb-2">
                                            <input type="text" class="form-control" placeholder="IP (A)"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-3 pb-2">
                                            <input type="text" class="form-control" placeholder="Desvío"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-3 pb-2">
                                            <input type="text" class="form-control" placeholder="IP (A) corregido"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-3 pb-2">
                                            <input type="text" class="form-control" placeholder="IEC (A)"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-3 pb-2">
                                            <input type="text" class="form-control" placeholder="Error"/>
                                            <div class="d-md-none mb-2"></div>
                                        </div>
                                        <div class="col-md-2 pb-2">
                                            <a href="javascript:;" data-repeater-delete="" title="Eliminar fila" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                <i class="la la-trash-o pr-0"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <a href="javascript:;" data-repeater-create="" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-primary">
                                        <i class="la la-plus"></i>Agregar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-5"></div>
                        <!--end::Section-->

                        <!--begin::Section-->
                        <div class="row">
                          <div class="col-md-3">
                              <label>Desvío máx IP:</label>
                              <input type="text" class="form-control" placeholder="Desvío máx IP"/>
                              <div class="d-md-none mb-2"></div>
                          </div>
                          <div class="col-md-3">
                              <label>Desvío máx IEC:</label>
                              <input type="text" class="form-control" placeholder="Desvío máx IEC"/>
                              <div class="d-md-none mb-2"></div>
                          </div>
                        </div>
                        <!--end::Section-->
                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Datos finales de la calibración</h4>
                        <div class="row">
                          <div class="col-12 col-lg-6 col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                              <label>Fecha de culminación <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="fecha_fin" id="fecha_fin" required value="{{$calibracion != NULL ? $calibracion->fecha_fin : old('fecha_fin')}}">
                            </div>
                            <!--end::Input-->
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-12 col-lg-4">
                            <div class="form-group">
                              <label for="temperatura_final">Temperatura<span class="text-danger">*</span></label>
                              <input type="text" class="form-control temperatura-mask" name="temperatura_final" value="15">
                            </div>
                          </div>
                          <div class="col-12 col-lg-4">
                            <div class="form-group">
                              <label for="humedad_final">Humedad relativa<span class="text-danger">*</span></label>
                              <input type="text" class="form-control porcentaje-mask" name="humedad_final" value="15">
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="pb-5" data-wizard-type="step-content">
                        <h4 class="mb-10 font-weight-bold text-dark">Firma</h4>
                        <div class="row">
                          <div class="col-12 col-lg-6">
                            <div class="form-group">
                              <label for="firma">Firma<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="firma" value="{{$calibracion != NULL ? $calibracion->firma : old('firma')}}">
                            </div>
                          </div>
                        </div>
                        @if(\Auth::user()->hasRole('administrador'))
                          <div class="row">
                            <div class="col-12 col-lg-6">
                              <div class="form-group">
                                <label for="firma">Estado<span class="text-danger">*</span></label>
                                <select class="form-control" name="estado_calibracion" id="estado_calibracion">
                                  <option value="Rechazar">Rechazar</option>
                                  <option value="Posponer">Posponer</option>
                                  <option value="Devolver">Devolver</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="firma">Observaciones<span class="text-danger">*</span></label>
                                <textarea rows="3" cols="30" class="form-control" name="observaciones_estado" value="{{$calibracion != NULL ? $calibracion->firma : old('observaciones_estado')}}"></textarea>
                              </div>
                            </div>
                          </div>
                        @endif
                      </div>

                      <div class="d-flex justify-content-between border-top mt-5 pt-10">
                        <div class="mr-2">
                          <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Anterior</button>
                        </div>
                        <div>
                          <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Guardar</button>
                          <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
                        </div>
                      </div>
                      <!--end: Wizard Actions-->
                    </form>
                  </div>
                  <!--end: Wizard-->
                </div>
                <!--end: Wizard Form-->
              </div>
              <!--end: Wizard Body-->
            </div>
					</div>
				</div>
				<!--end::Card-->
			</div>
		</div> --}}
	</div>
@endsection

@section('rutas')
    <script>
        window.username = "{{ auth()->user()->fullname }}";
        const patronUmIde = "{{ route('panel.patron.ide.um') }}";
        const submultiplos = "{{ route('panel.patrones.unidades_medidas') }}";

        window.routes = {
            'patronUmIde': patronUmIde,
            'submultiplos': submultiplos
        }
    </script>
@endsection




