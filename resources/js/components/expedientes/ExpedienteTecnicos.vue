<template>
    <div class="container-fluid">
        <div class="mb-6 row">
            <div class="col-12 d-flex justify-content-between align-items-start">
                <h3 class="mb-8 card-label">Expedientes <small class="font-weight-lighter">| Asignar técnicos</small></h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tecnico" :disabled="expediente_ids.length <= 1">
                    <i class="pr-2 fas fa-users"></i>Asignar Técnicos
                </button>
            </div>
        </div>

        <div class="card card-custom">
            <div class="pt-12 card-body">
                <div class="row"></div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-separate table-head-custom collapsed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>N° Exp</th>
                                    <th>Cliente</th>
                                    <th>Instrumento</th>
                                    <th>Servicio</th>
                                    <th>Estado</th>
                                    <th>Prioridad</th>
                                    <th>Asignar Tecnico</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expedient, index) in expedientes" :key="index">
                                    <td><input v-show="expedient.tecnicos === null" type="checkbox" :value="expedient.number" v-model="expediente_ids"></td>
                                    <td>{{ expedient.number }}</td>
                                    <td>{{ expedient.certificate }}</td>
                                    <td>{{ expedient.instrumentos.name }}</td>
                                    <td>{{ expedient.service }}</td>
                                    <td>
                                        <span class="badge" :class="`badge-${expedient.estados.color}`">{{ expedient.estados.name}}</span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="`badge-${expedient.prioridad.color}`">
                                            {{ expedient.prioridad.priority }}
                                        </span>
                                    </td>
                                    <td>
                                        <button v-show="expedient.tecnicos === null" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tecnico" @click="cargarNumber(expedient.number)">
                                            <i class="fas fa-user"></i> Asignar Técnico
                                        </button>
                                        <span v-for="tecnico in expedient.tecnicos" :key="tecnico.id">
                                            <i class="mr-2 fas fa-user"></i>{{ tecnico.nombre }} <br>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal-tecnico" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <AsignarTecnico :data="null" :numeros.sync="expediente_ids" :expedientes.sync="expedientes" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AsignarTecnico from './AsignarTecnico';

    export default {
        components: { AsignarTecnico},
        data() {
            return {
                expedientes: [],
                expediente_ids: [],
                rutas: window.routes
            }
        },
        created () {
            this.fetch();
        },
        methods: {
            fetch() {
                axios.get(this.rutas.expedientes).then( response => this.expedientes = response.data)
            },
            cargarNumber(number){
                this.expediente_ids = [];
                this.expediente_ids.push(number)
            }
        },
    }
</script>
