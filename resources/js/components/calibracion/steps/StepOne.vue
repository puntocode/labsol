<template>
    <fieldset>
            <div class="mb-12 form-card">
                <div class="mb-12 d-flex justify-content-between">
                    <slot></slot>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">N° de Expediente</label>
                        <input type="text" class="form-control" disabled :value="form.number" />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">Solicitante</label>
                        <input type="text" class="form-control" :value="form.cliente_name" disabled />
                    </div>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">Instrumento <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="formulario.instrumento" disabled />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">N° de Serie</label>
                        <input type="text" class="form-control" v-model="formulario.serie" />
                    </div>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">Identificación <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="formulario.identificacion"  />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">U. de Medida <span class="text-danger">*</span></label>
                        <select class="form-control" v-model="formulario.unidad_medida" @change="changeUnidadMedida($event)">
                            <option v-for="(unidad, index) in unidadMedidas" :key="index" :id="unidad">{{ unidad }}</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row text-left">
                     <div class="col-md-6 d-flex">
                        <label class="label-line">Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" v-model="formulario.tipo">
                            <option value="DIGITAL">Digital</option>
                            <option value="ANALOGICO">Analógico</option>
                        </select>
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">{{resolution}} <span class="text-danger">*</span></label>
                        <div class="d-flex w-100">
                            <input type="number" step="0.01" class="form-control mr-5" v-model="formulario.resolucion" :disabled="medidasEmpty" />
                            <select class="mx-3 form-control" v-model="formulario.resolucion_medida" :disabled="medidasEmpty">
                                <option v-for="(medida,ix) in selectMedidas" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row text-left">
                   <div class="col-md-6 d-flex">
                        <label class="label-line">Intervalo <span class="text-danger">*</span></label>
                        <div class="d-flex w-100">
                            <input type="number" step="0.01" class="form-control mr-5" v-model="formulario.intervalo_desde" :disabled="medidasEmpty"  />
                            <input type="text" class="form-control" v-model="formulario.intervalo_desde_medida" disabled  />
                        </div>
                    </div>

                   <div class="col-md-6 d-flex">
                        <label class="label-line">Hasta <span class="text-danger">*</span></label>
                        <div class="d-flex w-100">
                            <input type="number" step="0.01" class="form-control mr-5" v-model="formulario.intervalo_hasta" :disabled="medidasEmpty" />
                            <select class="mx-3 form-control" v-model="formulario.intervalo_hasta_medida" :disabled="medidasEmpty" @change="changeIntervaloHasta($event)">
                                <option v-for="(medida,ix) in selectMedidas" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">Marca</label>
                        <div class="d-flex w-100">
                            <select class="form-control mr-5" v-model="formulario.marca">
                                <option value="GENERICO">Genérico</option>
                                <option value="OTRO">Otro</option>
                            </select>
                            <input type="text" class="form-control" v-model="formulario.especificacion" :disabled="!otraMarca"  />
                        </div>
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">Modelo</label>
                        <input type="text" class="form-control" :v-model="formulario.modelo" />
                    </div>
                </div>
            </div>

            <button type="button"
                class="float-right next action-button btn btn-primary"
                :disabled="disable"
                title="Por favor completa todos los campos para continuar"
                @click="siguiente">Siguiente
            </button>

        </fieldset>
</template>

<script>
    export default {
        props: ['form', 'medida'],
        data() {
            return {
                formulario: {
                    ...this.form,
                    serie: '',
                    identificacion: '',
                    unidad_medida: '',
                    tipo: 'DIGITAL',
                    resolucion: '',
                    resolucion_medida: '',
                    intervalo_desde: '',
                    intervalo_desde_medida: '',
                    intervalo_hasta: '',
                    intervalo_hasta_medida: '',
                    marca: 'GENERICO',
                    especificacion: '',
                    modelo: ''
                },
                unidadMedidas: [],
                subMultiplos: [],
                selectMedidas: [],
                rutas: window.routes
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch(){
                const res = await axios.get(this.rutas.submultiplos);
                this.subMultiplos = await res.data;
                this.unidadMedidas = this.medida != null ? this.medida.unit_measurement : [];
            },

            siguiente() {
                this.$emit('click-next')
                this.updateForm()
            },
            updateForm() {
                this.$emit('update:form', this.formulario);
            },
            changeUnidadMedida(event){
                const medida = event.target.value;
                this.selectMedidas = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });
                this.formulario.intervalo_desde_medida = '';
            },
            changeIntervaloHasta(event){
                this.formulario.intervalo_desde_medida = event.target.value;
            },
        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
                return this.formulario.identificacion.trim() === ''
                    || this.formulario.unidad_medida.trim() === ''
                    || this.formulario.resolucion.trim() === ''
                    || this.formulario.resolucion_medida.trim() === ''
                    || this.formulario.intervalo_desde.trim() === ''
                    || this.formulario.intervalo_desde_medida.trim() === ''
                    || this.formulario.intervalo_hasta.trim() === ''
                    || this.formulario.intervalo_hasta_medida.trim() === ''
            },
            resolution(){
                return this.formulario.tipo === 'DIGITAL' ? 'Resolución' : 'División';
            },
            otraMarca(){
                return this.formulario.marca === 'OTRO';
            },
            medidasEmpty(){
                return this.selectMedidas.length === 0;
            }
        },
    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 140px;}
</style>
