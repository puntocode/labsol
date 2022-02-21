<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-6 d-flex">
                    <label class="label-line">Responsable</label>
                    <input type="text" class="form-control" :value="username" disabled />
                </div>

                <div class="col-md-6 d-flex">
                    <label class="label-line">Fecha de Culminación<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <date-picker v-model="$v.formulario.fecha_fin.$model" :config="options"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-6 d-flex">
                    <label class="label-line">Temperatura Final<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control" type="number" step="0.01" v-model="formulario.temperatura_final" />
                        <div class="input-group-append">
                            <span class="input-group-text text-icon">&#8451;</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <label class="label-line">Humedad Relativa Final<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control" type="number" step="0.01" v-model="formulario.humedad_final" />
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-12 d-flex">
                    <label class="label-line">Observaciones</label>
                    <textarea class="form-control w-100" v-model="formulario.obs"></textarea>
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

            <button type="button"
                class="btn btn-primary"
                title="Por favor completa todos los campos para continuar"
                :disabled="$v.$invalid"
                @click="siguiente">Finalizar
            </button>
        </div>
    </fieldset>
</template>

<script>
    import {required} from "vuelidate/lib/validators";
    import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        components: { datePicker },
        props: ['form', 'datos'],
        data() {
            return {
                formulario: {...this.form},
                options: { format: 'yyyy/MM/DD' },
                rutas: window.routes,
                username: window.username,
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
           if(this.formulario.fecha_fin === null) this.formulario.fecha_fin = new Date().toISOString().substr(0, 10);
        },
        //------------------------------------------------------------------------------------

        methods: {
            siguiente() {
                this.submit();
                this.$emit('click-next')
                this.$emit('update:form', this.formulario);
            },

            async submit(){
                try{
                    // let res = null;

                    // if(this.form.fecha_fin) res = await axios.put(this.rutas.updateHistorico, this.formulario);
                    // else res = await axios.put(`${this.rutas.index}/${this.formulario.id}`, this.formulario);
                    const res = await axios.put(`${this.rutas.index}/${this.formulario.id}`, this.formulario);
                    this.formulario = await res.data;
                }catch(error){
                    this.$swal.fire('Error', 'Error al actualizar', 'error');
                }
            },

            atras() {
                this.$emit('click-back')
            },
        },
        //------------------------------------------------------------------------------------

        validations:{
            formulario:{
                humedad_final: {required},
                temperatura_final: {required},
                fecha_fin: {required},
            }
        },

    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 150px;}
    .input-group-text{max-height: 37px; color:#B5B5C3;}
    .text-icon{font-size: 1.3rem; padding: 0 12px;}
</style>
