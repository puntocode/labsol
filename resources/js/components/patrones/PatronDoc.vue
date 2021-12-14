<template>
    <div class="card-body">
         <div class="card-toolbar position-relative">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_documentos">
                        <span class="nav-text" @click="docTab">Documentos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_manual">
                        <span class="nav-text" @click="manualTab">Manual</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body px-0">
            <div class="form-group" v-if="manualBan">
                <label for="idiomas">Idioma</label>
                <select class="form-control" id="idiomas" v-model="documento.idioma">
                    <option v-for="(idioma, index) in idiomas" :key="index" :id="idioma">{{idioma}}</option>
                </select>
            </div>

            <Documentos :url="rutas.storeDoc" :data="documento" />
        </div>
    </div>
</template>

<script>
    import Documentos from '../documentos/Documentos';

    export default {
        components: { Documentos },
        data() {
            return {
                rutas: window.routes,
                manualBan: false,
                documento: { folder: 'patrones/', category: 'DOCUMENTOS', idioma: 'SPANISH' },
                idiomas: ['ESPANOL', 'INGLES', 'PORTUGUES', 'CHINO', 'JAPONES', 'ALEMAN']
            }
        },
        methods: {
            docTab() {
                this.manualBan = false;
                this.documento = { folder: 'patrones/', category: 'DOCUMENTOS', idioma: 'ESPANOL' };
            },
            manualTab(){
                this.manualBan = true;
                this.documento = { folder: 'patrones/manual/', category: 'MANUAL', idioma: 'ESPANOL' };
            }
        },
    }
</script>
