<div class="row px-4">
    <div class="col-12 px-0 d-flex justify-content-between">
        <h4>Patron: <span class="text-black-50">{{ $data->code }}</span></h4>
        <span>Magnitud <span class="badge badge-info font-weight-bold ml-2">{{ $data->magnitude->name }}</span></span>
    </div>
    <div class="col-12 text-center my-8 py-2 bg-secondary position-relative">
        <h4 class="font-bold w-100">Magnitudes</h4>
    </div>
</div>

<div class="row">
    <div class="col-8">
        <label for="">Magnitud</label>
        <span>Magnitud</span>
    </div>
    <div class="col-4">
        <label for="">Unidad de medida</label>
        <span>Unidad</span>
    </div>

    <div class="col-12 mt-4 text-center">
        <hr><a href="{{ route('panel.patron.ide.form', $data->id) }}" class="btn btn-primary">Editar IDE</a>
    </div>
</div>
