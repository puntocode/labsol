<template>
    <div class="col-10 mx-auto">

        <table class="table table-bordered table-sm mb-14">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Datos anteriores</th>
                    <th scope="col">Cambios</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="hist in historial" :key="hist.id">
                    <td v-text="hist.created_at"></td>

                    <td>
                        <ul
                            class="list-group list-group-flush"
                            v-for="(antes, index) in hist.anteriores"
                            :key="index"
                        >
                            <li class="list-group-item">
                                <span class="font-bold text-capitalize">{{index}}: </span>
                                <span class="ml-2">{{ antes }}</span>
                            </li>
                        </ul>
                    </td>

                    <td>
                        <ul
                            class="list-group list-group-flush"
                            v-for="(nuevo, index) in hist.nuevos"
                            :key="index"
                        >
                            <li class="list-group-item">
                                <span class="font-bold text-capitalize">{{index}}: </span>
                                <span class="ml-2">{{ nuevo }}</span>
                            </li>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['historial'],
    }
</script>
