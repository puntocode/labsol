<template>
    <div class="container-fluid">
        <div class="mb-6 row">
            <div class="col-12 d-flex justify-content-between align-items-start">
                <h3 class="mb-8 card-label">Expedientes <small class="font-weight-lighter">| Asignar técnicos</small></h3>
                <div class="d-flex">
                    <button class="btn btn-primary mr-3" data-toggle="modal" data-target="#modal-tecnico" :disabled="expediente_ids.length <= 1">
                        <i class="pr-2 fas fa-users"></i>Asignar Técnicos
                    </button>
                    <ModalInstrumento :expedientes="expediente_ids" />
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="pt-12 card-body">
                <div class="row">
                    <div class="col-md-3 mb-10">
                        <input type="text" class="form-control" placeholder="Buscar..." v-model="filterField">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table class="table table-separate table-head-custom collapsed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>N° Exp</th>
                                    <th>Cliente</th>
                                    <th>Instrumento</th>
                                    <th>Estado</th>
                                    <th>Prioridad</th>
                                    <th>Asignar Tecnico</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expedient, index) in expedienteFiltrados" :key="index">
                                    <td><input v-show="expedient.tecnicos === null" type="checkbox" :value="expedient.number" v-model="expediente_ids"></td>
                                    <td>{{ expedient.number }}</td>
                                    <!-- <td>{{ expedient.entrada_instrumentos.cliente.name }}</td> -->
                                    <td v-html="highlightMatches(expedient.entrada_instrumentos.cliente.name)"></td>
                                    <td v-html="highlightMatches(expedient.instrumentos.name)"></td>
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
    import ModalInstrumento from './ModalInstrumento';

    export default {
        components: { AsignarTecnico, ModalInstrumento },
        data() {
            return {
                expedientes: [],
                expediente_ids: [],
                filterField: '',
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
            },

            highlightMatches(text) {
                const matchExists = text.toLowerCase().includes(this.filterField.toLowerCase());
                if (!matchExists) return text;

                const re = new RegExp(this.filterField, 'ig');
                return text.replace(re, matchedText => `<strong>${matchedText}</strong>`);
            }

        },

        computed: {
            expedienteFiltrados() {
                return this.expedientes.filter(row => {
                    const cliente = row.entrada_instrumentos.cliente.name.toLowerCase();
                    const instrumento = row.instrumentos.name.toLowerCase();
                    const estado = row.estados.name.toLowerCase();
                    const proridad = row.prioridad.priority.toLowerCase();
                    const searchTerm = this.filterField.toLowerCase();

                    return cliente.includes(searchTerm)
                        || instrumento.includes(searchTerm)
                        || estado.includes(searchTerm)
                        || proridad.includes(searchTerm);
                });
            }
        },
    }
</script>
