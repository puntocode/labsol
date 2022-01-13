<template>
    <div class="mt-8">
        <div class="row">
            <div class="col-12">
                <h3>Historial de Estados</h3>
                <hr>

                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Realizado por</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(hist, index) in historial" :key="index">
                            <th scope="row">{{ index+1 }}</th>
                            <th>{{ hist.created_at }}</th>
                            <td>{{ hist.user.fullname }}</td>
                            <td class="text-center">
                                <span class="badge" :class="`badge-${hist.estado_nuevo.color}`">{{ hist.estado_nuevo.name }}</span>
                            </td>
                            <td>{{ hist.estado_comentario }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['historial'],
    }
</script>
