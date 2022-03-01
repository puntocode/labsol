<template>
    <div class="col-10 mx-auto">

        <table class="table table-bordered table-sm mb-14">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Campo</th>
                    <th scope="col">Dato anterior</th>
                    <th scope="col">Cambio</th>
                    <th scope="col">Modificado Por</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="hist in historial" :key="hist.id">
                    <td v-text="hist.created_at"></td>
                    <td v-text="changeBar(hist.campo)" class="text-capitalize"></td>
                    <td v-text="hist.anteriores"></td>
                    <td v-text="hist.nuevos"></td>
                    <td v-text="hist.user.fullname"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['historial'],

        methods: {
            changeBar(text) {
                return text.replace("_", " ");
            }
        },
    }
</script>

