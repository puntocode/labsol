@extends('layouts.panel')

@section('title')Incertidumbre |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Incertidumbre <small class="font-weight-lighter">| Listado</small></h3>

			<div class="card card-custom">
				<div class="card-header border-0">
					<div class="card-title">
					</div>
					<div class="card-toolbar pt-7">
						@include('layouts.partials.extras.dropdown._export_list')

						@if(in_array('crear', $role_actions))
							<!--begin::Button-->
							<a href="{{route('panel.incertidumbre.create')}}" class="btn btn-primary font-weight-bolder mb-5">
							<i class="la la-plus"></i>Crear valor</a>
							<!--end::Button-->
						@endif
					</div>
				</div>

				<div class="card-body pt-0">
					<!--begin: Search Form-->
					<form class="mb-15">
						<div class="input-icon float-left">
							<input type="text" class="form-control" placeholder="Buscar..." id="tableInpuntSearch">
							<span>
								<i class="flaticon2-search-1 icon-md"></i>
							</span>
						</div>
					</form>
					<!--end: Search form-->

					<!--begin: Datatable-->
					<table class="table table-separate table-bordered table-head-custom collapsed " id="tableIncertidumbre" style="width:100%">
						<thead>
							<tr>
								<th rowspan="2">Símbolo</th>
                <th rowspan="2">Componente</th>
								<th colspan="2">Valor = Estimativa (xi)</th>
								<th rowspan="2">Unidad</th>
								<th colspan="2">Probabilidad</th>
								<th colspan="2">Divisor o (k)	</th>
                <th colspan="2">Coeficiente de sensibilidad (ci)	</th>
                <th colspan="2">Contribución para incertidumbre patrón	</th>
                <th colspan="2">Grados de libertad	</th>
                <th>Porcentual</th>
                <th rowspan="2">Acciones</th>
							</tr>
              <tr>
                <th>Formula</th>
                <th>Calculado</th>
                <th>Tipo</th>
                <th>Distribucion</th>
                <th>Formula</th>
                <th>Calculado</th>
                <th>Formula</th>
                <th>Calculado</th>
                <th>Formula</th>
                <th>ui</th>
                <th>Formula vi</th>
                <th>Calculado</th>
                <th>[%]</th>
              </tr>
						</thead>
						<tbody>
							@foreach ($incertidumbre as $i => $inc)
								<tr>
                  <td>{{$inc->simbolo}}</td>
                  <td>{{$inc->componente}}</td>
									@foreach ($inc->valor as $i => $val)
										<td>{{$val->formula}}</td>
										<td>{{$val->calculado}}</td>
									@endforeach
                  <td>{{$inc->unidad}}</td>
									@foreach ($inc->probabilidad as $i => $prob)
										<td>{{$prob->tipo}}</td>
										<td>{{$prob->distribucion}}</td>
									@endforeach
									@foreach ($inc->divisor as $i => $div)
										<td>{{$div->formula}}</td>
										<td>{{$div->distribucion}}</td>
									@endforeach
									@foreach ($inc->coeficiente_sensibilidad as $i => $cs)
										<td>{{$cs->formula}}</td>
										<td>{{$cs->calculado}}</td>
									@endforeach
									@foreach ($inc->contribucion_patron as $i => $cp)
										<td>{{$cp->formula}}</td>
										<td>{{$cp->ui}}</td>
									@endforeach
									@foreach ($inc->grados_libertad as $i => $gl)
										<td>{{$gl->formula_vi}}</td>
										<td>{{$gl->calculado}}</td>
									@endforeach
                  <td>{{$inc->porcentual}}</td>
								<td nowrap="nowrap">
									@if(in_array('ver', $role_actions))
										<a href="{{route('panel.incertidumbre.show', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Ver valor">
											<i class="la la-eye text-primary"></i>
										</a>
									@elseif(in_array('editar', $role_actions))
										<a href="{{route('panel.incertidumbre.edit', $i)}}" class="btn btn-sm btn-clean btn-icon" title="Editar valor">
											<i class="la la-edit"></i>
										</a>
									@endif

										@if(in_array('eliminar', $role_actions))
											<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon" title="Eliminar valor">
												<i class="la la-trash"></i>
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<!--end: Datatable-->
				</div>
			</div>
		</div>
	@endsection

	@section('scripts')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('js/pages/crud/datatables/basic/headers.js')}}"></script>

		<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
		<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <script>
  		$(function() {
  			oTable = $('#tableIncertidumbre').DataTable({
  				responsive: true,
  				"bLengthChange": false
  			});

  			$('#tableInpuntSearch').keyup(function(){
  			    oTable.search($(this).val()).draw() ;
  			});
  		});
  	</script>
	@endsection
