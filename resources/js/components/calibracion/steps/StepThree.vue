<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-12 d-flex">
                    <label class="label-line">Procedimiento</label>
                    <input type="text" class="form-control" :value="form.procedimiento" disabled />
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-6 d-flex">
                    <label class="label-line">Fecha de Inicio <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <date-picker v-model="formulario.fecha_inicio" :config="options"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <label class="label-line">Lugar <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model="formulario.lugar" autofocus />
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-6 d-flex">
                    <label class="label-line">Temperatura Inical <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control" type="number" step="0.01" v-model="formulario.temperatura_inicial" />
                        <div class="input-group-append">
                            <span class="input-group-text text-icon">&#8451;</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <label class="label-line">Humedad Relativa Inicial <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control" type="number" step="0.01" v-model="formulario.humedad_inicial" />
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
                    fecha_inicio: new Date().toISOString().substr(0, 10),
                    lugar: this.form.type,
                    temperatura_inicial: '',
                    humedad_inicial: '',
                    obs: '',
                }
            }
        },
        //------------------------------------------------------------------------------------

         computed: {
            disable() {
                return this.formulario.fecha_inicio.trim() === ''
                    || this.formulario.lugar.trim() === ''
                    || this.formulario.temperatura_inicial.trim() === ''
                    || this.formulario.humedad_inicial.trim() === ''
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

