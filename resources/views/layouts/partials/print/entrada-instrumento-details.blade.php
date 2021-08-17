
<div class="card-body px-14">
    <div class="row">
        <div class="col-md-12">
            <h4>Certificado</h4>
            <hr>
        </div>

        <div class="form-group col-md-3">
            <label>Nro.Expediente</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->type }}-{{ $entradaInstrumento->id }}</span>
        </div>

        <div class="form-group col-md-9">
            <label>A nombre de:</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->certificate }}</span>
        </div>

        <div class="form-group col-md-3">
            <label>RUC</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->certificate_ruc }}</span>
        </div>
        <div class="form-group col-md-9">
            <label>Dirección</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->certificate_address }}</span>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Cliente</h4>
            <hr>
        </div>

        <div class="form-group col-md-8">
            <label>Cliente</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->cliente->name }}</span>
        </div>

        <div class="form-group col-md-4">
            <label>Ruc</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->cliente->ruc }}</span>
        </div>

        <div class="form-group col-md-8">
            <label>Contacto</label>
            <span class="font-weight-bold">{{ $entradaInstrumento['contact']['nombre'] }}</span>
        </div>

        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <span class="font-weight-bold">{{ $entradaInstrumento['contact']['telefono'] }}</span>
        </div>

        <div class="form-group col-md-8">
            <label>Dirección</label>
            <span class="font-weight-bold">{{ $entradaInstrumento['contact']['direccion'] }}</span>
        </div>

        <div class="form-group col-md-4">
            <label>Email</label>
            <span class="font-weight-bold">{{ $entradaInstrumento['contact']['email'] }}</span>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Instrumento</h4>
            <hr>
        </div>

        <div class="form-group col-md-3">
            <label>Cantidad</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->quantity }}</span>
        </div>

        <div class="form-group col-md-5">
            <label>Servicio</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->procedimiento->name }}</span><br>
            {{$entradaInstrumento->procedimiento->code }}
        </div>

        <div class="form-group col-md-4">
            <label>Equipo</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->instrument }}</span>
        </div>


        <div class="form-group col-md-12">
            <label>Observaciones</label>
            <span class="font-weight-bold">{{ $entradaInstrumento->obs }}</span>
        </div>
    </div>

    @if ($entradaInstrumento->type === 'LS')
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Detalles</h4>
                <hr>
            </div>

            <div class="form-group col-md-8">
                <label>Recibido por</label>
                <span class="font-weight-bold">{{ $entradaInstrumento->user->fullname }}</span>
            </div>

            <div class="form-group col-md-4">
                <label>Prioridad</label>
                <span class="badge badge-{{ $entradaInstrumento->prioridad['color'] }}">
                    {{ $entradaInstrumento->prioridad['prioridad'] }}
                </span>
            </div>

            <div class="form-group col-md-8">
                <label>Entregado por:</label>
                <span class="font-weight-bold">{{ $entradaInstrumento->delivered }}</span>
            </div>

            <div class="form-group col-md-4">
                <label>CI:</label>
                <span class="font-weight-bold">{{ $entradaInstrumento->identification }}</span>
            </div>
        </div>
    @endif
</div>
