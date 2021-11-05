<template>
    <div class="my-5">
        <div class="row noPrint">
            <div class="col-12">
                <section class="container my-5">
                    <div class="row">
                        <div class="col text-center">
                            <a :href="rutas.show" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                            <button type="button" class="btn btn-blue" @click="descargarPdf"><i class="fas fa-print"></i> Imprimir</button>
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
                            <span class="text-center w-100">HOJA DE VIDA DEL {{ array.data.title }}</span>
                        </div>
                        <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                            <span class="text-center py-2 bg-light w-100">Código</span>
                            <span class="text-center py-2 my-2 bg-light w-100">Revision</span>
                            <span class="text-center py-2 bg-light w-100">Vigencia</span>
                        </div>
                        <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                            <span class="py-2 pl-3 bg-light w-100">{{ array.data.formulario.codigo }}</span>
                            <span class="py-2 pl-3 my-2 bg-light w-100">{{ array.data.formulario.revision }}</span>
                            <span class="py-2 pl-3 bg-light w-100" >{{ array.data.formulario.vigencia }}</span>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Identificación</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.code }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Descripción</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.description }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Ubicación</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.ubication }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Marca</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.brand }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Modelo</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.model }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Tipo</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.type }} {{ array.data.type_description }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Nro. de Serie* </span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.serie_number }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Manual de Usuario</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-gray border-white mb-1 py-2">SI</span>
                                <span class="bg-gray border-white py-2">NO</span>
                            </div>
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-light border-white mb-1 py-2" v-text="manual ? 'X' : '-'"></span>
                                <span class="bg-light border-white py-2" v-text="manual ? '-' : 'X'"></span>
                            </div>
                            <div class="w-100 bg-gray border-white d-flex justify-content-center align-items-center">
                                <span>Idioma del Manual*</span>
                            </div>
                            <div class="w-100 bg-light border-white d-flex justify-content-center align-items-center">
                                <span>{{ array.data.idioma }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Magnitud de medición</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span class="text-uppercase">{{ array.data.magnitude.name }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Precisión</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span v-if="array.data.title === 'EQUIPO'">{{ array.data.resolution }}</span>
                            <div v-else>
                                <div v-for="(precision, ind) in array.data.precision" :key="'P'+ind">
                                    <span v-for="(valor, ix) in precision.value" :key="'val'+ix">
                                        <strong v-if="ix > 0">| </strong>
                                        {{ valor }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Tolerancia</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.tolerance }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Incertidumbre</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ array.data.uncertianty }}</span>
                        </div>
                    </div>
                </section>

                <section class="mb-5 mt-4">
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Sujeto a Calibración</span>
                        </div>
                        <div class="col-9 bg-light py-2">
                            <span>{{ sujetoCalibracion }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Calibración</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-gray border-white mb-1 py-2">INTERNA</span>
                                <span class="bg-gray border-white py-2">EXTERNA</span>
                            </div>
                            <div class="w-100 d-flex flex-column">
                                <span class="bg-light border-white mb-1 py-2" v-text="interna"></span>
                                <span class="bg-light border-white py-2" v-text="externa"></span>
                            </div>
                            <div class="w-100 bg-gray border-white d-flex justify-content-center align-items-center">
                                <span class="px-3">Procedimiento de Calibración</span>
                            </div>
                            <div class="w-100 bg-light border-white d-flex justify-content-center align-items-center">
                                <span v-text="procedimiento"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 bg-gray py-2">
                            <span>Periodo de Calibración</span>
                        </div>
                        <div class="col-9 px-0 d-flex text-center align-items-stretch">
                            <div class="w-100 bg-light d-flex align-items-center">
                                <span class="pl-3">{{ array.data.periodo }}</span>
                            </div>
                            <div class="w-100 bg-light d-flex justify-content-center align-items-center">
                            </div>
                            <div v-if="array.data.title === 'EQUIPO'" class="w-100 bg-gray d-flex justify-content-center align-items-center">
                                <span>Periodo de Mantenimiento</span>
                            </div>
                            <div v-if="array.data.title === 'EQUIPO'" class="w-100 bg-light d-flex justify-content-center align-items-center">
                                <span>-</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="my-5" v-if="array.calibracion.length > 0">
                    <div class="row">
                        <div class="col-12 text-center bg-light my-2">
                            <h4>HISTORIAL DE CALIBRACIONES O CARACTERIZACIONES</h4>
                        </div>
                        <div class="col-12 bg-light px-0">
                            <table class="table table-separate table-head-custom collapsed" id="tableFacturas" style="width:100%">
                                <thead>
                                    <tr class="table-active">
                                        <th>#</th>
                                        <th>N° de Certificado</th>
                                        <th>Elaborado Por</th>
                                        <th>F. de Calibración</th>
                                        <th>Prox. Calibración</th>
                                        <th>Observaciones*</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr v-for="(calibracion, index) in array.calibracion" :key="'C'+index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ calibracion.certificate_no }}</td>
                                            <td>{{ calibracion.done }}</td>
                                            <td>{{ calibracion.calibration }}</td>
                                            <td>{{ calibracion.next_calibration }}</td>
                                            <td>{{ calibracion.obs }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="my-5" v-if="array.mantenimiento.length > 0">
                    <div class="row">
                        <div class="col-12 text-center bg-light my-2">
                            <h4>HISTORIAL DE MANTENIMIENTO Y VERIFICACIONES INTERMEDIA</h4>
                        </div>
                        <div class="col-12 bg-light px-0">
                            <table class="table table-separate table-head-custom collapsed" id="tableFacturas" style="width:100%">
                                <thead>
                                    <tr class="table-active">
                                        <th>#</th>
                                        <th>Descripción / Verificación</th>
                                        <th>Motivo</th>
                                        <th>F. de Realización</th>
                                        <th>Realizado Por</th>
                                        <th>Observaciones*</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr v-for="(mantenimiento, index) in array.mantenimiento" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ mantenimiento.description }}</td>
                                            <td>{{ mantenimiento.reason }}</td>
                                            <td>{{ mantenimiento.maintenance_date }}</td>
                                            <td>{{ mantenimiento.done }}</td>
                                            <td>{{ mantenimiento.obs }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['array'],
        data() {
            return {
                rutas: window.routes
            }
        },
        methods:{
            descargarPdf(){
                window.print();
            },
            cabecera(string){
                return string === null || string.trim() === '' ? '-' : string;
            },
        },
        computed: {
            sujetoCalibracion() {
                return this.array.data.calibration === 'N/A' ? 'NO' : 'SI';
            },
            externa(){
                return this.array.data.calibration === 'EXTERNA' ? 'X' : '-';
            },
            interna(){
                return this.array.data.calibration === 'INTERNA' ? 'X' : '-';
            },
            procedimiento(){
                return this.array.data.procedimientos === null ? '-' : this.array.data.procedimientos.code;
            },
            manual(){
                return this.array.data.idioma === '-' ? false : true;
            }
        },
    }
</script>

<style lang="scss">
    .border-white{border-left: 4px solid #fff;}

    @media print {
        .noPrint{
            display:none;
        }
        .table{
            th{background-color: #D9D9D9 !important;}
            td{background-color: #F8F9FA !important;}
        }
    }
</style>
