<template>
    <fieldset>
            <div class="form-card mb-12">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Datos básicos:</h4>
                    <h2 class="steps">Paso 1 - 6</h2>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label>N° Expediente <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" disabled :value="form.number" />
                    </div>

                    <div class="col-md-9">
                        <label>Solicitante <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="form.cliente_name" disabled />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Instrumento <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="basico.instrumento" disabled />
                    </div>
                </div>

            </div>

            <button type="button"
                class="next action-button btn btn-primary float-right"
                :disabled="disable"
                @click="siguiente">Siguiente
            </button>
        </fieldset>
</template>

<script>
    export default {
        props: ['form'],
        data() {
            return {
                basico: {...this.form}
            }
        },

        methods: {
            siguiente() {
                this.$emit('click-next')
                this.updateForm()
            },
            updateForm() {
                this.$emit('update:form', this.basico);
            },
        },
        computed: {
            disable() {
                return this.basico.cliente_name.trim() === ''
            }
        },
    }
</script>
