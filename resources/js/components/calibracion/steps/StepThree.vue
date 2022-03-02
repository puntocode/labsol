<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-12 d-flex">
                    <label class="label-line">Procedimiento</label>
                    <input type="text" class="form-control" :value="datos.procedimiento.code" disabled />
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <!-------------------------------- F. de Inicio ------------------------------------------------------------------------------------------------>
                <div class="col-md-6 d-flex">
                    <label class="label-line">Fecha de Inicio <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.fecha_inicio">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.fecha_inicio, 'fecha_inicio', 'date')"
                        ></i>
                        <input class="form-control" :value="form.fecha_inicio" disabled />
                    </div>

                    <div v-else class="d-flex w-100">
                        <div class="input-icons">
                            <i class="la la-calendar"></i>
                            <date-picker v-model.lazy="formulario.fecha_inicio" class="pl-10" :config="options" @blur="updateCampo('fecha_inicio')"></date-picker>
                        </div>

                        <button
                            type="button"
                            class="btn btn-success ml-2 p-0"
                            :disabled="!formulario.fecha_inicio"
                            @click="updateCampo('fecha_inicio')">
                            <i class="la la-check icon px-3"></i>
                        </button>
                    </div>
                </div>


                <!-------------------------------- Lugar ------------------------------------------------------------------------------------------------------>
                <div class="col-md-6 d-flex">
                    <label class="label-line">Lugar <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.lugar">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.lugar, 'lugar')"
                        ></i>
                        <input class="form-control" :value="form.lugar" disabled />
                    </div>
                    <input
                        v-else
                        class="form-control"
                        @blur="updateCampo('lugar')"
                        v-model.lazy="formulario.lugar" />
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <!-------------------------------- Temp. Inicial ---------------------------------------------------------------------------------------------->
                <div class="col-md-6 d-flex">
                    <label class="label-line">Temperatura Inicial <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.temperatura_inicial">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.temperatura_inicial, 'temperatura_inicial', 'number')"
                        ></i>
                        <input class="form-control" :value="`${form.temperatura_inicial} ℃`" disabled />
                    </div>

                    <div class="input-group" v-else>
                        <input
                            class="form-control"
                            type="number"
                            step="0.01"
                            v-model.lazy="formulario.temperatura_inicial"
                            @blur="updateCampo('temperatura_inicial')" />
                        <div class="input-group-append">
                            <span class="input-group-text text-icon">&#8451;</span>
                        </div>
                    </div>
                </div>

                <!-------------------------------- Humedad. Inicial ------------------------------------------------------------------------------------->
                <div class="col-md-6 d-flex">
                    <label class="label-line">Humedad Relativa Inicial <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.humedad_inicial">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.humedad_inicial, 'humedad_inicial', 'number')"
                        ></i>
                        <input class="form-control" :value="`${form.humedad_inicial} %`" disabled />
                    </div>

                    <div class="input-group" v-else>
                        <input
                            class="form-control"
                            type="number"
                            step="0.01"
                            v-model.lazy="formulario.humedad_inicial"
                            @blur="updateCampo('humedad_inicial')" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <!-------------------------------- Observaciones ------------------------------------------------------------------------------------->
                <div class="col-md-12 d-flex">
                    <label class="label-line">Observaciones</label>


                    <div class="input-icons" v-if="form.obs">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.obs, 'obs', 'text-area')"
                        ></i>
                        <textarea v-if="form.obs" class="form-control w-100" :value="form.obs" disabled></textarea>
                    </div>

                    <textarea v-else
                        class="form-control w-100"
                        v-model.lazy="formulario.obs"
                        @blur="updateCampo('obs', false)"
                    ></textarea>
                </div>
            </div>

            <div class="form-group row text-left">
                <div class="col-12 d-flex">
                    <label class="label-line">Observaciones Generales</label>
                    <div class="card w-100">
                        <div class="card-body p-4" v-html="datos.general"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button
                type="button"
                class="btn btn-secondary"
                @click="atras">Atrás
            </button>

            <button
                type="button"
                class="btn btn-primary"
                :disabled="disable"
                @click="siguiente">Siguiente
            </button>
        </div>

        <ModalEdit :data="formEdit" @emitForm="emitForm" />
    </fieldset>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import ModalEdit from './ModalEdit';

    export default {
        components: { datePicker, ModalEdit },
        props: ['form', 'datos'],
        data() {
            return {
                formulario: {},
                options: { format: 'yyyy/MM/DD' },
                formEdit: {},
                rutas: window.routes
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            fetch(){
                if(!this.form.fecha_inicio) this.formulario.fecha_inicio = new Date().toISOString().substr(0, 10);
                this.formulario.lugar = this.datos.tipo == 'LS' ? 'Labsol' : '';
            },

            siguiente() {
                this.$emit('click-next')
            },
            atras() {
                this.$emit('click-back')
            },
            modalEditar(anteriores, campo, type = 'text', select = []){
                this.formEdit = {
                    anteriores,
                    campo,
                    calibracion_id: this.form.id,
                    select,
                    type
                };
            },

            emitForm(editado){
                this.$emit('update-form', editado);
            },

            async updateCampo(campo, obligatorio=true){
                try{
                    const valor = this.formulario[campo];
                    if(!valor && obligatorio) throw new Error('El campo es obligatorio');
                    if(!valor) return;


                    let data  = {campo, valor, id: this.form.id};
                    const res = await axios.put(this.rutas.updateCampo, data);
                    const value = await res.data;

                    if(value) this.$emit('update-form', data);
                }catch(err){
                    this.$swal.fire('Error', err.message, 'error');
                }
            },



        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
                return !this.form.lugar
                    || !this.form.fecha_inicio
                    || !this.form.humedad_inicial
                    || !this.form.temperatura_inicial
            }
        },
    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 150px;}
    .input-group-text{max-height: 37px; color:#B5B5C3;}
    .text-icon{font-size: 1.3rem; padding: 0 12px;}
    .input-icons { width: 100%; position: relative;
        i { position: absolute; padding: 10px; color: #009BDD;  right: 0; cursor: pointer; }
    }


</style>

