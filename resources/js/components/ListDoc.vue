<template>
<div>
    <div class="row" v-if="noDocument">
        <div class="col-12 text-center">-- No existen documentos --</div>
    </div>

    <div class="row" v-for="(docs, index) in documents" :key="index" v-else>
        <div class="col-12" :class="index != 'documentos' ? 'mt-8' : ''">
            <h5 class="text-capitalize text-black-50">{{ index }}</h5>
            <hr>
        </div>

        <div class="col-lg-6" v-for="(doc, i) in docs" :key="i">
            <div class="card card-custom gutter-b card-stretch border shadow">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center py-1">
                        <i class="fas fa-2x text-primary mr-3" :class="doc.icon"></i>
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <a :href="doc.url" class="text-primary font-weight-bolder text-uppercase" v-text="doc.name"></a>
                            <span class="text-muted font-weight-bold font-size-lg">Fecha:  {{ doc.created_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['documents'],
        computed: {
            noDocument() {
                return this.documents.documentos.length === 0 && this.documents.manual.length === 0  ? true : false;
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>
