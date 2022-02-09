

<div class="row mt-14">
    <div class="col-12 mb-8 d-flex justify-content-between border-bottom">
        <h3>CMC</h3>
        <a href="{{ route('panel.cmc.edit', $data->id) }}" class="text-info pointer font-bold mr-4" >Cargar CMC</a>
    </div>
</div>

@if (isset($data->cmcRangos))
    <cmc-show :cmcs={{ $data->cmcRangos }} :patrones="{{ $data->patrones }}"></cmc-show>
@else
    <div class="row">
        <div class="col-12 text-center">
            <span>-- No existen datos cargados--</span>
        </div>
    </div>
@endif
