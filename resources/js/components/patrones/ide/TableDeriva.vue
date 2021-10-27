<template>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">IP</th>
            <th scope="col">U</th>
            <th scope="col">k</th>
            <th scope="col">uc</th>
            <th scope="col">E (actual)</th>
            <th scope="col"
                v-show="derivas[0].e_anterior.length > 0"
                v-for="anterior in derivas[0].e_anterior.length" :key="anterior.valor">
                E (anterior)
            </th>
            <th scope="col">Deriva</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(deriva, index) in derivas" :key="index">
                <td>{{ deriva.ip.valor }} {{ deriva.ip.medida }}</td>
                <td>{{ deriva.u.valor }} {{ deriva.u.medida }}</td>
                <td>{{ deriva.k }}</td>
                <td>{{ deriva.uc.valor }} {{ deriva.uc.medida }}</td>
                <td>{{ deriva.e_actual.valor }} {{ deriva.e_actual.medida }}</td>
                <td
                    v-show="derivas[0].e_anterior.length > 0"
                    v-for="(anterior, i) in derivas[index].e_anterior" :key="i">
                        <span v-text="anteriorValue(anterior.valor, anterior.medida)"></span>
                </td>
                <td>{{ deriva.deriva.valor }} {{ deriva.deriva.medida }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>

    export default {
        props: ['derivas'],
        methods: {
            anteriorValue(valor, medida) {
                return valor !== null ? `${valor} ${medida}` : '-';
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
