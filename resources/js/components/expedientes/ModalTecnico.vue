<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tecnico"><i class="fas fa-user"></i> <slot></slot> </button>

        <div class="modal fade" id="modal-tecnico" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <asignar-tecnico :data="datos"></asignar-tecnico>
            </div>
	    </div>
    </div>
</template>

<script>
    import AsignarTecnico from './AsignarTecnico'
    export default {
        props: ['datos'],
        components: { AsignarTecnico },
    }
</script>

<style lang="scss" scoped>

</style>
