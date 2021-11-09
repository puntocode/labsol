<template>
    <div class="mt-8 row">
        <!-- Table Expedientes -------------------------------------------------------------------------------------------------------------------------->
        <div class="col-12 table-responsive">
            <table class="table table-separate">
                <thead class="thead-light">
                    <tr>
                        <th @click="selectAll">Todos</th>
                        <th>N°. Exped</th>
                        <th>Certificado</th>
                        <th>RUC</th>
                        <th>Direccion</th>
                        <th>Equipo</th>
                        <th>Servicio</th>
                        <!-- <th>Estado</th> -->
                        <th>Prioridad</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="expediente in table" :key="expediente.id">
                        <td><input type="checkbox" :value="expediente.id" v-model="checkExp"></td>
                        <td>{{ expediente.number }}</td>
                        <td>{{ formated(expediente.certificate) }}</td>
                        <td>{{ formated(expediente.certificate_ruc) }}</td>
                        <td>{{ formated(expediente.certificate_adress) }}</td>
                        <td>{{ expediente.instrumentos.name }}</td>
                        <td>{{ expediente.service }}</td>
                        <!-- <td>
                            <span class="mt-2 ml-5 badge ml-md-0 mt-md-0" :class="`badge-${expediente.estados.color}`">
                                {{ expediente.estados.name }}
                            </span>
                        </td> -->
                        <td>
                            <span class="mt-2 ml-5 badge ml-md-0 mt-md-0" :class="`badge-${expediente.prioridad.color}`">
                                {{ expediente.priority }}
                            </span>
                        </td>
                        <td>{{ expediente.obs }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-right col-12">
            <hr>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#modal-edit" v-show="checkExp.length > 0"
                @click="limpiar"
                :disabled="checkExp.length === 0">Limpiar</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-edit"
                @click="cargarForm"
                :disabled="checkExp.length === 0">Editar</button>

        </div>

        <!-- Modal Edit --------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary rounded-0">
                        <h5 class="text-white modal-title" id="modal-label">Editar Expedientes</h5>
                    </div>
                    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Certificado a nombre de:</label>
                                        <input type="text" v-model="form.certificate" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>RUC</label>
                                        <input class="form-control" v-model="form.certificate_ruc">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input class="form-control" v-model="form.certificate_adress">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea v-model="form.obs" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Prioridad <span class="text-danger">*</span></label>
                                        <div class="priority">
                                            <input type="radio" id="normal" value="NORMAL" v-model="form.priority">
                                            <label for="normal" class="border-primary text-primary" style="--color: #009BDD">Normal</label>
                                            <input type="radio" id="urgente" value="URGENTE" v-model="form.priority">
                                            <label for="urgente" class="border-danger text-danger" style="--color: #F2253E">Urgente (24hs.)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-0 modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" id="btn-cancelar" :disabled="actualizando">Cancelar</button>
                            <button type="button" class="btn btn-primary font-weight-bold" @click="submit">
                                <i v-if="actualizando" class="fas fa-spinner fa-spin"></i>
                                <span v-else>Editar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['expedientes'],
        data() {
            return {
                actualizando: false,
                checkExp: [],
                table: this.expedientes,
                form: [{
                    certificate: '',
                    certificate_ruc: '',
                    certificate_adress: '',
                    priority: '',
                    obs: ''
                }],
                rutas: window.routes
            }
        },
        methods: {
            formated(certificado){
                return certificado === null ? '-' : certificado;
            },
            selectAll(){
                this.limpiar();
                this.expedientes.forEach(expediente => { this.checkExp.push(expediente.id) });
            },
            limpiar(){
                this.checkExp = []
            },
            cargarForm(){
                const index = this.checkExp[0];
                this.form = this.expedientes.find( expediente => expediente.id === index );
            },
            submit(){
                this.actualizando = true;
                this.checkExp.forEach(expediente => {
                    this.actualizar(expediente);
                });

                this.limpiar();
                this.actualizando = false;

                this.$swal('Actualizado!', 'Los expedientes se han acutalizados con éxito!','success')
                    .then( result => {
                        $('#btn-cancelar').click();
                    })
            },
            async actualizar(expediente){
                const res = await axios.put(`${this.rutas.expIndex}/${expediente}`, this.form);
                const datos = await res.data;
                const index = await this.table.findIndex( exp => exp.id === expediente);
                await this.table.splice(index, 1, datos);
            },

        },
    }
</script>
