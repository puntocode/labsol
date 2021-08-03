<template>
    <div class="card-body">
        <HistorialCalibracion :rutas="rutas" :id="id" />
    </div>
</template>

<script>
    import HistorialCalibracion from '../HistorialCalibracion'

    export default {
        components: { HistorialCalibracion },
        props: ['id'],
        data() {
            return {
                rutas: window.routes,
            }
        },
    }
</script>
