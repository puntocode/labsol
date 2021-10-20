@foreach ($data as $ide)
    <div class="row my-10">
        <div class="col-4">
            <label for="">Magnitud</label>
            <h3>{{ $ide->magnitude }}</h3>
        </div>
        <div class="col-4">
            <label for="">Unidad de medida</label>
            <h3>{{ $ide->unit_measurement }}</h3>
        </div>
        <div class="col-4 text-right pt-4">
            <a href="" class="btn btn-outline-primary">Editar</a>
            <a href="" class="btn btn-outline-danger">Eliminar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Rango</th>
                    <th scope="col">Unidad de Medida</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ide->rangos as $rango)
                        <tr>
                            <td>{{ $rango->rango }}</td>
                            <td>{{ $rango->unidad_medida }}</td>
                            <td><a href=""><i class="fas fa-edit text-primary"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </div>

        <div class="col-12 mt-10 border-bottom border-primary"></div>
    </div>

@endforeach

