<template>
    <div class="card-body">
         <div class="card-toolbar position-relative">
            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_calibracion">
                        <span class="nav-text">Documentos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_mantenimiento">
                        <span class="nav-text">Manual</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_documento">
                        <span class="nav-text">Certificados</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_calibracion" role="tabpanel" aria-labelledby="tab_calibracion">
                    <Documentos :url="rutas.storeDoc" :folder="folderPatron" category="DOCUMENTOS" />
                </div>

                <div class="tab-pane fade" id="tab_mantenimiento" role="tabpanel" aria-labelledby="tab_mantenimiento">
                    <Documentos :url="rutas.storeDoc" :folder="folderManual" category="MANUAL" />
                </div>

                <div class="tab-pane fade" id="tab_documento" role="tabpanel" aria-labelledby="tab_documento">
                    <Documentos :url="rutas.storeDoc" :folder="folderCertificados" category="CERTIFICADOS" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Documentos from '../documentos/Documentos'

    export default {
        components: { Documentos },
        data() {
            return {
                rutas: window.routes,
                folderPatron: 'patrones/',
                folderManual: 'patrones/manual/',
                folderCertificados: 'patrones/certificados/'
            }
        },
    }
</script>
