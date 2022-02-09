<template>
    <div class="card-body pt-0">
        <div class="row mx-2 mb-14" v-for="(patron, i) in patrones" :key="i">

            <div class="px-4 py-3 col-12 border-bottom border-primary position-relative">
                <h4 class="font-bold text-primary">{{ patron }}</h4>

                <div class="position-absolute d-flex align-items-center" style="top: 6px; right: 14px">
                    <span class="w-100">U. Medida</span>
                    <select class="form-control" v-model="medidas[i]">
                        <option v-for="(magnitud, i) in magnitudes" :key="i">{{ magnitud }}</option>
                    </select>
                </div>
            </div>

            <cmc-form
                :patron="patron"
                :procedimiento_id="procedimiento.id"
                :medida.sync="medidas[i]">
            </cmc-form>

        </div>
    </div>
</template>

<script>
import CmcForm from './CmcForm';


    export default {
        components: {CmcForm},
        props: ['procedimiento'],

        data() {
            return {
                magnitudes: this.procedimiento.magnitud.unit_measurement,
                medidas: [],
                patrones: [],
            }
        },

        created () {
            this.fetch();
        },

        methods: {
            fetch() {
                this.procedimiento.patrones.forEach(patron => {
                    patron.code.forEach(codigo => this.patrones.push(codigo) );
                });
            },
        },

    }
</script>

<style lang="scss" scoped>

</style>
