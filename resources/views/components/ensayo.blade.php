@foreach ($data as $ensayo)
    <div id="patron-ensayo-{{ $ensayo->id }}">
        <div class="my-10 row">
            <div class="col-4">
                <label for="">Ensayo</label>
                <h3>{{ $ensayo->ensayo }}</h3>
            </div>
            <div class="col-4">
                <label for="">Unidad de medida</label>
                <h3>{{ $ensayo->unit_measurement }}</h3>
            </div>
            <div class="pt-4 text-right col-4">
                <a href="{{ route('panel.patron.ensayo.edit', $ensayo->id) }}" class="btn btn-outline-primary">Editar</a>
                <eliminar-ensayo ruta="{{ route('panel.patron.ensayo.delete', $ensayo->id) }}" id="{{ $ensayo->id }}"></eliminar-ensayo>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">IP</th>
                        <th scope="col">Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($ensayo->rangos as $rango)
                            <tr>
                                <td>{{ $rango['ip'] }} {{ $rango['ip_medida'] }}</td>
                                <td>{{ $rango['valor'] }} {{ $rango['valor_medida'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="mt-10 col-12 border-bottom border-primary"></div>
        </div>
    </div>

@endforeach

