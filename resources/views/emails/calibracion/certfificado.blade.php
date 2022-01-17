<p><b>Buen día estimado,</b></p>

<p>Adjunto certificado(s) de calibración con firma digital Nº</p>

@foreach ($documentos as $documento)
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;<b>{{ $documento['number'] }}</b>
    </p>
@endforeach

<p>Favor confirmar recepción del mismo.</p>

<p>Saludos cordiales.</p>

<p>
    <b>
        Nuestros certificados cuentan con firma digital, la misma añade información a un documento, le proporciona validez
        legal y asegura su integridad de acuerdo a la Ley 4017/10 y Ley 4610/12
    </b>
    y además tiene los siguientes beneficios:
</p>

<ul>
    <li>
        <p>
            Mayor seguridad e integridad de los documentos. El contenido del documento electrónico firmado no puede
            ser alterado, por lo que se garantiza la autenticación del mismo y la identidad del firmante.
        </p>
    </li>

    <li>
        <p>
            Se garantiza la confidencialidad, el contenido del mensaje solo es conocido por quienes estén autorizados
            a ello.
        </p>
    </li>

    <li>
        <p>
            Eliminación del papel, lo que implica una disminución del almacenamiento de datos (espacio físico) y
            reducción de gastos en los procedimientos de administración de archivos cuidando así el medio ambiente.
        </p>
    </li>

    <li>
        <p>
            Se evitan desplazamientos y traslados.
        </p>
    </li>

    <li>
        <p>
            Aumento de la productividad y competitividad de la Empresa.
        </p>
    </li>
</ul>
