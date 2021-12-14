<template>
<div>
    <div class="row" v-if="noDocument">
        <div class="col-12 text-center">-- No existen documentos --</div>
    </div>

    <div class="row" v-for="(docs, index) in documents" :key="index" v-else>
        <div class="col-12" :class="index == 'documentos' ? 'mt-8' : ''">
            <h5 class="text-capitalize text-black-50">{{ index }}</h5>
            <hr>
        </div>

        <div class="col-lg-6" v-for="(doc, i) in docs" :key="i">
            <div class="card card-custom gutter-b card-stretch border shadow">
                <div class="card-body">
                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2">

                        <div class="d-flex justify-content-between mb-3">
                            <i class="fas fa-2x text-primary" :class="doc.icon"></i>
                            <button class="btn btn-danger border-rounded p-1" @click="eliminar(doc.id, doc.category, i)" title="eliminar documento">
                                <i class="las la-trash-alt"></i>
                            </button>
                        </div>

                        <a :href="doc.url" class="text-primary font-weight-bolder text-uppercase" v-text="doc.name" target="_blank"></a>
                        <span class="text-muted font-weight-bold font-size-lg">Fecha:  {{ doc.created_at }}</span>
                        <span class="text-muted font-weight-bold" v-show="index == 'manual'">Idioma:  {{ doc.idioma }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['alldocs', 'ruta'],
        data() {
            return {
                documents: this.alldocs
            }
        },

        computed: {
            noDocument() {
                return this.documents.documentos.length === 0 && this.documents.manual.length === 0  ? true : false;
            },
        },
        methods: {
            eliminar(id, tipo, index) {
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
                        axios.delete(this.ruta, {data: {id}})
                            .then(response => {
                                if(response.status === 200) {
                                    this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success');
                                    this.quitarDom(tipo, index);
                                }
                            }).catch( error => this.$swal.fire('Error', 'Error no se pudo eliminar!', 'error'));
                    }
                });
            },
            quitarDom(tipo, index){
                if(tipo == 'MANUAL') this.documents.manual.splice(index, 1);
                else this.documents.documentos.splice(index, 1);
            }
        },

    }
</script>

<style lang="scss" scoped>
    .border-rounded{border-radius: 50%;
        i{padding: 0 2px}
    }
</style>
