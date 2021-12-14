<div class="row">
    <div class="form-group col-md-7">
        <label>Cliente</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->cliente->name }}</span>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>RUC</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->cliente->ruc }}</span>
        </div>
    </div>

    <div class="form-group col-md-7">
        <label>Contacto</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->contact['nombre'] }}</span>
        </div>
    </div>
    <div class="form-group col-md-5">
        <label>Telefóno</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->contact['telefono'] }}</span>
        </div>
    </div>
    <div class="form-group col-md-7">
        <label>Dirección</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->contact['direccion'] }}</span>
        </div>
    </div>

    <div class="form-group col-md-5">
        <label>Email</label>
        <div class="h-auto p-0 border-0 form-control">
            <span class="font-weight-bold">{{ $data->contact['email'] }}</span>
        </div>
    </div>
</div>
