<template>
    <div class="row my-18">
        <div class="col-10 mx-auto">
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
    </div>
</template>

<script>
    export default {
        props:  ['certificados', 'redondeo'],
    }
</script>
