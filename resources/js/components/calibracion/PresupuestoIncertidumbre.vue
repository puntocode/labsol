<template>
    <div class="row text-left">
        <div class="col-12 mb-18" v-for="(incertidumbre, index) in incertidumbres" :key="index">
            <h3 class="mb-5 pointer" data-toggle="collapse" :data-target="`#collapse-incertidumbre-${index}`">
                <i class="fas fa-plus mr-3"></i> {{ index+1 }}. Punto de medición: {{ incertidumbre.valores.ip.toFixed(2) }} {{ incertidumbre.valores.unidad }}
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
                            <tr v-for="ebc in incertidumbre.incertidumbreEbc" :key="ebc.id">
                                <td>{{ ebc.nombre }}</td>
                                <td>{{ ebc.tipo }}</td>
                                <td>{{ ebc.distribucion }}</td>
                                <td class="text-center"><img :src="`${asset}media/formulas/${ebc.formula}.jpg`" alt="formula" height="45"></td>
                                <td>{{ ebc.fuente }}</td>
                                <td>{{ ebc.divisor }}</td>
                                <td>{{ ebc.contribucion_u.toExponential(2) }}</td>
                                <td>{{ ebc.coeficiente }}</td>
                                <td>{{ ebc.contribucion_du }}</td>
                                <td>{{ ebc.u_du.toExponential(2) }}</td>
                                <td>{{ ebc.grados_libertad_for }}</td>
                                <td>{{ ebc.grados_libertad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <p class="titulo text-primary mt-10 mb-3">Contribuciones del patrón <strong>{{ incertidumbre.valores.patron }}</strong></p>
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
                            <tr v-for="patron in incertidumbre.incertidumbrePatron" :key="patron.id">
                                <td>{{ patron.nombre }}</td>
                                <td>{{ patron.tipo }}</td>
                                <td>{{ patron.distribucion }}</td>
                                <td class="text-center"><img :src="`${asset}media/formulas/${patron.formula}.jpg`" alt="formula" height="45"></td>
                                <td>{{ patron.fuente }}</td>
                                <td>{{ patron.divisor }}</td>
                                <td>{{ patron.contribucion_u.toExponential(2) }}</td>
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
                                    <td>{{ resultados[index].combinada.toExponential(2)  }} {{ incertidumbre.valores.unidad }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Grados de libertad efectivos</th>
                                    <td><img :src="`${asset}media/formulas/g_libertad_efectivos.jpg`" alt="formula" height="55"></td>
                                    <td>{{ resultados[index].g_libertad_efectivos.toExponential(2) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Factor de cobertura (95,45%)</th>
                                    <td class="text-center"><img :src="`${asset}media/formulas/k.jpg`" alt="formula" height="35"></td>
                                    <td>{{ resultados[index].factor_cobertura  }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Incertidumbre Expandida</th>
                                    <td class="text-center"><img :src="`${asset}media/formulas/incer_expandida.jpg`" alt="formula" height="35"></td>
                                    <td>{{ resultados[index].expandida.toExponential(2)  }} {{ incertidumbre.valores.unidad }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="d-flex">
                            <h4 class="mr-4 text-primary">Incertidumbre combinada</h4>
                            <strong>{{ resultados[index].combinada.toExponential(2)  }} {{ incertidumbre.valores.unidad }}</strong>
                        </div>
                        <div class="d-flex">
                            <h4 class="mr-4 text-primary">Grados de libertad efectivos</h4>
                            <strong>{{ resultados[index].g_libertad_efectivos.toExponential(2) }}</strong>
                        </div>
                        <div class="d-flex">
                            <h4 class="mr-4 text-primary">Factor de cobertura (95,45%)</h4>
                            <strong>{{ resultados[index].factor_cobertura  }}</strong>
                        </div>
                        <div class="d-flex">
                            <h4 class="mr-4 text-primary">Incertidumbre combinada</h4>
                            <strong>{{ resultados[index].expandida.toExponential(2)  }} {{ incertidumbre.valores.unidad }}</strong>
                        </div> -->
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
                asset: window.asset
            }
        },
    }
</script>

<style lang="scss">
    .titulo{font-size: 1.2rem;}
</style>

