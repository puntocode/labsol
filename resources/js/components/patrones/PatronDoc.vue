<template>
    <div class="card-body">
         <div class="card-toolbar position-relative">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_documentos">
                        <span class="nav-text">Documentos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_manual">
                        <span class="nav-text">Manual</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_documentos" role="tabpanel" aria-labelledby="tab_documentos">
                    <Documentos :url="rutas.storeDoc" :data="documento" />
                </div>

                <div class="tab-pane fade" id="tab_manual" role="tabpanel" aria-labelledby="tab_manual">
                    <div class="form-group">
                        <label for="idiomas">Idioma</label>
                        <select class="form-control" id="idiomas" v-model="manual.idioma">
                            <option v-for="(idioma, index) in idiomas" :key="index" :id="idioma">{{idioma}}</option>
                        </select>
                    </div>
                    <Documentos :url="rutas.storeDoc" :data="manual" />
                </div>
            </div>
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
                manual: { folder: 'patrones/manual/', category: 'MANUAL', idioma: 'ESPAÑOL' },
                documento: { folder: 'patrones/', category: 'DOCUMENTOS', idioma: 'ESPAÑOL' },
                idiomas: ['ESPAÑOL', 'INGLES', 'PORTUGUES', 'CHINO', 'JAPONES', 'ALEMAN']
            }
        },
    }
</script>
