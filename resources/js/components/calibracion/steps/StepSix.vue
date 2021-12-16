<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <success-animation></success-animation>
            <div class="col-12 text-center">
                <p class="mb-4" style="color: #4bb71b; font-size: 35px;">La Calibración ha Finalizado</p>
                <a :href="this.rutas.certificados" class="btn btn-primary">Ver certificado</a>
            </div>
        </div>
    </fieldset>
</template>

<script>
    import SuccessAnimation from '../../SuccessAnimation';

    export default {
        props: ['expediente_id'],
        components: { SuccessAnimation },

        data() {
            return {
                rutas: window.routes,
            }
        },

        created () {
            this.updateEstado();
        },

        methods: {
            updateEstado() {
                let data = {expediente_id: this.expediente_id, expediente_estado_id: 3}
                axios.put(this.rutas.estadoExpediente, data)
                    .then(response => console.log(response.data))
            }
        },
    }
</script>

