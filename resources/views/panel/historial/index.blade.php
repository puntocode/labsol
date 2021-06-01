@extends('layouts.panel')

@section('title')Historial de cambios |@endsection

	@section('styles')
		<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endsection

	@section('content')
		<div class="container-fluid">
			<h3 class="card-label mb-8">Historial de cambios</h3>

			<div class="card card-custom">
        <div class="card-header border-0">
          <div class="card-title">
          </div>
          <div class="card-toolbar pt-7">
            @include('layouts.partials.extras.dropdown._export_list')

            @if(in_array('crear', $role_actions))

            @endif
          </div>
        </div>
				<div class="card-body pt-0">
          <div class="card-toolbar position-relative">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab_patrones">
                  <span class="nav-text">Patrones</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab_equipos">
                  <span class="nav-text">Equipos</span>
                </a>
              </li>


            </ul>
          </div>
            <div class="tab-content">
          <div class="tab-pane fade show active" id="tab_patrones" role="tabpanel" aria-labelledby="tab_patrones">
            <table class="table table-separate table-head-custom collapsed" id="tableHistorialPatrones">
              <thead>
                <tr>
                  <td>Fecha</td>
                  <td>Identificacion</td>
                  <td>Descripcion</td>
                  <td>Encargado</td>
                  <td>Observaciones</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>27/04/2021</td>
                  <td>PCE-07</td>
                  <td>Multicalibrador eléctrico</td>
                  <td>Sergio Martinez</td>
                  <td>Lorem ipsum</td>
                </tr>
                <tr>
                  <td>03/05/2021</td>
                  <td>PCE-07</td>
                  <td>Termohigrometro	</td>
                  <td>Marcos Acosta</td>
                  <td>Lorem ipsum</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="tab_equipos" role="tabpanel" aria-labelledby="tab_equipos">

            <table class="table table-separate table-head-custom collapsed" id="tableHistorialEquipos">
              <thead>
                <tr>
                  <td>Fecha</td>
                  <td>Equipo</td>
                  <td>Servicio</td>
                  <td>Encargado</td>
                  <td>Observaciones</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>27/04/2021</td>
                  <td>Equipo 1</td>
                  <td>Servicio 2</td>
                  <td>Sergio Martinez</td>
                  <td>Lorem ipsum</td>
                </tr>
                <tr>
                  <td>03/05/2021</td>
                  <td>Equipo 2</td>
                  <td>Servicio 3</td>
                  <td>Marcos Acosta</td>
                  <td>Lorem ipsum</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        </div>
			</div>
		</div>
	@endsection

	@section('scripts')
		<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
  		$(function() {
  			oTable = $('#tableHistorialPatrones, #tableHistorialEquipos').DataTable({
  				responsive: true,
  				"bLengthChange": false
  			});
  		});
  	</script>
	@endsection
