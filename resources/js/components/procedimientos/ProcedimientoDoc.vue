<template>
    <div class="card-body">
        <Documentos :url="this.rutas.storeDoc" />
    </div>
</template>

<script>
    import Documentos from '../Documentos'
    export default {
        components: { Documentos, },
        data() {
            return {
                rutas: window.routes,
            }
        },
    }
</script>
