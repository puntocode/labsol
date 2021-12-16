<div class="row d-flex justify-content-center align-items-center mb-4">
    <div class="col-4">
        <img src="{{ asset('media/logos/logo_color_large.png') }}" alt="logo-labsol" class="img-fluid">
    </div>
    <div class="col-8">
        <h1 class="text-center font-bold w-100 mb-0">CERTIFICADO DE CALIBRACIÓN</h1>
    </div>
</div>

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-4 d-flex">
        <span class="text-center py-2 bg-secondary text-dark font-bold px-4" style="width: 150px">Certificado N°:</span>
        <span id="codigo" class="px-4 text-dark font-bold" style="font-size: 1.7rem">{{ $expediente->number }}</span>
    </div>
    <div class="col-8 d-flex justify-content-end">

        <img class="img-fluid" src="{{ asset('media/logos/servicio_acreditado.png') }}" alt="Servicio Acreditado" style="height: 100px">

        <img class="img-fluid" src="{{ asset('media/logos/organismo_nacional_de_acreditacion.png') }}" alt="Organismo Nacional de Acreditación" style="height: 100px">

        <img class="img-fluid" src="{{ asset('media/logos/iso_iec_17025.png') }}" alt="ISO IEC 17025" style="height: 100px">
    </div>
</div>
