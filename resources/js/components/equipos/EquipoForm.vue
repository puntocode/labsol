<template>
     <form id="form-step" class="mb-5" autocomplete="off" @submit.prevent="submit">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active" id="basic"><strong>Básicos</strong></li>
            <li :class="this.steps >= 2 ? 'active' : ''" id="status"><strong>Estados</strong></li>
            <li :class="this.steps >= 3 ? 'active' : ''" id="period"><strong>Periodo</strong></li>
            <li :class="this.steps == 4 ? 'active' : ''" id="confirm"><strong>Finalizado</strong></li>
        </ul>

        <div class="progress mb-10">
            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" :style="{'width': `${progress}%` }"></div>
        </div>

        <!-- fieldsets -->
        <fieldset v-if="this.steps == 1">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Datos básicos:</h4>
                    <h2 class="steps">Paso 1 - 4</h2>
                </div>

                <div class="form-group">
                    <label>Código <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model.trim="$v.form.code.$model" :class="{'is-invalid': $v.form.code.$error }" />
                    <div class="invalid-feedback"><span v-if="!$v.form.code.required">Este campo es requerido</span></div>
                </div>

                <div class="form-group">
                    <label>Descripción<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model.trim="$v.form.description.$model" :class="{'is-invalid': $v.form.description.$error}" />
                    <div class="invalid-feedback"><span v-if="!$v.form.description.required">Este campo es requerido</span></div>
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" class="form-control" v-model="form.brand" />
                </div>

                <div class="form-group">
                    <label>Nro. de Certificado</label>
                    <input type="text" class="form-control" v-model="form.certificate_no"/>
                </div>
            </div>

            <button type="button" class="next action-button btn btn-primary float-right" @click="next">Siguiente</button>
        </fieldset>

        <fieldset v-if="this.steps == 2">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Estados:</h4>
                    <h2 class="steps">Paso 2 - 4</h2>
                </div>

                <div class="form-group row">
                    <div class="col-12 col-lg-4">
                        <select-form label="Estado" :value="form.condition_id" v-model="$v.form.condition_id.$model"
                            :url="this.rutas.condition" texto="-- Selecciona un estado --"></select-form>
                    </div>

                    <div class="col-lg-4">
                        <select-form label="Magnitud" :value="form.magnitude_id" v-model="$v.form.magnitude_id.$model"
                            :url="this.rutas.magnitud" texto="-- Selecciona una magnitud --"></select-form>
                    </div>

                    <div class="col-lg-4">
                        <select-form label="Alerta de Calibración" :value="form.alert_calibration_id" v-model="form.alert_calibration_id"
                            :url="this.rutas.alertCal" texto="-- Selecciona una Alerta de Calibración --"></select-form>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Periodo de calibración</label>
                        <input type="text" class="form-control" v-model="form.calibration_period" />
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
                            <date-picker v-model="form.next_calibration" :config="options"></date-picker>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <input type="button" class="next action-button btn btn-primary float-right" @click="next" value="Siguiente" />
            <input type="button" class="previous action-button-previous float-right btn btn-secondary mr-2" @click="previous" value="Anterior" />
        </fieldset>

        <fieldset v-if="this.steps == 3">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Precisión/Error:</h4>
                    <h2 class="steps">Paso 3 - 4</h2>
                </div>

                <div class="form-group mt-4">

                    <div class="form-group">
                        <label>Resolución</label>
                        <input type="text" class="form-control" v-model="form.resolution" />
                    </div>


                    <div class="form-group">
                        <label>Error Máximo</label>
                        <input type="text" class="form-control" v-model="form.error_max" />
                    </div>

                    <div id="form-rank" class="form-group">
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
            </div>

            <button type="submit" class="btn btn-primary float-right" :disabled="disable" :title="btnTitle">{{ textoBtn }}</button>
            <input type="button" class="previous action-button-previous float-right btn btn-secondary mr-2" value="Anterior" @click="previous" />
        </fieldset>

        <fieldset v-if="this.steps == 4">
            <div class="form-card">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="font-weight-bold">Finalizado:</h4>
                    <h2 class="steps">Paso 4 - 4</h2>
                </div>
                <success-animation></success-animation>
                <div class="col-12 text-center">
                    <p class="mb-4" style="color: #4bb71b; font-size: 35px;" v-if="this.action === 'create'">Equipo creado correctante</p>
                    <p class="mb-4" style="color: #4bb71b; font-size: 35px;" v-else>Equipo actualizado correctante</p>
                </div>

                <div class="col-12 mb-16 text-center">
                    <a :href="this.rutas.index" class="btn btn-secondary mr-2">Ir a la lista</a>
                    <a :href="this.rutas.create" class="btn btn-info" v-if="this.action === 'create'">Crear Nuevo Equipo</a>
                    <a :href="this.rutas.show" class="btn btn-primary mr-2" v-else>Ver Equipo</a>
                </div>
            </div>
        </fieldset>
    </form>
</template>

<script>
    import {required, minValue} from "vuelidate/lib/validators";
    import datePicker from 'vue-bootstrap-datetimepicker';
    import SuccessAnimation from '../SuccessAnimation';
    import SelectForm from '../SelectForm';

    export default {
        components: {
          datePicker, SuccessAnimation, SelectForm
        },
        props: ['form', 'action', 'rutas'],
        data() {
            return {
                steps: 1,
                progress: 25,
                rankIndex: 0,
                options: {
                     format: 'yyyy/MM/DD',
                },
            }
        },
        validations:{
            form:{
                code: {required},
                description: {required},
                condition_id: {required, minValue: 1},
                magnitude_id: {required, minValue: 1},
            }
        },
        methods: {
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


            submit(){
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
                    .then(response => {
                        if(response.status == 200) this.next();
                    })
                    .catch(error => console.log(error))
            }


        },
        computed: {
            disable() {
                return  this.form.code.trim() === '' || this.form.description.trim() === '' || this.form.condition_id === 0 ||  this.form.magnitude_id === 0 ||  this.form.alert_calibration_id === 0  ? true : false;
            },
            btnTitle(){
                return this.disable ? 'Completa todos los campos obligatorios*' : 'Guarda los datos';
            },
            textoBtn(){
                return this.action === 'create' ? 'Crear' : 'Actualizar';
            }
        },
    }
</script>

