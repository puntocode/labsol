<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <success-animation></success-animation>
            <div class="col-12 text-center">
                <p class="mb-4" style="color: #4bb71b; font-size: 35px;">La Calibración ha Finalizado</p>
            </div>
        </div>
    </fieldset>
</template>

<script>
    import SuccessAnimation from '../../SuccessAnimation';

    export default {
        components: { SuccessAnimation },
    }
</script>

