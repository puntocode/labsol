<template>
    <span class="pointer" @click="eliminar">
        <i class="las la-trash-alt text-danger"></i>
    </span>
</template>

<script>
    export default {
        props: ['titulo', 'ruta'],
        methods: {
            eliminar() {
                this.$swal.fire({
                    title: 'Eliminar',
                    text: 'Desea eliminar esta magnitud?',
                    icon: 'question',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                })
                .then( result => {
                    if(result.isConfirmed){
                        axios.delete(this.ruta)
                            .then(response => {
                                if(response.status === 200) {
                                    this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success');
                                    $(`#${this.titulo}`).fadeOut();
                                }
                            }).catch( error => this.$swal.fire('Error', 'Error no se pudo eliminar!', 'error'));
                    }
                });
            }
        },
    }
</script>

