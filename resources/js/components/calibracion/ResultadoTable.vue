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
                        <td>{{ resultado.desv_ip.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>
                            {{ resultado.error_ip === 'Error'
                            ? 'Error'
                            : `${resultado.error_ip.toFixed(redondeo)} ${resultado.unidad}` }}
                        </td>
                        <td>{{ resultado.ip_corregido.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.iec.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.desv_iec.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                        <td>{{ resultado.error_iec.toFixed(redondeo) }}</td>
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

