<div class="row">
    @forelse ($documentos as $documento)
        <div class="col-lg-6">
            <div class="card card-custom gutter-b card-stretch border shadow">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center py-1">
                        <i class="fas {{ $documento->getIconDocumento() }} fa-2x text-primary mr-3"></i>
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a href="{{ $documento->getUrlDoc() }}" class="text-dark font-weight-bolder text-hover-primary text-uppercase">
                                {{$documento->name}}
                            </a>
                            {{-- <span class="text-muted font-weight-bold font-size-lg">Fecha: {{ $documento->extension }}</span> --}}
                        </div>
                        <div class="w-100">
                            {{-- <p class="mt-5 mb-0 text-capitalize"></p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">- No existe documentos -</div>
    @endforelse
</div>
