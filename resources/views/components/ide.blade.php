@foreach ($data as $ide)
    <div id="patron-ide-{{ $ide->id }}">
        <div class="my-10 row">
            <div class="col-4">
                <label for="">Magnitud</label>
                <h3>{{ $ide->magnitude }}</h3>
            </div>
            <div class="col-4">
                <label for="">Unidad de medida</label>
                <h3>{{ $ide->unit_measurement }}</h3>
            </div>
            <div class="pt-4 text-right col-4">
                <a href="{{ route('panel.patrones-ide.edit', $ide->id) }}" class="btn btn-outline-primary">Editar</a>
                <eliminar-magnitud ruta="{{ route('panel.patron_ide.delete', $ide->id) }}" id="{{ $ide->id }}"></eliminar-magnitud>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                      <tr>
                        <th></th>
                        <th scope="col">Rango</th>
                        <th scope="col">{{ $tipo == 'DIGITAL' ? 'Resolución' : 'División' }}</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($ide->rangos as $rango)
                            <tr data-toggle="collapse" data-target="#table-{{ $rango->id }}" class="accordion-toggle">
                                <td><a href="javascript:void(0);"><i class="fas fa-list text-primary"></i></a></td>
                                <td>{{ $rango->rango }} {{ $rango->rango_medida }}</td>
                                <td>{{ $rango->resolucion }} {{ $rango->resolucion_medida }}</td>
                                <td><a href="{{ route('panel.ide_rango.edit', $rango->id) }}"><i class="fas fa-edit text-primary"></i></a></td>
                            </tr>
                            @if (count($rango->ocultos))
                                <tr>
                                    <td colspan="12" class="hiddenRow">
                                        <div class="accordian-body collapse" id="table-{{ $rango->id }}">
                                            <table-deriva :derivas="{{ $rango->ocultos }}"></table-deriva>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="mt-10 col-12 border-bottom border-primary"></div>
        </div>
    </div>

@endforeach

