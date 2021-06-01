<!--begin::Card-->
@if(isset($chart) && $chart != NULL)
	<div class="card card-custom card-stretch gutter-b py-5">
		<div class="card-header border-0">
			<div class="card-title">
				<h3 class="card-label">{{$chart->titulo}}</h3>
			</div>
		</div>
		<div class="card-body pt-0">
			<div class="description-chart mb-5 mx-n2">
				<!--begin: Datatable-->
				<table id="table_{{$chart->id}}" class="display table-chart" style="width:100%">
			        <thead>
			            <tr>
			            	@foreach ($chart->table['columns'] as $column)
			            		<th class="text-white">{{$column}}</th>
			            	@endforeach
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach ($chart->table['values'] as $row)
			        		<tr>
			        			<td>{{$row->titulo}}</td>
			        			<td class="text-right">{{$row->valor}}</td>
			        		</tr>
			        	@endforeach
			        </tbody>
			        <tfoot>
			            <tr>
			                <th class="border-top pt-3">Total general</th>
			                <th class="border-top pt-3 text-right"></th>
			            </tr>
			        </tfoot>
			    </table>
			</div>
			<!--end::Datatable-->			

			<!--begin::Chart-->
			<div id="{{$chart->id}}" class="d-flex justify-content-center"></div>
			<!--end::Chart-->
		</div>
	</div>
@endif
<!--end::Card-->