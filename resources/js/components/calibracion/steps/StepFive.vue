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
                        <date-picker v-model="formulario.fecha_final" :config="options"></date-picker>
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
            :disabled="disable"
            title="Por favor completa todos los campos para continuar"
            @click="siguiente">Siguiente
        </button>
    </fieldset>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        components: { datePicker },
        props: ['form'],
        data() {
            return {
                options: { format: 'yyyy/MM/DD'},
                formulario: {
                    ...this.form,
                    fecha_final: new Date().toISOString().substr(0, 10),
                    temperatura_final: '',
                    humedad_final: '',
                    responsable: '',
                },
                username: window.username,
            }
        },
         //------------------------------------------------------------------------------------

         computed: {
            disable() {
                return this.formulario.fecha_final.trim() === ''
                    || this.formulario.temperatura_final.trim() === ''
                    || this.formulario.humedad_final.trim() === ''
            }
        },
        //------------------------------------------------------------------------------------

        methods: {
            siguiente() {
                this.$emit('click-next')
                this.$emit('update:form', this.formulario);
            }
        },
    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 150px;}
    .input-group-text{max-height: 37px; color:#B5B5C3;}
    .text-icon{font-size: 1.3rem; padding: 0 12px;}
</style>
