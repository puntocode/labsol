<template>
    <div class="mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="text-primary">Historial de Asignaciones</h3>
                <hr>
            </div>
             <div class="col-4">
                <label>Fecha de entrega</label>
            </div>
            <div class="col-8">
                <label>Tecnicos</label>
            </div>
        </div>

        <div v-for="(item, index) in newHistorial" :key="index" class="row py-2">
            <div class="col-4" v-if="index !== newHistorial.length-1">
                <span class="font-weight-bold">{{ item.delivery_date }}</span>
            </div>
            <div class="col-8" v-if="index !== newHistorial.length-1">
                <div class="form-control p-0 border-0 h-auto">
                    <span class="font-weight-bold"><i class="fas fa-user mr-2"></i></span>
                    <span v-for="(tecnicos, index) in item.tecnicos" :key="index"><span v-if="index > 0">,</span> {{tecnicos.nombre }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['historial'],
        data() {
            return {
                newHistorial: []
            }
        },
        mounted () {
            this.newHistorial = this.historial;
        },
    }
</script>
