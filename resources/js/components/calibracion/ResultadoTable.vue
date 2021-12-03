<template>
    <div class="row my-18">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">IP</th>
                    <th scope="col">Desvío estandar IP</th>
                    <th scope="col">Error Patrón</th>
                    <th scope="col">IP Corregido</th>
                    <th scope="col">IEC</th>
                    <th scope="col">Desvío estandar IEC</th>
                    <th scope="col">Error</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(resultado, index) in resultados" :key="index">
                        <td>{{ resultado.ip.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.desvIP.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>
                            {{ resultado.errorIP === 'Error'
                            ? 'Error'
                            : `${resultado.errorIP.toFixed(redondeo)} ${resultado.unidad}` }}
                        </td>
                        <td>{{ resultado.ipCorregido.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.iec.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.desvIEC.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.errorIEC.toFixed(redondeo) }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resultados', 'redondeo']
    }
</script>

