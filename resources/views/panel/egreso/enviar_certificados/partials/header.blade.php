<div class="row">
    <div class="col-xs-4" style="padding-top: 25px">
        <img src="{{ public_path('media/logos/logo_color_large.png') }}" alt="logo-labsol" >
    </div>
    <div class="col-xs-8 text-center">
        <h1 style="font-weight: bold; font-size: 2.6rem">CERTIFICADO DE CALIBRACIÓN</h1>
    </div>
</div>

<table class="w-100">
    <tbody>
        <tr>
            <th class="text-center" style="width: 155px;" >
                <div  style="background-color: #E4E6EF; padding: 5px !important;">
                    Certificado N°:
                </div>
            </th>
            <td style="padding-left: 5px; font-size: 1.9em">{{ $expediente->number }}</td>
            <td class="" align="right" style="padding-top: 25px;">
                <img src="{{ public_path('media/logos/servicio_acreditado.png') }}" style="height: 100px" alt="servicio_acreditado">
                <img src="{{ public_path('media/logos/organismo_nacional_de_acreditacion.png') }}" style="height: 100px" alt="organismo_nacional_de_acreditacion">
                <img src="{{ public_path('media/logos/iso_iec_17025.png') }}" style="height: 100px" alt="iso_iec_17025">
            </td>
        </tr>
    </tbody>
</table>
