<template>
    <div>
        <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#modal-anular"><i class="far fa-times-circle"></i> Anular</button>

        <!-------------------------------- MODAL ANULAR ------------------------------------------------------------------------------------------------>
        <div class="modal fade" id="modal-anular" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger rounded-0">
                        <h5 class="text-white modal-title" id="modal-label">Anular Expediente</h5>
                    </div>
                    <form class="mb-5" autocomplete="off" @submit.prevent="anularSubmit">
                        <div class="modal-body">
                            <div class="mb-6 row">
                                <div class="mx-auto col-10">
                                    <h4>Por qué quieres anular la calibración?</h4>
                                    <input type="text" class="form-control" v-model="form.estado_comentario">
                                </div>
                            </div>
                        </div>
                        <div class="border-0 modal-footer justify-content-center">
                            <button type="button" class="btn btn-light-secondary text-secondary font-weight-bold" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-danger font-weight-bold" :disabled="form.estado_comentario == ''">Anular</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['expediente_id'],
        data() {
            return {
                form: {expediente_id: this.expediente_id, expediente_estado_id: 6, estado_comentario: ''},
                rutas: window.routes
            }
        },

        methods: {
            async anularSubmit() {
                try{
                    let res = await axios.put(this.rutas.estadoExpediente, this.form);
                    let data = await res.data;

                    this.$swal('Ok!', 'La calibracion ha sido Anulada!','success')
                        .then(response => location.reload());

                }catch(error){
                    console.error(error)
                    this.$swal('Error!', 'Error al actualizar!','error');
                }
            },
        },
    }
</script>

