<template>
    <a title="Eliminar registro" @click="eliminar" class="cursor">
        <i class="la la-trash text-danger"></i>
    </a>
</template>

<script>
export default {
    props: ["url"],
    methods: {
        eliminar() {
            const options = {
                title: "Desea eliminar este registro?",
                text: "Una vez eliminado no se puede recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3699FF",
                cancelButtonColor: "#F64E60",
                confirmButtonText: "Si"
            };


            this.$swal(options).then(result => {
                console.log(result);
                if (result.value) {
                    //enviar la peticion al servidor
                    axios
                        .delete(this.url)
                        .then(respuesta => {
                            console.log(respuesta);
                            this.$swal({
                                title: "Registro eliminado",
                                text: "El registro se ha eliminado con éxito!",
                                icon: "success"
                            });

                            //eliminar receta del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    }
};
</script>

<style scoped>
    .cursor{
        cursor: pointer;
    }
</style>
