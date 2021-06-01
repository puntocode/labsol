@extends('layouts.panel')

@section('title')Facturación |@endsection

@section('styles')
	<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!--begin::Container-->
	<div class="container-fluid">
		<!--begin::Card-->
		<h3 class="card-label mb-8">Facturación <small class="font-weight-lighter">| Listado</small></h3>

		<div class="card card-custom">
			<div class="card-header border-0">
				<div class="card-title">
				</div>
				<div class="card-toolbar pt-7">
					@include('layouts.partials.extras.dropdown._export_list')

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
				<table class="table table-separate table-head-custom collapsed" id="tableFacturacion" style="width:100%">
					<thead>
						<tr>
							<th>N°</th>
							<th>Razón Social</th>
							<th>Fecha de emisión</th>
							<th>Estado</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($facturas as $i => $factura)
							<tr>
                <td>{{$factura->numero}}</td>
								<td>{{$factura->razon_social}}</td>
								<td>{{$factura->fecha_emision}}</td>
                <td>
                  <span class="badge
                  @if($factura->estado == 'Abonada')
                    badge-success
                  @else
                    badge-warning
                  @endif
                  ml-5 ml-md-0 mt-2 mt-md-0">{{$factura->estado}}
                </span>
                </td>
								<td>{{$factura->total}}</td>

							</tr>
						@endforeach
					</tbody>
				</table>
				<!--end: Datatable-->
			</div>
		</div>
		<!--end::Card-->
	</div>
@endsection

@section('scripts')
	<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

	<script>
		$(function() {
			oTable = $('#tableFacturacion').DataTable({
				responsive: true,
				"bLengthChange": false
			});

			$('#tableInpuntSearch').keyup(function(){
			    oTable.search($(this).val()).draw() ;
			});
		});
	</script>
@endsection
