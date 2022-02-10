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
                    <span class="pointer" @click="editar(cmc, i)"><i class="fas fa-edit text-primary"></i></span>
                    <span class="ml-3 pointer" @click="eliminar(cmc.id, i)"><i class="fas fa-trash text-danger"></i></span>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
    export default {
        props: ['cmcTable', 'show'],


        data() {
            return {
                rutas: window.routes,
            }
        },


        methods: {
            editar(cmc, index){
                cmc.index = index;
                this.$emit('editarCmc', cmc);
            },

            eliminar(id, index){
                this.$swal.fire({
                    title: 'Eliminar',
                    text: 'Desea eliminar este registro?',
                    icon: 'question',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                })
                .then( result => {
                    if(result.isConfirmed){
                        axios.delete(this.rutas.eliminar, {data: {id}})
                            .then(response => {
                                this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success');
                                this.cmcTable.splice(index, 1);
                            }).catch( error => this.$swal.fire('Error', 'Error no se pudo eliminar!', 'error'));
                    }
                });
            }
        },
    }
</script>


<style lang="scss">
    .cabecera{
        th{padding-top: 5px !important; padding-bottom: 5px !important; background-color: #ececec;}
    }
</style>


