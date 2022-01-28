<template>
    <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        components: { vueDropzone: vue2Dropzone },
        props: ['url', 'data', 'idioma'],
        data() {
            return {
                dropzoneOptions: {
                    url: this.url,
                    thumbnailWidth: 150,
                    maxFilesize: 20,
                    dictDefaultMessage: 'Click o arrastra los documentos para subirlos',
                    paramName:'documento',
                    acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt',
                    headers: {
                        'X-CSRF-TOKEN': window._token,
                        folder: this.data.folder,
                        category: this.data.category,
                        idioma: this.data.idioma,
                    }
                }
            }
        },
        watch:{
            data(){
                this.dropzoneOptions.headers.folder = this.data.folder;
                this.dropzoneOptions.headers.category = this.data.category;
                $(".dz-preview").remove();
            },

            idioma(){
                this.dropzoneOptions.headers.idioma = this.idioma;
            }
        }
    }
</script>

<style lang="scss" scoped>
    #dropzone{border-style:dashed;border-color:#009BDD;}
</style>
