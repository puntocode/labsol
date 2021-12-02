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
        </div>

        <button type="button"
            class="float-right btn btn-primary"
            title="Por favor completa todos los campos para continuar"
            :disabled="$v.$invalid"
            @click="siguiente">Finalizar
        </button>
    </fieldset>
</template>

<script>
    import {required} from "vuelidate/lib/validators";
    import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        components: { datePicker },
        props: ['form'],
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
            async siguiente() {
                await this.submit();
                this.$emit('click-next')
                this.$emit('update:form', this.formulario);
            },

            async submit(){
                try{
                    const res = await axios.put(`${this.rutas.index}/${this.formulario.id}`, this.formulario);
                    this.formulario = await res.data;

                    const data = {expediente_id: this.formulario.expediente_id, expediente_estado_id: 3};
                    const response = await axios.put(this.rutas.estadoExpediente, data);
                }catch(error){
                    this.$swal.fire('Error', 'Error al actualizar', 'error');
                }
            }
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
