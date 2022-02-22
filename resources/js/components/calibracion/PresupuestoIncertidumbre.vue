<template>
    <div class="row text-left">
        <div class="col-12 mb-18" v-for="(incer, index) in incertidumbres" :key="index">
            <h3 class="mb-5 pointer" data-toggle="collapse" :data-target="`#collapse-incertidumbre-${index}`">
                <i class="fas fa-plus mr-3"></i> {{ index+1 }}. Punto de medición: {{ resultados[index].ip !== undefined ? resultados[index].ip.toFixed(2) : '' }} {{ resultados[index].unidad }}
            </h3>

            <div class="collapse" :id="`collapse-incertidumbre-${index}`">
                <p class="mb-3 titulo text-primary">Contribuciones del equipo bajo calibración (EBC)</p>

                <div class="table-responsive">
                    <table class="table table-separate table-bordered table-head-custom collapsed mb-5">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Distribución</th>
                            <th scope="col">Fórmula General u(i).du(i)</th>
                            <th scope="col">Fuente de incertidumbre</th>
                            <th scope="col">Divisor</th>
                            <th scope="col">Contribución u(i)</th>
                            <th scope="col">Coeficiente de sensibilidad</th>
                            <th scope="col">Contribución du(i)</th>
                            <th scope="col">u(i).du(i)</th>
                            <th colspan="2">Grados de libertad </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="ebc in ebcs[index]" :key="ebc.id">
                                <td>{{ ebc.nombre }}</td>
                                <td>{{ ebc.tipo }}</td>
                                <td>{{ ebc.distribucion }}</td>
                                <td class="text-center"><img :src="`${asset}media/formulas/${ebc.formula}.jpg`" alt="formula" height="45"></td>
                                <td>{{ ebc.fuente }}</td>
                                <td>{{ ebc.divisor }}</td>
                                <td>{{ ebc.u.toExponential(2) }}</td>
                                <td>{{ ebc.coeficiente }}</td>
                                <td>{{ ebc.contribucion_du }}</td>
                                <td>{{ ebc.u_du.toExponential(2) }}</td>
                                <td>{{ ebc.grados_libertad_for }}</td>
                                <td>{{ ebc.g_libertad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->


                <p class="titulo text-primary mt-10 mb-3">Contribuciones del patrón <strong>{{ resultados[index].patron }}</strong></p>
                <div class="table-responsive">
                    <table class="table table-separate table-bordered table-head-custom collapsed mb-5">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Distribución</th>
                            <th scope="col">Fórmula General u(i).du(i)</th>
                            <th scope="col">Fuente de incertidumbre</th>
                            <th scope="col">Divisor</th>
                            <th scope="col">Contribución u(i)</th>
                            <th scope="col">Coeficiente de sensibilidad</th>
                            <th scope="col">Contribución du(i)</th>
                            <th scope="col">u(i).du(i)</th>
                            <th colspan="2">Grados de libertad </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="patron in patrons[index]" :key="patron.id">
                                <td>{{ patron.nombre }}</td>
                                <td>{{ patron.tipo }}</td>
                                <td>{{ patron.distribucion }}</td>
                                <td class="text-center"><img :src="`${asset}media/formulas/${patron.formula}.jpg`" alt="formula" height="45"></td>
                                <td>{{ patron.fuente }}</td>
                                <td>{{ patron.divisor }}</td>
                                <td>{{ patron.u.toExponential(2) }}</td>
                                <td>{{ patron.coeficiente }}</td>
                                <td>{{ patron.contribucion_du }}</td>
                                <td>{{ patron.u_du.toExponential(2) }}</td>
                                <td>{{ patron.grados_libertad_for }}</td>
                                <td>{{ patron.grados_libertad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="row mt-10 px-4">
                    <div class="co-lg-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Incertidumbre Combinada</th>
                                    <td><img :src="`${asset}media/formulas/incer_combinada.jpg`" alt="formula" height="55"></td>
                                    <td>{{ resultados[index].incertidumbre_combinada.toExponential(2)  }} {{ resultados[index].unidad }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Grados de libertad efectivos</th>
                                    <td><img :src="`${asset}media/formulas/g_libertad_efectivos.jpg`" alt="formula" height="55"></td>
                                    <td>{{ resultados[index].g_libertad_efectivos == 0 ? '∞' : resultados[index].g_libertad_efectivos.toExponential(2) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Factor de cobertura (95,45%)</th>
                                    <td class="text-center"><img :src="`${asset}media/formulas/k.jpg`" alt="formula" height="35"></td>
                                    <td>{{ resultados[index].k  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Incertidumbre Expandida</th>
                                    <td class="text-center"><img :src="`${asset}media/formulas/incer_expandida.jpg`" alt="formula" height="35"></td>
                                    <td>{{ resultados[index].incertidumbre_expandida.toExponential(2)  }} {{ resultados[index].unidad }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="w-100 border-bottom border-primary"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props:  ['incertidumbres', 'resultados'],
        data() {
            return {
                asset: window.asset,
                ebcs: [],
                patrons: [],
            }
        },

        watch:{
            incertidumbres(){
                let size = this.incertidumbres.length - 1;
                let array = [...this.incertidumbres[size]];
                let ebc = array.filter(ebc => ebc.contribucion === 'EBC');
                let patron = array.filter(patron => patron.contribucion === 'PATRON');
                this.ebcs.push(ebc);
                this.patrons.push(patron);
            },
        }
    }
</script>

<style lang="scss">
    .titulo{font-size: 1.2rem;}
</style>

