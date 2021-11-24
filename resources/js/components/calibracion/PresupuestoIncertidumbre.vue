<template>
    <div class="row text-left">
        <div class="col-12 mb-18" v-for="(incertidumbre, index) in incertidumbres" :key="index">
            <h3 class="mb-5 pointer" data-toggle="collapse" :data-target="`#collapse-incertidumbre-${index}`">
                <i class="fas fa-plus mr-3"></i> {{ index+1 }}. Puntode de medición: {{ incertidumbre.valores.ip.toFixed(2) }} {{ incertidumbre.valores.unidad }}
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
                            <tr v-for="ebc in incertidumbre.incertidumbre_ebc" :key="ebc.id">
                                <td>{{ ebc.nombre }}</td>
                                <td>{{ ebc.tipo }}</td>
                                <td>{{ ebc.distribucion }}</td>
                                <td>{{ ebc.formula }}</td>
                                <td>{{ ebc.fuente }}</td>
                                <td>{{ ebc.divisor }}</td>
                                <td>{{ ebc.contribucion_u }}</td>
                                <td>{{ ebc.coeficiente }}</td>
                                <td>{{ ebc.contribucion_du }}</td>
                                <td>{{ ebc.u_du }}</td>
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
                            <tr v-for="patron in incertidumbre.incertidumbre_patron" :key="patron.id">
                                <td>{{ patron.nombre }}</td>
                                <td>{{ patron.tipo }}</td>
                                <td>{{ patron.distribucion }}</td>
                                <td>{{ patron.formula }}</td>
                                <td>{{ patron.fuente }}</td>
                                <td>{{ patron.divisor }}</td>
                                <td>{{ patron.contribucion_u }}</td>
                                <td>{{ patron.coeficiente }}</td>
                                <td>{{ patron.contribucion_du }}</td>
                                <td>{{ patron.u_du }}</td>
                                <td>{{ patron.grados_libertad_for }}</td>
                                <td>{{ patron.grados_libertad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="w-100 border-bottom border-primary"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props:  ['incertidumbres'],
    }
</script>

<style lang="scss">
    .titulo{font-size: 1.2rem;}
</style>

