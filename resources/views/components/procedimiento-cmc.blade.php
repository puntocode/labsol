<div class="col-12 mt-10">
    <h3>CMC</h3>
    <hr>
</div>

@forelse ($data->cmcs as $cmc)
    <div class="col-12">
        <h5>{{ $cmc->code }}</h5>
    </div>
@empty
    <div class="col-12">
        <a href="{{ route('panel.cmc.edit', $data->id) }}" class="btn btn-info" >Cargar CMC</a>
    </div>
@endforelse
