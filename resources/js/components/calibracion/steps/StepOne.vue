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
                <!-------------------------------- Instrumento ---------------------------------------------------------------------------------------------->

                <div class="col-md-6 d-flex">
                    <label class="label-line">Instrumento <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.instrumento">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.instrumento, 'instrumento')"
                        ></i>
                        <input class="form-control" :value="form.instrumento" disabled />
                    </div>

                    <input
                        v-else
                        class="form-control"
                        v-model.lazy="formulario.instrumento"
                        @blur="guardarCambiosLS('instrumento', formulario.instrumento)" />
                </div>

                <!-------------------------------- Nro. de Serie ---------------------------------------------------------------------------------------------->

                <div class="col-md-6 d-flex">
                    <label class="label-line">N° de Serie</label>

                    <div class="input-icons" v-if="form.nro_serie">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.nro_serie, 'nro_serie')"
                        ></i>
                        <input class="form-control" :value="form.nro_serie" disabled />
                    </div>
                    <input
                        v-else
                        class="form-control"
                        v-model.lazy="formulario.nro_serie"
                        :disabled="form.nro_serie"
                        @blur="guardarCambiosLS('nro_serie', formulario.nro_serie, false)" />
                </div>
            </div>

            <div class="form-group row text-left">


                <div class="col-md-6 d-flex">
                <!-------------------------------- Identificacion ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Identificación <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.identificacion">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.identificacion, 'identificacion')"
                        ></i>
                        <input class="form-control" :value="form.identificacion" disabled />
                    </div>
                    <input
                        v-else
                        class="form-control"
                        v-model.lazy="formulario.identificacion"
                        :disabled="form.identificacion"
                        @blur="guardarCambiosLS('identificacion', formulario.identificacion)" />
                </div>

                <div class="col-md-6 d-flex">
                <!-------------------------------- U. Medida ---------------------------------------------------------------------------------------------->

                    <label class="label-line">U. de Medida <span class="text-danger">*</span></label>

                    <div class="input-icons" v-if="form.unidad_medida">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.unidad_medida, 'unidad_medida', 'text', unidadMedidas)"
                        ></i>
                        <input class="form-control" :value="form.unidad_medida" disabled />
                    </div>

                    <div class="w-100 d-flex" v-else>
                        <select class="form-control" v-model.lazy="formulario.unidad_medida">
                            <option v-for="(unidad, index) in unidadMedidas" :key="index" :id="unidad">{{ unidad }}</option>
                        </select>
                        <button
                            type="button"
                            class="btn btn-success px-0 py-2 ml-2"
                            :disabled="!formulario.unidad_medida"
                            @click="guardarCambiosLS('unidad_medida', formulario.unidad_medida)">
                            <i class="pl-3 pr-2 la la-check icon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left">

                <div class="col-md-6 d-flex">
                <!-------------------------------- Tipo ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Tipo <span class="text-danger">*</span></label>

                    <select class="form-control" v-model="formulario.tipo" @change="guardarCambiosLS('tipo', formulario.tipo)">
                        <option value="DIGITAL">Digital</option>
                        <option value="ANALOGICO">Analógico</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex">
                <!-------------------------------- Resolucion ---------------------------------------------------------------------------------------------->

                    <label class="label-line">{{resolution}} <span class="text-danger">*</span></label>
                    <div class="d-flex w-100">

                        <div class="input-icons mr-5" v-if="form.resolucion">
                            <i  class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.resolucion, 'resolucion', 'number')"
                            ></i>
                            <input class="form-control" :value="form.resolucion" disabled />
                        </div>
                        <input
                            v-else
                            type="number"
                            step="0.000001"
                            class="form-control mr-5"
                            v-model="formulario.resolucion"
                            :disabled="form.resolucion"
                            @blur="guardarCambiosLS('resolucion', formulario.resolucion)" />

                <!-------------------------------- Resolucion Medida ---------------------------------------------------------------------------------------------->

                        <div class="input-icons" v-if="form.resolucion_medida">
                            <i  class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.resolucion_medida, 'resolucion_medida', 'text', selectMedidas)"
                            ></i>
                            <input class="form-control" :value="form.resolucion_medida" disabled />
                        </div>
                        <div v-else class="d-flex w-100">
                            <select
                                class="form-control"
                                v-model="formulario.resolucion_medida"
                                :disabled="!form.unidad_medida">
                                <option v-for="(medida,ix) in selectMedidas" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                            <button
                                type="button"
                                class="btn btn-success px-0 py-2 ml-2"
                                :disabled="!formulario.resolucion_medida"
                                @click="guardarCambiosLS('resolucion_medida', formulario.resolucion_medida)">
                                <i class="pl-3 pr-2 la la-check icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left">
                <div class="col-md-6 d-flex">
                <!-------------------------------- Intervalo ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Intervalo <span class="text-danger">*</span></label>
                    <div class="d-flex w-100">

                        <div class="input-icons mr-5" v-if="form.intervalo_desde">
                            <i  class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.intervalo_desde, 'intervalo_desde', 'number')"
                            ></i>
                            <input class="form-control" :value="form.intervalo_desde" disabled />
                        </div>
                        <input v-else
                            type="number"
                            step="0.000001"
                            class="form-control mr-5"
                            v-model="formulario.intervalo_desde"
                            :disabled="medidasEmpty"
                            @blur="guardarCambiosLS('intervalo_desde', formulario.intervalo_desde)" />


                        <input class="form-control" :value="form.intervalo_medida" disabled  />
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                <!-------------------------------- Intervalo Hasta ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Hasta <span class="text-danger">*</span></label>
                    <div class="d-flex w-100">

                        <div class="input-icons mr-5" v-if="form.intervalo_hasta">
                            <i  class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.intervalo_hasta, 'intervalo_hasta', 'number')"
                            ></i>
                            <input class="form-control" :value="form.intervalo_hasta" disabled />
                        </div>
                        <input
                            v-else
                            type="number"
                            step="0.000001"
                            class="form-control mr-5"
                            v-model="formulario.intervalo_hasta"
                            :disabled="medidasEmpty"
                            @blur="guardarCambiosLS('intervalo_hasta', formulario.intervalo_hasta)" />

                <!-------------------------------- Intervalo Medida ---------------------------------------------------------------------------------------------->

                        <div class="input-icons" v-if="form.intervalo_medida">
                            <i  class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.intervalo_medida, 'intervalo_medida', 'text', selectMedidas)"
                            ></i>
                            <input class="form-control" :value="form.intervalo_medida" disabled />
                        </div>
                        <div v-else class="d-flex w-100">
                            <select
                                class="form-control"
                                v-model="formulario.intervalo_medida"
                                :disabled="!form.unidad_medida">
                                <option v-for="(medida,ix) in selectMedidas" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                            <button
                                type="button"
                                class="btn btn-success px-0 py-2 ml-2"
                                :disabled="!formulario.intervalo_medida"
                                @click="guardarCambiosLS('intervalo_medida', formulario.intervalo_medida)">
                                <i class="pl-3 pr-2 la la-check icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left">
                <div class="col-md-6 d-flex">
                <!-------------------------------- Marca ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Marca</label>
                    <div class="d-flex w-100">
                        <select class="form-control mr-5" v-model="formulario.marca" @change="guardarCambiosLS('marca', formulario.marca)">
                            <option value="GENERICO">Genérico</option>
                            <option value="OTRO">Otro*</option>
                        </select>

                        <div class="input-icons" v-if="form.especificacion_marca">
                            <i
                                class="la la-edit"
                                data-toggle="modal"
                                data-target="#modal-edit"
                                @click="modalEditar(form.especificacion_marca, 'especificacion_marca')"
                            ></i>
                            <input class="form-control" :value="form.especificacion_marca" disabled />
                        </div>
                        <input
                            v-else
                            class="form-control"
                            v-model="formulario.especificacion_marca"
                            :disabled="!otraMarca"
                            @blur="guardarCambiosLS('especificacion_marca', formulario.especificacion_marca, false)"/>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                <!-------------------------------- Modelo ---------------------------------------------------------------------------------------------->

                    <label class="label-line">Modelo</label>

                    <div class="input-icons" v-if="form.modelo">
                        <i
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                            @click="modalEditar(form.modelo, 'modelo')"
                        ></i>
                        <input class="form-control" :value="form.modelo" disabled />
                    </div>
                    <input
                        v-else
                        class="form-control"
                        v-model="formulario.modelo"
                        @blur="guardarCambiosLS('modelo', formulario.modelo, false)" />
                </div>
            </div>
        </div>

        <div class="form-group row text-left">
            <div class="col-12 d-flex">
                <label class="label-line">Observaciones Generales</label>
                <div class="card w-100">
                    <div class="card-body p-4" v-html="datos.general"></div>
                </div>
            </div>
        </div>

        <button type="button"
            class="float-right next action-button btn btn-primary"
            title="Por favor completa todos los campos para continuar"
            :disabled="!form.intervalo_medida"
            @click="siguiente">Siguiente
        </button>

        <ModalEdit :data="formEdit" @emitForm="emitForm" />
    </fieldset>
</template>

<script>
    import ModalEdit from './ModalEdit';

    export default {
        components: {ModalEdit},
        props: ['form', 'datos', 'medida'],
        data() {
            return {
                formulario: {
                    tipo: this.form.tipo,
                    marca: this.form.marca,
                },
                formEdit: { select: []},
                unidadMedidas: [],
                subMultiplos: [],
                selectMedidas: [],
                rutas: window.routes,
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

                if(!this.form.instrumento) this.formulario.instrumento = this.datos.instrumento;
                else this.formulario.instrumento = this.form.instrumento;

                if(this.form.unidad_medida) this.cambiarSubMultipos();
            },

            siguiente() {
                if( this.form.instrumento
                    && this.form.identificacion
                    && this.form.unidad_medida
                    && this.form.resolucion
                    && this.form.resolucion_medida
                    && this.form.intervalo_desde
                    && this.form.intervalo_hasta
                    && this.form.intervalo_medida
                ){
                    this.$emit('click-next');
                }else{
                    this.$swal.fire('Error', 'Completa todos los campos obligatorios para avanzar', 'error');
                }
            },

            cambiarSubMultipos(){
                const medida = this.form.unidad_medida;
                this.selectMedidas = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });
            },
            changeIntervaloHasta(event){
                this.formulario.intervalo_desde_medida = event.target.value;
            },
            modalEditar(anteriores, campo, type = 'text', select = []){
                this.formEdit = {
                    anteriores,
                    campo,
                    calibracion_id: this.form.id,
                    select,
                    type
                };
            },


            async guardarCambiosLS(campo, newValue, validate = true){
                try{
                    if(!newValue && validate) throw new Error('El campo es obligatorio');
                    if(!newValue) return;

                    let data = {campo, valor: newValue, id: this.form.id};
                    const res = await axios.put(this.rutas.updateCampo, data);
                    const value = await res.data;

                    if(value) this.emitForm(data);
                }catch(err){
                    this.$swal.fire('Error', err.message, 'error');
                }
            },

            emitForm(editado){
                this.$emit('update-form', editado);
            }


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
            },
        },

        watch: {
            'form.unidad_medida': function(){
                this.cambiarSubMultipos();
            }
        }

    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 140px;}
    .input-icons { width: 100%; position: relative;
        i { position: absolute; padding: 10px; color: #009BDD;  right: 0; cursor: pointer; }
    }
</style>
