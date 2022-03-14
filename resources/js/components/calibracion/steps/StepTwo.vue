<template>
    <fieldset>
        <div class="mb-10 form-card">
            <div class="mb-12 d-flex justify-content-between"><slot></slot></div>

            <div class="form-group row text-left" v-for="(patron, index) in patrones" :key="index">
               <label class="col-sm-3 col-form-label" v-text="patron.name"></label>

                <div class="col-md-9">
                    <div class="input-icons" v-if="form.patrones && form.patrones[index].code">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.patrones[index].code, 'patrones', 'select-multiple', patrones[index].code, {select: form.patrones, index })"
                        ></i>
                        <input class="form-control" :value="form.patrones[index].code" disabled />
                    </div>


                    <div class="w-100 d-flex" v-else>
                        <SelectMultiple class="w-100" v-model="formulario.patrones[index].code" :options="patron.code" />
                        <button
                            type="button"
                            class="btn btn-success px-2 ml-3"
                            :disabled="!formulario.patrones[index].code"
                            @click="updateCampo('patrones')">
                            <i class="pl-3 pr-2 la la-check icon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left">
               <label class="col-sm-3 col-form-label">Equipos De Medición Ambiental</label>
                <div class="col-md-9">
                    <div class="input-icons" v-if="form.ema">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.ema, 'ema', 'select', ambiental)"
                        ></i>
                        <input class="form-control" :value="form.ema" disabled />
                    </div>

                    <div v-else class="d-flex w-100">
                        <select v-model="formulario.ema" class="form-control">
                            <option value="null" disabled>-- Selecione un equipo --</option>
                            <option v-for="(ema, i) in ambiental" :key="i">{{ ema }}</option>
                        </select>

                        <button
                            type="button"
                            class="btn btn-success px-2 ml-3"
                            :disabled="!formulario.ema"
                            @click="updateCampo('ema')">
                            <i class="pl-3 pr-2 la la-check icon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left">
                <label class="col-sm-3 col-form-label">Observaciones Generales</label>
                <div class="col-md-9">
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
                :disabled="!form.patrones || !form.ema"
                @click="siguiente">Siguiente
            </button>
        </div>

        <ModalEdit :data="formEdit" @emitForm="emitForm" />

    </fieldset>
</template>

<script>
    import {required} from "vuelidate/lib/validators";
    import SelectMultiple from 'v-select2-multiple-component';
    import ModalEdit from './ModalEdit';


    export default {
        components: { SelectMultiple, ModalEdit },
        props: ['form', 'datos'],
        data() {
            return {
                formulario: {},
                formEdit: {},
                activado: {},
                error: true,
                patrones: [],
                ambiental: [],
                rutas: window.routes
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch(){
                this.ambiental = await this.datos.procedimiento.ambiental.code
                this.patrones = await this.datos.procedimiento.patrones.map(patron => {
                    return {name: patron.patron, code: patron.code}
                });

                if(this.form.patrones === null){
                    this.formulario.patrones = this.patrones.map(patron => { return {name: patron.name, code: []} });
                }
            },
            modalEditar(anteriores, campo, type = 'text', select = [], patron = null){
                this.formEdit = {
                    anteriores,
                    campo,
                    calibracion_id: this.form.id,
                    select,
                    type,
                    patron
                };
            },

            siguiente() {
                this.$emit('click-next')
            },

            atras() {
                this.$emit('click-back')
            },

            async updateCampo(campo){
                try{
                    let data  = {campo, valor: this.formulario[campo], id: this.form.id};

                    if(!data.valor) throw new Error('El campo es obligatorio');

                    const res = await axios.put(this.rutas.updateCampo, data);
                    const value = await res.data;

                    if(value) this.$emit('update-form', data);
                }catch(err){
                    this.$swal.fire('Error', err.message, 'error');
                }
            },

            emitForm(editado){
                this.$emit('update-form', editado);
            }
        },
        //------------------------------------------------------------------------------------

        validations:{
            formulario:{
                ema: {required},
                patrones: {
                    $each: {
                        name: {required},
                        code: {required}
                    }
                }
            }
        }


    }
</script>

<style lang="scss" scoped>
    .input-icons { width: 100%; position: relative;
        i { position: absolute; padding: 10px; color: #009BDD;  right: 0; cursor: pointer; }
    }
</style>
