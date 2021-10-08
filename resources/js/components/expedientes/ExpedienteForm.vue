<template>
   <div class="card-body pb-16">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Instrumento</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold">{{ datos.expediente.servicios.instrumento.name }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Servicio</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold">{{ datos.expediente.servicios.service }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Prioridad</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="badge ml-5 ml-md-0 mt-2 mt-md-0" :class="`badge-${datos.expediente.servicios.prioridad.color}`">
                        {{ datos.expediente.servicios.prioridad.prioridad }}
                    </span>
                </div>
            </div>

            <div class="form-group col-md-8">
                <label>Observación:</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold">{{ datos.expediente.servicios.obs }}</span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Estado</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="badge ml-5 ml-md-0 mt-2 mt-md-0" :class="`badge-${datos.expediente.estados.color}`">{{datos.expediente.estados.name}}</span>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3>Técnicos Asignados</h3>
                <hr>
            </div>

            <div class="form-group col-md-4">
                <label>Técnico(s)</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold"><i class="fas fa-user mr-2"></i></span>
                    <span v-if="datos.expediente.tecnicos === null">-</span>
                    <span v-else v-for="(tecnicos, index) in datos.expediente.tecnicos" :key="index">
                        <span v-if="index > 0">|</span> {{ tecnicos.nombre }}
                    </span>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label>Fecha de entrega</label>
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold">{{ datos.expediente.delivery_date }}</span>
                </div>
            </div>

            <div class="form-group col-md-4 pb-0 mb-0 d-flex align-items-center">
                <!-- <ModalTecnico :datos="datos" /> -->
            </div>
        </div>

        <HistorialTable :historial="datos.historial" v-if="datos.historial != null && datos.historial.length > 1" />

    </div>
</template>

<script>
    import HistorialTable from './HistorialTable';
    import ModalTecnico from './ModalTecnico';

    export default {
        props: ['data'],
        components: { HistorialTable, ModalTecnico },
        data() {
            return {
                datos: []
            }
        },
        created () {
            this.datos = this.data;
        },
    }
</script>

