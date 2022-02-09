<template>

    <table class="table table-sm table-bordered">
        <thead>
            <tr class="cabecera">
                <th scope="col">#</th>
                <th scope="col">Rango De</th>
                <th scope="col">Rango A</th>
                <th scope="col">CMC</th>
                <th v-show="show" scope="col" class="text-center">Accion</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(cmc, i) in cmcTable" :key="i">
                <th v-text="i+1">1</th>
                <td>{{ cmc.rango_de }} {{ cmc.rango_unidad }}</td>
                <td>{{ cmc.rango_a }} {{ cmc.rango_unidad }}</td>
                <td>{{ cmc.cmc }} {{ cmc.cmc_unidad }}</td>
                <td v-show="show" class="text-center">

                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
    export default {
        props: ['cmcTable', 'show']
    }
</script>


<style lang="scss">
    .cabecera{
        th{padding-top: 5px !important; padding-bottom: 5px !important; background-color: #ececec;}
    }
</style>


