<template>
    <div class="mt-14" v-if="historials.length">
        <h3 class="border-bottom border-primary mb-8">Historial de Cambios</h3>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Patron</th>
                    <th>IP Medida</th>
                    <th v-for="(ipV, v) in historials[0].ip_valor" :key="v">IP Valor</th>
                    <th>IEC Medida</th>
                    <th v-for="(iecV, c) in historials[0].iec_valor" :key="`iecv-${c}`">IEC Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="historial in historials" :key="historial.id">
                    <td>{{ historial.patron }}</td>

                    <td>{{ historial.ip_medida  }}</td>

                    <td class="text-black-50"
                        v-for="(ip, i) in historial.ip_valor"
                        :key="`ip-${i}`">
                        {{ ip }}
                    </td>

                    <td>{{ historial.iec_medida }}</td>

                    <td class="text-black-50"
                        v-for="(iec, j) in historial.iec_valor"
                        :key="`iec-${j}`">
                        {{ iec }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['calibracion_id'],

        data() {
            return {
                historials: [],
                rutas: window.routes
            }
        },

        created () {
            this.fetch();
        },

        methods: {
            async fetch() {
                try{
                    let res = await axios.get(this.rutas.valorHistorialGet, {params: {calibracion_id: this.calibracion_id}});
                    this.historials = await res.data;
                }catch(error){
                    console.error(error);
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
