<template>
    <form id="form-step" class="mb-5" autocomplete="off" @submit.prevent="submit">
        <!-- progressbar --------------------------------------------------------------------------------------------------------------------->
        <ul id="progressbar">
            <li class="active" id="basic"><strong>Básicos</strong></li>
            <li :class="{ active: steps >= 2 }" id="status"><strong>Estados</strong></li>
            <li :class="{ active: steps >= 3 }" id="period"><strong>Periodo</strong></li>
            <li :class="{ active: steps == 4 }" id="confirm"><strong>Finalizado</strong></li>
        </ul>

        <div class="progress mb-10">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${progress}%` }"></div>
        </div>

        <!-- Basico -------------------------------------------------------------------------------------------------------------------------->
        <fieldset v-if="this.steps == 1">
            <div class="form-card mb-12">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Datos básicos:</h4>
                    <h2 class="steps">Paso 1 - 4</h2>
                </div>

                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Código <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model.trim="$v.form.code.$model" :class="{'is-invalid': $v.form.code.$error }" />
                        <div class="invalid-feedback"><span v-if="!$v.form.code.required">Este campo es requerido</span></div>
                    </div>

                    <div class="col-md-9">
                        <label>Descripción <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model.trim="$v.form.description.$model" :class="{'is-invalid': $v.form.description.$error}" />
                        <div class="invalid-feedback"><span v-if="!$v.form.description.required">Este campo es requerido</span></div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Marca</label>
                        <input type="text" class="form-control" v-model="form.brand" />
                    </div>

                    <div class="col-md-6">
                        <label>Modelo</label>
                        <input type="text" class="form-control" v-model="form.model" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label>N° de serie</label>
                        <input type="text" class="form-control" v-model="form.serie_number" />
                    </div>

                    <div class="col-md-3">
                        <label>Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" v-model.trim="$v.form.type.$model">
                            <option value="DIGITAL">DIGITAL</option>
                            <option value="ANALOGICO">ANALOGICO</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label>Descripcion del Tipo</label>
                        <input type="text" class="form-control" v-model="form.type_description" />
                    </div>
                </div>

                <!-- <div class="form-group row">
                   <div class="col-md-6">
                        <label>Incertidumbre</label>
                        <input class="form-control" v-model="form.uncertainty" />
                    </div>

                    <div class="col-md-6">
                        <label>Tolerancia</label>
                        <input class="form-control" v-model="form.tolerance" />
                    </div>
                </div> -->
            </div>

            <button type="button" class="next action-button btn btn-primary float-right" @click="next">Siguiente</button>
        </fieldset>

        <!-- Calibracion --------------------------------------------------------------------------------------------------------------------->
        <fieldset v-if="this.steps == 2">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Estados:</h4>
                    <h2 class="steps">Paso 2 - 4</h2>
                </div>

                <div class="form-group row mb-10">
                   <div class="col-md-4">
                        <label>Ubicación</label>
                        <input class="form-control" v-model="form.ubication" />
                    </div>

                    <div class="col-md-4">
                        <label>Calibración <span class="text-danger">*</span></label>
                        <select class="form-control text-capitalize" v-model="form.calibration">
                            <option v-for="(attr,index) in selectCalibration" :key="index" :value="attr">{{ attr }}</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Procedimiento de Calibración</label>
                        <Select2 v-model="form.procedimiento_id" :options="selectProcedimientos" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 col-lg-4">
                        <select-form label="Estado" :value="form.condition_id" v-model="$v.form.condition_id.$model"
                            :url="this.rutas.condition" texto="-- Selecciona un estado --"></select-form>
                    </div>

                    <div class="col-lg-4">
                        <label>Magnitud <span class="text-danger">*</span></label>
                        <select-multiple v-model="$v.form.magnitude.$model" :options="selectMagnitudes" />
                        <!-- <select-form label="Magnitud" :value="form.magnitude_id" v-model="$v.form.magnitude_id.$model"
                            :url="this.rutas.magnitud" texto="-- Selecciona una magnitud --"></select-form> -->
                    </div>

                    <div class="col-lg-4">
                        <select-form label="Alerta de Calibración" :value="form.alert_calibration_id" v-model="form.alert_calibration_id"
                            :url="this.rutas.alertCal" texto="-- Selecciona una Alerta de Calibración --"></select-form>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Periodo de calibración (en años)</label>
                        <input type="number" class="form-control" v-model="form.calibration_period" />
                    </div>

                    <div class="col-lg-4">
                        <label>Úlitma calibración</label>
                        <div class="input-group">
                            <date-picker v-model="form.last_calibration" :config="options"></date-picker>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label>Próxima calibración</label>
                        <div class="input-group">
                            <date-picker :config="options" v-model="form.next_calibration" disabled></date-picker>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="form-rank" class="form-group mb-12">
                    <label>Rango</label>
                    <div class="d-flex mt-3" v-for="(rank, index) in form.rank" :key="index">
                        <input type="text" class="form-control" v-model="form.rank[index]" />
                        <button type="button" class="btn btn-light-primary ml-3" @click="addRank(index)" v-if="index === 0">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-light-danger ml-3" @click="delRank(index)" v-else>
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <input type="button" class="next action-button btn btn-primary float-right" @click="next" value="Siguiente" />
            <input type="button" class="previous action-button-previous float-right btn btn-secondary mr-2" @click="previous" value="Anterior" />
        </fieldset>

        <!-- Preciciosn ---------------------------------------------------------------------------------------------------------------------->
        <fieldset v-if="this.steps == 3">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Precisión/Error:</h4>
                    <h2 class="steps">Paso 3 - 4</h2>
                </div>

                <div class="form-group mt-8">
                    <div class="row">
                        <div class="col d-flex justify-content-between align-items-end">
                            <h3>Precisión</h3>
                            <div>
                                <button type="button" class="btn btn-outline-primary" @click="addPrecision"><i class="fas fa-plus"></i>Agregar</button>
                                <button type="button" @click="delPrecision()" class="btn btn-outline-danger" v-if="form.precision.length"><i class="fas fa-trash"></i> Eliminar</button>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-2" v-for="(precision, index) in form.precision" :key="index">
                        <div class="col-12">
                            <input type="text" class="form-control" v-model="form.precision[index].title" placeholder="Nombre" />
                        </div>
                        <div class="col-12 d-flex mt-2" v-for="(valor, i) in form.precision[index].value" :key="i">
                            <input type="text" class="form-control" v-model="form.precision[index].value[i]" placeholder="Valor" />
                            <button type="button" class="btn btn-light-primary ml-2" title="Agregar nuevo valor" @click="addPrecisionValue(index)" v-if="i === 0">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-light-danger ml-2" title="Elimina este valor" @click="delPrecisionValue(index)" v-else>
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-12 my-3">
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <div class="row">
                        <div class="col d-flex justify-content-between align-items-end">
                            <h3>Error Máximo</h3>
                            <div>
                                <button type="button" class="btn btn-outline-primary" @click="addError"><i class="fas fa-plus"></i>Agregar</button>
                                <button type="button" @click="delError()" class="btn btn-outline-danger" v-if="form.error_max.length"><i class="fas fa-trash"></i> Eliminar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2" v-for="(error, index) in form.error_max" :key="index">
                        <div class="col-12">
                            <input type="text" class="form-control" v-model="form.error_max[index].title" placeholder="Nombre" />
                        </div>
                        <div class="col-12 d-flex mt-2" v-for="(valor, i) in form.error_max[index].value" :key="i">
                            <input type="text" class="form-control" v-model="form.error_max[index].value[i]" placeholder="Valor" />
                            <button type="button" class="btn btn-light-primary ml-2" title="Agregar nuevo valor" @click="addErrorValue(index)" v-if="i === 0">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-light-danger ml-2" title="Elimina este valor" @click="delErrorValue(index)" v-else>
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-12 my-3">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right" :disabled="disable" :title="btnTitle">{{ textoBtn }}</button>
            <input type="button" class="previous action-button-previous float-right btn btn-secondary mr-2" value="Anterior" @click="previous" />
        </fieldset>

        <!-- Finish -------------------------------------------------------------------------------------------------------------------------->
        <fieldset v-if="this.steps == 4">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Finalizado:</h4>
                    <h2 class="steps">Paso 4 - 4</h2>
                </div>
                <success-animation></success-animation>
                <div class="col-12 text-center">
                    <p class="mb-4" style="color: #4bb71b; font-size: 35px;" v-if="this.action === 'create'">Patron creado correctante</p>
                    <p class="mb-4" style="color: #4bb71b; font-size: 35px;" v-else>Patron actualizado correctante</p>
                </div>

                <div class="col-12 mb-16 text-center">
                    <a :href="`${this.rutas.index}/${this.form.id}`" class="btn btn-primary mr-2">Ver Patrón</a>
                    <a :href="this.rutas.index" class="btn btn-secondary mr-2">Ir a la lista</a>
                    <a :href="this.rutas.create" class="btn btn-info" v-if="this.action === 'create'">Crear Nuevo Patrón</a>
                </div>
            </div>
        </fieldset>
    </form>
</template>

<script>
    import moment from 'moment';
    import SelectForm from '../SelectForm';
    import Select2 from 'v-select2-component';
    import SuccessAnimation from '../SuccessAnimation';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import {required, minValue} from "vuelidate/lib/validators";
    import SelectMultiple from 'v-select2-multiple-component';



    export default {
        components: { datePicker, SuccessAnimation, SelectForm, Select2, SelectMultiple },
        props: ['form', 'action', 'rutas', 'selectProcedimientos'],
        data() {
            return {
                steps: 1,
                progress: 25,
                rankIndex: 0,
                options: { format: 'yyyy/MM/DD'},
                selectCalibration: [ 'INTERNA', 'EXTERNA', 'INT/EXT', 'N/A'],
                selectMagnitudes: []
            }
        },

        created () {
            this.cargarSelect();
        },

        validations:{
            form:{
                code: {required},
                condition_id: {required},
                description: {required},
                magnitude: {required},
                type: {required},
            }
        },

        methods: {
            async cargarSelect(){
                let res = await axios.get(this.rutas.magnitud)
                let magnitudes = await res.data;
                this.selectMagnitudes = magnitudes.map( magnitud => { return {id: magnitud.id, text: magnitud.name} });
                if(this.form.precision == null) this.form.precision = [{title: 'precision', value: ['']}];
                if(this.form.error_max == null) this.form.error_max = [{title: 'error', value: ['']}];
            },
            next(){
                this.progress = this.progress + 25;
                this.steps++
            },
            previous(){
                this.progress = this.progress - 25;
                this.steps--
            },


            addRank() {
                this.form.rank.push('')
            },
            delRank(index){
                this.form.rank.splice(index, 1);
            },

            addPrecision() {
                this.form.precision.push({'title': '', 'value': ['']});
            },
            delPrecision(){
                this.form.precision.splice(0, 1);
            },
            addPrecisionValue(index) {
                this.form.precision[index].value.push('');
            },
            delPrecisionValue(index){
                this.form.precision[index].value.splice(0, 1);
            },


            addError() {
                this.form.error_max.push({'title': '', 'value': ['']});
            },
            delError(){
                this.form.error_max.splice(0, 1);
            },
            addErrorValue(index) {
                this.form.error_max[index].value.push('');
            },
            delErrorValue(index){
                this.form.error_max[index].value.splice(0, 1);
            },


            submit(){
                if(this.form.last_calibration == '-') this.form.last_calibration = null

                if(this.action === 'create') this.crear();
                else this.actualizar();
            },
            crear(){
                axios.post(this.rutas.store, this.form)
                    .then(response => {
                        if(response.status == 200){
                            this.form.id = response.data.id;
                            this.next();
                        };
                    })
                    .catch(error => console.log(error))
            },
            actualizar(){
                axios.put(this.rutas.update, this.form)
                    .then(response => { if(response.status == 200) this.next(); })
                    .catch(error => console.log(error))
            },
            cargaFecha(){
                if(this.form.last_calibration !== null && this.form.calibration_period.length && this.form.last_calibration.length){
                    let fecha = moment(this.form.last_calibration, 'YYYY/MM/DD');
                    fecha.add(parseInt(this.form.calibration_period), 'years');
                    this.form.next_calibration = fecha;
                }
                else this.form.next_calibration = '';
            }


        },


        computed: {
            disable() {
                return this.$v.form.$invalid
                    || this.form.precision[0].title.trim() === ''
                    || this.form.condition_id === 0
                    || this.form.magnitude.length === 0
                    || this.form.alert_calibration_id === 0  ? true : false;
            },
            btnTitle(){
                return this.disable ? 'Completa todos los campos obligatorios*' : 'Guarda los datos';
            },
            textoBtn(){
                return this.action === 'create' ? 'Crear' : 'Actualizar';
            },
        },


        watch: {
            'form.last_calibration': function(){
                this.cargaFecha();
            },

            'form.calibration_period': function(){
                this.cargaFecha();
            },
        }
    };
</script>


