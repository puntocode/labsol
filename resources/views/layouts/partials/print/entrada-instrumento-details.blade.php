
<div class="card-body px-14">
    <section>
        <div class="row">
            <div class="col-12 bg-secondary mb-3 py-2">
                <h4 class="font-bold text-center">INFORMACIÓN DEL CLIENTE</h4>
            </div>

            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">SOLICITANTE</span>
            </div>
            <div class="col-10 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->cliente->name }}</span>
            </div>

            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">DIRECCION</span>
            </div>
            <div class="col-10 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->contact['direccion'] }}</span>
            </div>

            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">RUC</span>
            </div>
            <div class="col-4 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->cliente->ruc }}</span>
            </div>
            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">TELÉFONO</span>
            </div>
            <div class="col-4 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->contact['telefono'] }}</span>
            </div>

            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">CONTACTO</span>
            </div>
            <div class="col-4 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->contact['nombre'] }}</span>
            </div>
            <div class="col-2 bg-secondary py-2 border-white">
                <span class="font-bold">E-MAIL</span>
            </div>
            <div class="col-4 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->contact['email'] }}</span>
            </div>
        </div>
    </section>

    @if ($entradaInstrumento->type === 'LS')
        <section class="row mt-8">
            <div class="col-4 bg-secondary py-2 border-white">
                <span class="font-bold">FECHA DE RECEPCIÓN</span>
            </div>
            <div class="col-8 bg-light py-2 border-white">
                <span>{{ date('d-m-Y', strtotime($entradaInstrumento->created_at)) }}</span>
            </div>

            <div class="col-4 bg-secondary py-2 border-white">
                <span class="font-bold">INSTRUMENTO RECIBIDO POR</span>
            </div>
            <div class="col-8 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->user->fullname }}</span>
            </div>

            <div class="col-4 bg-secondary py-2 border-white">
                <span class="font-bold">INSTRUMENTO ENTREGADO POR</span>
            </div>
            <div class="col-8 bg-light py-2 border-white">
                <span>{{  $entradaInstrumento->delivered }}</span>
            </div>
        </section>
    @endif

    <section class="mt-8">
        <div class="row mb-8">
            <div class="col-12 bg-secondary py-2 text-center">
                <h4 class="font-bold">CONTROL DE INGRESO DE INSTRUMENTOS</h4>
            </div>
        </div>

        @foreach ($entradaInstrumento->servicio as $servicio)
            <div class="row">
                <div class="col-2 bg-secondary py-2 border-white">
                    <span class="font-bold">Cantidad</span>
                </div>
                <div class="col-6 bg-secondary py-2 border-white">
                    <span class="font-bold">Equipo</span>
                </div>
                <div class="col-4 bg-secondary py-2 border-white">
                    <span class="font-bold">Servicio</span>
                </div>

                <div class="col-2 bg-light py-2 border-white">
                    <span>{{  $servicio->quantity }}</span>
                </div>
                <div class="col-6 bg-light py-2 border-white">
                    <span>{{  $servicio->instrumento->name }}</span>
                </div>
                <div class="col-4 bg-light py-2 border-white">
                    <span>{{  $servicio->service }}</span>
                </div>

                <div class="col-12 bg-secondary py-2 border-white">
                    <span class="font-bold">Observación: </span>
                </div>
                <div class="col-12 bg-light py-2 border-white">
                    <span>{{ isset($entradaInstrumento->obs) ? $entradaInstrumento->obs : '-' }}</span>
                </div>
            </div>

            <div class="row mb-10">
                <div class="col-12 bg-secondary text-center border-white">
                    <h5 class="font-bold pt-2">CERTIFICADO</h5>
                </div>

                <div class="col-2 bg-secondary py-2 border-white">
                    <span class="font-bold">A NOMBRE DE:</span>
                </div>
                <div class="col-10 bg-light py-2 border-white">
                    <span>{{  $servicio->certificate }}</span>
                </div>

                <div class="col-2 bg-secondary py-2 border-white">
                    <span class="font-bold">DIRECCIÓN:</span>
                </div>
                <div class="col-6 bg-light py-2 border-white">
                    <span>{{  $servicio->certificate_adress }}</span>
                </div>

                <div class="col-2 bg-secondary py-2 border-white">
                    <span class="font-bold">RUC:</span>
                </div>
                <div class="col-2 bg-light py-2 border-white">
                    <span>{{  $servicio->certificate_ruc }}</span>
                </div>
            </div>
        @endforeach

    </section>


</div>
