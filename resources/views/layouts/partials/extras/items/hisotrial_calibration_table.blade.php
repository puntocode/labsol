 <!--begin: Datatable-->
 <table class="table table-separate table-head-custom collapsed" id="tableFacturas" style="width:100%">
 <thead>
     <tr>
         <th>#</th>
         <th>N° de Certificado</th>
         <th>Elaborado Por</th>
         <th>F. de Calibración</th>
         <th>Prox. Calibración</th>
         <th>Obs.</th>
         <th class="text-center">Acciones</th>
     </tr>
 </thead>
 <tbody>
     @foreach ($historyCalibration as $key => $history)
         <tr>
             <td>{{ $key+1 }}</td>
             <td>{{ $history->certificate_no }}</td>
             <td>{{ $history->done }}</td>
             <td>{{ $history->calibration }}</td>
             <td>{{ $history->next_calibration }}</td>
             <td>{{ $history->obs }}</td>
             <td class="text-center">
                <a href="{{ route('panel.patrones.doc', ['patron' => $patron, 'data' => ['id' => $history->id, 'vista'=> 'calibracion' ]]) }}" title="Editar registro">
                    <i class="la la-edit text-primary"></i>
                </a>
                <table-delete url=""></table-delete>
            </td>
         </tr>
     @endforeach
 </tbody>
</table>
<!--end: Datatable-->
