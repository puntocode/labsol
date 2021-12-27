<div class="row">
    <div class="form-group col-md-4">
        <label>Identificación</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->code }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Descripcion</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->description }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Formulario</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->formulario->codigo }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Marca</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->brand }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Modelo</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->model }}</span>
        </div>
    </div>


    <div class="form-group col-md-4">
        <label>Nr. de Serie</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->serie_number }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Tipo</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->type }} {{ $data->type_description }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Incertidumbre</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->uncertainty }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Tolerancia</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->tolerance }}</span>
        </div>
    </div>
</div>
<hr>

<div class="row mt-3">
    <div class="form-group col-md-4">
        <label>Ubicación</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->ubication }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Nr. de Certificado</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->certificate_no }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Procedimiento de Calibración</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->procedimiento_id > 0 ? $data->procedimientos->code : '-' }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Estado</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="badge badge-primary font-weight-bold text-uppercase">{{ $data->condition->name }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Magnitud</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="badge badge-info font-weight-bold">{{ $data->magnitude->name }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Alerta de Calibración</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="badge badge-danger font-weight-bold">{{ $data->alertaCalibracion()  }}</span>
        </div>
    </div>
</div>
<hr>


<div class="row mt-3">
    <div class="form-group col-md-4">
        <label>Periodo de Calibración</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->periodo }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Última Calibración</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->last_calibration }}</span>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Próxima Calibración</label>
        <div class="form-control p-0 border-0 h-auto">
            <span class="font-weight-bold">{{ $data->next_calibration }}</span>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="form-group col-md-4">
        <label>Rango</label>
        <div class="form-control p-0 border-0 h-auto">
            @isset($data->rank)
                @foreach ($data->rank as $rank)
                    <span class="font-weight-bold">{{ $rank  }}</span> <br>
                @endforeach
            @endisset
        </div>
    </div>

    <div class="form-group col-md-4">
        <label>Precisión</label>
        <div class="form-control p-0 border-0 h-auto">
            @isset($data->precision)
                @foreach ($data->precision as $precision)
                    <span class="font-weight-bold">{{ $precision['title'] == 'precision' ? '' : $precision['title']  }}</span><br>
                    @foreach ($precision['value'] as $value)
                        {{ $value }} <br>
                    @endforeach
                @endforeach
            @endisset
        </div>
    </div>


    <div class="form-group col-md-4">
        <label>Error Máximo</label>
        <div class="form-control p-0 border-0 h-auto">

            @isset($data->error_max)
                @foreach ($data->error_max as $error)
                    <span class="font-weight-bold">{{ $error['title'] == 'error' ? '' : $error['title']  }}</span><br>
                    @foreach ($error['value'] as $value)
                        {{ $value }} <br>
                    @endforeach
                @endforeach
            @endisset

        </div>
    </div>

</div>
