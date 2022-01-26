<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" v-if="rutas !== undefined"></th>
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
                    <th scope="col" class="text-center" v-if="rutas !== undefined">Oculto</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(deriva, index) in derivas" :key="index">
                    <td v-if="rutas !== undefined" class="text-center">
                        <span class="pointer" @click="editar(deriva, index)"><i class="fas fa-edit text-primary"></i></span>
                        <span class="ml-3 pointer" @click="eliminar(deriva.id, index)"><i class="fas fa-trash text-danger"></i></span>
                    </td>
                    <td>{{ deriva.ip.valor }} {{ deriva.ip.medida }}</td>
                    <td>{{ deriva.u.valor }} {{ deriva.u.medida }}</td>
                    <td>{{ deriva.k }}</td>
                    <td>{{ deriva.uc.valor.toFixed(4) }} {{ deriva.uc.medida }}</td>
                    <td>{{ deriva.e_actual.valor }} {{ deriva.e_actual.medida }}</td>
                    <td
                        v-show="derivas[0].e_anterior.length > 0"
                        v-for="(anterior, i) in derivas[index].e_anterior" :key="i">
                            <span v-text="anteriorValue(anterior.valor, anterior.medida)"></span>
                    </td>
                    <td>{{ deriva.deriva.valor }} {{ deriva.deriva.medida }}</td>
                    <td v-if="rutas !== undefined" class="text-center">
                        <span class="pointer" @click="ocultar(index)">
                            <i class="fas fa-eye" :class="deriva.oculto ? 'text-success' : ''"></i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    export default {
        props: ['derivas'],
        data() {
            return {
                rutas: window.routes,
            }
        },
        methods: {
            anteriorValue(valor, medida) {
                return valor !== null ? `${valor} ${medida}` : '-';
            },
            editar(deriva, index){
                deriva.index = index;
                this.$emit('editarDeriva', deriva);
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
                        const ruta = `${this.rutas.ruta_deriva}/${id}`;
                        axios.delete(ruta)
                            .then(response => {
                                this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success');
                                this.derivas.splice(index, 1);
                            }).catch( error => this.$swal.fire('Error', 'Error no se pudo eliminar!', 'error'));
                    }
                });
            },

            ocultar(index){
                let data = { id: this.derivas[index].id }
                axios.post(this.rutas.ocultar, data)
                    .then(response =>{ if(response.status == 200) this.derivas[index].oculto = response.data.oculto })
                    .catch(err => console.error(err))
            }
        },
    }
</script>
