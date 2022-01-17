<template>
    <div class="row my-18" v-if="certificados.length">
        <div class="col-12">
            <h3 class="border-bottom border-primary mb-8">Resultados Obtenidos</h3>
        </div>

        <div class="col-lg-6">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">IP</th>
                        <th scope="col" class="text-center">IEC</th>
                        <th scope="col" class="text-center">E</th>
                        <th scope="col" class="text-center">U</th>
                        <th scope="col" class="text-center">k</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="thead-light" v-if="certificados.length">
                        <td class="text-center">{{ certificados[0].unidad }}</td>
                        <td class="text-center">{{ certificados[0].unidad }}</td>
                        <td class="text-center">{{ certificados[0].unidad }}</td>
                        <td class="text-center">{{ certificados[0].unidad }}</td>
                        <td class="text-center">-</td>
                    </tr>
                    <tr v-for="(certificado, index) in certificados" :key="index">
                        <td>{{ certificado.ip.toFixed(redondeo) }}</td>
                        <td>{{ certificado.iec.toFixed(redondeo) }}</td>
                        <td>{{ certificado.e.toFixed(redondeo) }}</td>
                        <td>{{ certificado.u.toFixed(redondeo) }}</td>
                        <td>{{ certificado.k.toFixed(redondeo) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="col-lg-6">
            <Plotly v-if="graph" :key="key" :data="data" :layout="layout" :display-mode-bar="false"></Plotly>
        </div>
    </div>
</template>

<script>
    import { Plotly } from 'vue-plotly'

    export default {
        props:  ['certificados', 'redondeo'],
        components: { Plotly },

        data() {
            return {
                key: 0,
                data:[{
                    x: [],
                    y: [],
                    error_y: {
                        type: 'data',
                        array: [],
                        visible: true
                    },
                    type: 'scatter'
                }],
                layout:{ title: "Error + Incertidumbre" }
            }
        },

        methods: {
            cargarTabla() {
                for(let i = 0; i < this.certificados.length; i++){
                    this.data[0].x.push(this.certificados[i].ip);
                    this.data[0].y.push(this.certificados[i].e);
                    this.data[0].error_y.array.push(this.certificados[i].u);
                }
            }
        },

        watch: {
            certificados() {
                if(this.key === 0 && this.certificados.length){
                    this.cargarTabla();
                    this.key = this.certificados.length;
                    return;
                }

                const indice = this.certificados.length - 1;
                this.data[0].x.push(this.certificados[indice].ip);
                this.data[0].y.push(this.certificados[indice].e);
                this.data[0].error_y.array.push(this.certificados[indice].u);
                this.key++;
            }
        },

        computed: {
            graph() {
                return this.certificados.length;
            }
        },
    }
</script>
