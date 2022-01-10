<template>
   <div class="pb-16 card-body">
        <div class="row">
             <div class="form-group col-md-4">
                <label>Certificado a nombre de:</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.certificate }}</span>
                </div>
            </div>

             <div class="form-group col-md-4">
                <label>RUC</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.certificate_ruc }}</span>
                </div>
            </div>

             <div class="form-group col-md-4">
                <label>Dirección</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.certificate_adress }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Instrumento</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.instrumentos.name }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Servicio</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.service }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Prioridad</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="mt-2 ml-5 badge ml-md-0 mt-md-0" :class="`badge-${expediente.prioridad.color}`">
                        {{ expediente.prioridad.priority }}
                    </span>
                </div>
            </div>

            <div class="form-group col-md-8">
                <label>Observación:</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.obs }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="mt-2 ml-5 badge ml-md-0 mt-md-0" :class="`badge-${expediente.estados.color}`">{{expediente.estados.name}}</span>
                </div>
            </div>
        </div>

        <div class="mt-5 row">
            <div class="col-12">
                <h3>Técnicos Asignados</h3>
                <hr>
            </div>

            <div class="form-group col-md-4">
                <label>Técnico(s)</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold"><i class="mr-2 fas fa-user"></i></span>
                    <span v-if="expediente.tecnicos === null">-</span>
                    <span v-else v-for="(tecnicos, index) in expediente.tecnicos" :key="index">
                        <span v-if="index > 0">|</span> {{ tecnicos.nombre }}
                    </span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Fecha de entrega</label>
                <div class="h-auto p-0 border-0 form-control">
                    <span class="font-weight-bold">{{ expediente.delivery_date }}</span>
                </div>
            </div>

            <!-- <div class="pb-0 mb-0 form-group col-md-4 d-flex align-items-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tecnico"><i class="fas fa-user"></i>{{ textoBtn }}</button>
            </div> -->
        </div>

        <!-- <HistorialTable :historial="historial" v-if="historial != null && historial.length > 1" /> -->


        <!-- <div class="modal fade" id="modal-tecnico" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <AsignarTecnico data="show" :numeros.sync="numeros" :expedientes.sync="expediente" />
            </div>
        </div> -->

    </div>
</template>

<script>
    import HistorialTable from './HistorialTable';
    import AsignarTecnico from './AsignarTecnico';

    export default {
        props: ['expediente'],
        components: { HistorialTable, AsignarTecnico },
        data() {
            return {
                // numeros: [this.data.expediente.number],
                // expediente: this.data.expediente,
                // historial: this.data.historial,
            }
        },
        // computed: {
        //     textoBtn() {
        //         return this.expediente.tecnicos == null ? 'Asignar Técnico' : 'Reasignar Técnico';
        //     }
        // },
    }
</script>

