<template>
   <button @click="eliminar" class="btn btn-outline-danger">Eliminar</button>
</template>

<script>
    export default {
        props: ['ruta', 'id'],
        methods: {
           eliminar(){
                this.$swal.fire({
                    title: 'Eliminar',
                    text: 'Desea eliminar este ensayo?',
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
                                    $(`#patron-ensayo-${this.id}`).fadeOut();
                                }
                            }).catch( error => this.$swal.fire('Error', 'Error no se pudo eliminar!', 'error'));
                    }
                });
            }
        },
    }
</script>
