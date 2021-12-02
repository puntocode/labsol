<template>
    <fieldset>
            <div class="mb-12 form-card">
                <div class="mb-12 d-flex justify-content-between">
                    <slot></slot>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">N° de Expediente</label>
                        <input type="text" class="form-control" disabled :value="datos.number" />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">Solicitante</label>
                        <input type="text" class="form-control" :value="datos.cliente_name" disabled />
                    </div>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">Instrumento <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="datos.instrumento" disabled />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">N° de Serie</label>
                        <input type="text" class="form-control" v-model="formulario.nro_serie" />
                    </div>
                </div>

                <div class="form-group row text-left">
                    <div class="col-md-6 d-flex">
                        <label class="label-line">Identificación <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="$v.formulario.identificacion.$model"  />
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">U. de Medida <span class="text-danger">*</span></label>
                        <select class="form-control" v-model="$v.formulario.unidad_medida.$model" @change="changeUnidadMedida($event)">
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
                            <input type="number" step="0.000001" class="form-control mr-5" v-model="$v.formulario.resolucion.$model" :disabled="medidasEmpty" />
                            <select class="mx-3 form-control" v-model="$v.formulario.resolucion_medida.$model" :disabled="medidasEmpty">
                                <option v-for="(medida,ix) in selectMedidas" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row text-left">
                   <div class="col-md-6 d-flex">
                        <label class="label-line">Intervalo <span class="text-danger">*</span></label>
                        <div class="d-flex w-100">
                            <input type="number" step="0.000001" class="form-control mr-5" v-model="$v.formulario.intervalo_desde.$model" :disabled="medidasEmpty"  />
                            <input type="text" class="form-control" :value="formulario.intervalo_desde_medida" disabled  />
                        </div>
                    </div>

                   <div class="col-md-6 d-flex">
                        <label class="label-line">Hasta <span class="text-danger">*</span></label>
                        <div class="d-flex w-100">
                            <input type="number" step="0.000001" class="form-control mr-5" v-model="$v.formulario.intervalo_hasta.$model" :disabled="medidasEmpty" />
                            <select class="mx-3 form-control" v-model="$v.formulario.intervalo_medida.$model" :disabled="medidasEmpty" @change="changeIntervaloHasta($event)">
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
                            <input type="text" class="form-control" v-model="formulario.especificacion_marca" :disabled="!otraMarca"  />
                        </div>
                    </div>

                    <div class="col-md-6 d-flex">
                        <label class="label-line">Modelo</label>
                        <input type="text" class="form-control" v-model="formulario.modelo" />
                    </div>
                </div>
            </div>

            <button type="button"
                class="float-right next action-button btn btn-primary"
                title="Por favor completa todos los campos para continuar"
                :disabled="$v.$invalid"
                @click="siguiente">Siguiente
            </button>

        </fieldset>
</template>

<script>
    import {required} from "vuelidate/lib/validators";

    export default {
        props: ['form', 'datos', 'medida'],
        data() {
            return {
                formulario: { ...this.form },
                unidadMedidas: [],
                subMultiplos: [],
                selectMedidas: [],
                rutas: window.routes,
            }
        },
        //------------------------------------------------------------------------------------

        validations:{
            formulario: {
                resolucion: {required},
                unidad_medida: {required},
                identificacion: {required},
                intervalo_desde: {required},
                intervalo_hasta: {required},
                intervalo_medida: {required},
                resolucion_medida: {required},
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

            async siguiente() {
                await this.submit();
                this.$emit('update:form', this.formulario);
                this.$emit('click-next');
            },

            changeUnidadMedida(event){
                const medida = event.target.value;
                this.selectMedidas = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });

                this.formulario.intervalo_desde_medida = '';
                this.formulario.resolucion_medida = '';
                this.formulario.intervalo_medida = '';
            },
            changeIntervaloHasta(event){
                this.formulario.intervalo_desde_medida = event.target.value;
            },

            async submit(){
                try{
                    const res = await axios.put(`${this.rutas.index}/${this.formulario.id}`, this.formulario);
                    this.formulario = await res.data;
                }catch(error){
                    this.$swal.fire('Error', 'Error al actualizar', 'error');
                }
            },
        },
        //------------------------------------------------------------------------------------

        computed: {
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
