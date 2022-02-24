<template>
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="label-campo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Campo</h5>
                </div>

                <form class="mb-5" autocomplete="off" @submit.prevent="editar">
                    <div class="modal-body">
                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Anterior</label>
                                <input :value="data.anteriores" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Nuevo</label>

                                <select v-if="data.select.length" class="form-control" v-model.lazy="formEditar.nuevos">
                                    <option v-for="(unidad, i) in data.select" :key="i" :id="`${i}-sl-editar`">{{ unidad }}</option>
                                </select>

                                <input v-else v-model="formEditar.nuevos" :type="data.type" class="form-control" step="0.01">
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">PIN</label>
                                <input type="password" v-model="formEditar.pin" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="border-0 modal-footer justify-content-center pt-0">
                        <button id="boton-cancel" type="button" class="btn btn-light-secondatry text-secondary font-weight-bold" data-dismiss="modal" v-show="!spin">Cancelar</button>
                        <button type="submit" class="btn btn-primary" :disabled="desactivado" title="Completa todos los campos requeridos">
                            <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                            <span v-else>Editar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                formEditar: {
                    anteriores: '',
                    nuevos: '',
                    campo: '',
                    calibracion_id: '',
                    pin: ''
                },
                spin: false,
                rutas: window.routes
            }
        },

        methods: {

            //async -------------------------------------------------------------------------
            async editar(){
                this.spin = true;

                this.formEditar.anteriores = this.data.anteriores;
                this.formEditar.calibracion_id = this.data.calibracion_id;
                this.formEditar.campo = this.data.campo;

                try{

                    await axios.post(this.rutas.calibracionHistorialStore, this.formEditar);

                    let editar = {campo: this.formEditar.campo, valor: this.formEditar.nuevos, id: this.formEditar.calibracion_id};
                    await axios.put(this.rutas.updateCampo, editar);

                    document.getElementById("boton-cancel").click();
                    this.formEditar.nuevos = '';
                    this.$emit('emitForm', editar);

                }catch(err){
                    this.$swal.fire('Error', 'Pin incorrecto', 'error');
                    this.spin = false;
                }

                this.spin = false;
            },
        },

         computed: {
            desactivado() {
                return this.formEditar.nuevos == '' || this.spin || !this.formEditar.pin;
            }
        },
    }
</script>
