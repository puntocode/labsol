<template>
    <div>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-suspender"><i class="far fa-pause-circle"></i> Suspender</button>

        <!-------------------------------- MODAL SUSPENDER ------------------------------------------------------------------------------------------------>
        <div class="modal fade" id="modal-suspender" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning rounded-0">
                        <h5 class="text-white modal-title" id="modal-label">Suspender Expediente</h5>
                    </div>
                    <form class="mb-5" autocomplete="off" @submit.prevent="suspenderSubmit">
                        <div class="modal-body">
                            <div class="mb-6 row">
                                <div class="mx-auto col-10">
                                    <h4 class="mb-5">Por qué quieres suspender la calibración?</h4>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Instrumento cliente averiado" v-model="suspender">
                                        <label for="check"  class="form-check-label">Instrumento cliente averiado</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Patrón no disponible" v-model="suspender">
                                        <label for="check" class="form-check-label">Patrón no disponible</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Patrón averiado" v-model="suspender">
                                        <label for="check" class="form-check-label">Patrón averiado</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Decisión del cliente" v-model="suspender">
                                        <label for="check" class="form-check-label">Decisión del cliente</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Falta de herramientas" v-model="suspender">
                                        <label for="check" class="form-check-label">Falta de herramientas</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="Desconocimiento del uso del equipos" v-model="suspender">
                                        <label for="check" class="form-check-label">Desconocimiento del uso del equipos</label>
                                    </div>

                                    <div class="form-check form-check-inline w-100">
                                        <input type="radio" class="form-check-input" value="otro" v-model="suspender">
                                        <label for="check" class="form-check-label">Otro</label>
                                    </div>

                                    <input type="text" class="form-control mt-5" v-model="otro" v-if="suspender == 'otro'">
                                </div>
                            </div>
                        </div>
                        <div class="border-0 modal-footer justify-content-center">
                            <button type="button" class="btn btn-light-secondary text-secondary font-weight-bold" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-warning font-weight-bold" :disabled="suspender == ''">Suspender</button>
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
                form: {expediente_id: this.expediente_id, expediente_estado_id: 7, estado_comentario: ''},
                otro: '',
                suspender: '',
                rutas: window.routes,
            }
        },
        methods: {
            suspenderSubmit() {
                if(this.suspender === 'otro' && this.otro === ''){
                    this.$swal('Error!', 'El campo otro no puede estar vacío!','error');
                    return;
                }

                this.form.estado_comentario = this.suspender === 'otro' ? `Otro: ${this.otro}` : this.suspender;

                this.submit();
            },

            async submit(){
                try{
                    let res = await axios.put(this.rutas.estadoExpediente, this.form);
                    let data = await res.data;

                    this.$swal('Ok!', 'La calibracion ha sido Suspendida!','success')
                        .then(response => window.location.replace(`${this.rutas.indexExpediente}/${this.expediente_id}`));

                }catch(error){
                    console.error(error)
                    this.$swal('Error!', 'Error al actualizar!','error');
                }
            }
        },

    }
</script>


