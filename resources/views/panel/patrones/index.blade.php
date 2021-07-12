@extends('layouts.panel')

@section('title')Patrones |@endsection

{{-- @section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection --}}

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-8">
            <h3 class="card-label">Patrones <small class="font-weight-lighter">| Listado</small></h3>
            <a href="{{ route('panel.patrones.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Crear
                Patrón</a>
        </div>

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
                <table class="table table-separate table-head-custom collapsed" id="tablePatrones" style="width:100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Rango/Valor Nominal</th>
                            <th>Marca</th>
                            <th>Presición</th>
                            <th>Error Máximo</th>
                            <th>Periodo de Cal.</th>
                            <th>Nro. de Certificado</th>
                            <th>Última Calibración</th>
                            <th>Prox. Calibración</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patrones as $i => $patron)
                            <tr>
                                <td>{{ $patron->code }}</td>
                                <td>{{ $patron->description }}</td>
                                <td>{{ $patron->rank[0] }}</td>
                                <td>{{ $patron->brand }}</td>
                                <td>
                                    @if (count($patron->precision) == 1)
                                        {{ $patron->precision[0][0] }}
                                    @else
                                       @foreach ($patron->precision as $key => $precision )
                                            {{-- {{ $patron->precision[$key][0] }} --}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (count($patron->error_max) == 1)
                                        {{ $patron->error_max[0][0] }}
                                    @else
                                       @foreach ($patron->precision as $key => $precision )
                                            {{-- {{ $patron->precision[$key][0] }} --}}
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $patron->calibration_period }}</td>
                                <td>{{ $patron->certificate_no }}</td>
                                <td>{{ $patron->last_calibration }}</td>
                                <td>{{ $patron->next_calibration }}</td>
                                <td class="text-uppercase">{{ $patron->statusPattern->name }}</td>
                                <td>
                                    @can ('panel.database')
                                        <a href="{{ route('panel.patrones.show', $i) }}" class="btn btn-sm btn-clean btn-icon" title="Ver patrón">
                                            <i class="la la-eye text-primary"></i>
                                        </a>
                                    @endcan
                                    {{-- @elseif(in_array('editar', $role_actions))
                                        <a href="{{ route('panel.patrones.edit', $i) }}"
                                            class="btn btn-sm btn-clean btn-icon" title="Editar patrón">
                                            <i class="la la-edit"></i>
                                        </a>
                                    @endif

                                    @if (in_array('eliminar', $role_actions))
                                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon"
                                            title="Eliminar patrón">
                                            <i class="la la-trash"></i>
                                        </a>
                                    @endif --}}
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
    {{-- <script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
  		$(function() {
  			oTable = $('#tablePatrones').DataTable({
  				responsive: true,
  				"bLengthChange": false
  			});

  			$('#tableInpuntSearch').keyup(function(){
  			    oTable.search($(this).val()).draw() ;
  			});
  		});
  	</script> --}}
@endsection
