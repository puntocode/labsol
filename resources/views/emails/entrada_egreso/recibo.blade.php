<style>
    table, th, td {
        text-align: center;
        vertical-align:middle;
        border: 1px solid black;
    }

    th, td {
        padding: .7em;
    }
</style>

<p>Estimado cliente</p>

@if ($esEntrada)
    <p>
        Se ha generado a su nombre la entrada de los siguientes instrumentos en nuestro laboratorio de calibraciones:
    </p>
@else
    <p>
        Se ha procesado la salida de los siguientes instrumentos a su nombre de nuestro laboratorio de calibraciones:
    </p>
@endif

<table>
    <thead>
        <th>Cantidad</th>
        <th>Instrumento</th>
        <th>Expediente/s</th>
    </thead>

    <tbody>
        @foreach ($expedientes as $expediente)
            <tr>
                <td>{{ $expediente->cantidad }}</td>
                <td>{{ $expediente->instrumentos->name }}</td>
                <td>{{ $expediente->abrebiarNumerosConsecutivos() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>Adjunto se remite el registro de {{ $esEntrada ? 'entrada' : 'salida' }} de instrumentos</p>

<p>Favor confirmar recepción del mismo</p>

<p>Saludos Cordiales</p>
