<template>
    <div class="col-2">
        <i
            class="las la-edit text-primary pointer"
            data-toggle="modal"
            data-target="#modal-acreditado"
            title="Actualizar Doc Alcance Acreditado"
            style="font-size: 20px">
        </i>

        <div class="modal fade" id="modal-acreditado" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary rounded-0">
                        <h5 class="text-white modal-title" id="modal-label">Actualizar Documento Alcance Acreditado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="mb-5" >
                        <div class="modal-body">
                            <div class="mb-6 row">
                                <div class="mx-auto col-10">
                                   <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" lang="es"  accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .pdf" @change="cargarArchivo($event)">
                                        <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                        <small class="text-danger">Obs: al actualizar ya se modifica en todos los procedimientos!</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-0 pt-0 modal-footer justify-content-center">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                            <button type="button" class="btn btn-primary font-weight-bold" @click="submit" :disabled="error">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                error: true,
                file: null,
                rutas: window.routes,
            }
        },
        methods: {
            cargarArchivo(event)
            {
                const name = event.target.files[0].name;
                const lastDot = name.lastIndexOf('.');
                const ext = name.substring(lastDot + 1);

                if(ext === 'pdf' || ext === 'doc' || ext === 'docx' || ext === 'xlsx' || ext === 'xls' || ext === 'pptx' || ext === 'ppt'){
                    this.file = event.target.files[0]
                    this.error = false
                }else{
                    this.error = true
                    this.file = null
                    this.$swal('Error', 'Este tipo de archivo es inválido!!', 'error');
                    return;
                }
            },

            submit()
            {
                const formData = new FormData();
                formData.append("documento", this.file);

                axios.post(this.rutas.acreditado,
                    formData, { headers: {'Content-Type': 'multipart/form-data'} })
                    .then( response => { if(response.status === 200) location.reload(); })
                    .catch( error => this.$swal('Error', 'Este tipo de archivo es inválido!!', 'error'));
            }
        },
    }
</script>

