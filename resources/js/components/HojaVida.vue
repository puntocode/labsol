<template>
    <div class="my-5">
        <div class="row">
            <div class="col-12">
                <section class="container my-5">
                    <div class="row">
                        <div class="col text-center">
                            <a :href="rutas.show" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                            <button type="button" class="btn btn-blue" @click="descargarPdf"><i class="fas fa-print"></i> Descargar PDF</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="container">
            <div class="" id="html">

                <section class="d-flex my-5">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-3 py-4 mx-0">
                        <img :src="rutas.logo" alt="logo-labsol" class="img-fluid">
                        </div>
                        <div class="col-md-3 mx-1 px-0 d-flex justify-content-center align-items-center bg-light">
                            <span class="text-center w-100">HOJA DE VIDA DEL {{ array.title }}</span>
                        </div>
                        <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                            <span class="text-center py-2 bg-light w-100">Código</span>
                            <span class="text-center py-2 my-2 bg-light w-100">Revision</span>
                            <span class="text-center py-2 bg-light w-100">Vigencia</span>
                        </div>
                        <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                            <span class="text-center py-2 bg-light w-100">-</span>
                            <span class="text-center py-2 my-2 bg-light w-100">-</span>
                            <span class="text-center py-2 bg-light w-100">-</span>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Identificación</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.code }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Descripción</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.description }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Ubicación</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>-</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Marca</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.brand }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Modelo</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Tipo</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Nro. de Serie* </span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Manual de Usuario</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-gray mb-1 py-2">SI</span>
                                <span class="bg-gray py-2">NO</span>
                            </div>
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-light mb-1 py-2">-</span>
                                <span class="bg-light py-2">-</span>
                            </div>
                            <div class="w-100 bg-gray d-flex justify-content-center align-items-center">
                                <span>Idioma del Manual*</span>
                            </div>
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                                <span>-</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Magnitud de medición</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span class="text-uppercase">{{ array.magnitude.name }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Precisión</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span v-if="array.title === 'EQUIPO'">{{ array.resolution }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Tolerancia</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span v-if="array.title === 'EQUIPO'">{{ array.error_max }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Incertidumbre</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>-</span>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Sujeto a Calibración</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>SI</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Calibración</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-gray mb-1 py-2">INTERNA</span>
                                <span class="bg-gray py-2">EXTERNA</span>
                            </div>
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-light mb-1 py-2">-</span>
                                <span class="bg-light py-2">-</span>
                            </div>
                            <div class="w-100 bg-gray d-flex justify-content-center align-items-center">
                                <span class="px-3">Procedimiento de Calibración</span>
                            </div>
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                                <span>-</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Periodo de Calibración</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                                <span>{{ array.calibration_period }}</span>
                            </div>
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                            </div>
                            <div class="w-100 bg-gray d-flex justify-content-center align-items-center">
                                <span>Periodo de Mantenimiento</span>
                            </div>
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                                <span>-</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>

<script src="https://cdnjs.cloudflare.com/ajax/libs/rasterizehtml/1.3.0/rasterizeHTML.allinone.js"></script>

<script>
import jsPDF from 'jspdf'
import html2canvas from 'html2canvas'

    export default {
        props: ['array'],
        data() {
            return {
                rutas: window.routes
            }
        },
        methods:{
            descargarPdf(){

                html2canvas(document.querySelector('#html'))
                    .then(canvas => {
                        const imgData = canvas.toDataURL('image/jpeg');
                        const img = new Image();
                        img.src = imgData;

                        // Establezca la especificación pdf de acuerdo con el tamaño de la imagen y ejecútela cuando la imagen se cargue correctamente. El motivo de * 0.5 se debe al problema de la relación
                        img.onload =  () => {
                            // Cabe señalar aquí que los dos atributos de pdf horizontal y vertical, deben ajustarse de acuerdo con la relación de ancho a alto, de lo contrario habrá un problema de visualización incompleto
                            const doc = new jsPDF('p','mm', 'a4') //orientacion, unidad de medida, tamaño

                            // if (img.width > img.height) doc = new jsPDF('l', 'mm', [img.width * 0.5, img.height * 0.5])
                            // else doc = new jsPDF('p', 'mm', [img.width * 0.5, img.height * 0.5])
                            console.log(img.width + ' - ' + img.height)

                            // La relación se puede ajustar según sea necesario
                            doc.addImage (imgData, 'jpeg', 10, 15, img.width * 0.175, img.height * 0.175)
                            //doc.addImage (imgData, 'jpeg', 0, 15, 210, 163)
                            doc.save(`${this.array.code}.pdf`)
                        }
                    })

            }
        }
    }

</script>
