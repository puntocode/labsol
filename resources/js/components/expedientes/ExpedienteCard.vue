<template>
    <div class="card card-custom">
        <div class="card-body pt-12">
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
                                <td><input type="checkbox"></td>
                                <td>{{ expedient.number }}</td>
                                <td>{{ expedient.servicios.certificate }}</td>
                                <td>{{ expedient.servicios.instrumento.name }}</td>
                                <td>{{ expedient.servicios.service }}</td>
                                <td>
                                    <span class="badge badge-warning ml-5 ml-md-0 mt-2 mt-md-0">
                                        {{ expedient.estados.name}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge ml-5 ml-md-0 mt-2 mt-md-0" :class="`badge-${expedient.servicios.prioridad.color}`">
                                        {{ expedient.servicios.prioridad.prioridad }}
                                    </span>
                                </td>
                                <td>
                                    <button v-show="expedient.tecnicos === null" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tecnico" @click="cargarNumber(expedient.number)">
                                        <i class="fas fa-user"></i> Asignar Técnico
                                    </button>
                                    <span v-for="tecnico in expedient.tecnicos" :key="tecnico.id">
                                        <i class="fas fa-user mr-2"></i>{{ tecnico.nombre }} <br>
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
                <AsignarTecnico :data="null" :numeros="expediente_ids" :expedientes.sync="expedientes" />
            </div>
	    </div>
    </div>
</template>

<script>
    import ModalTecnico from './ModalTecnico';
    import AsignarTecnico from './AsignarTecnico';

    export default {
        components: { ModalTecnico, AsignarTecnico},
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
                this.expediente_ids.push({number: number})
            }
        },
    }
</script>



<style lang="scss" scoped>

</style>
