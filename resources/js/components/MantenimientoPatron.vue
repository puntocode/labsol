<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
        <div class="d-flex form-group justify-content-between align-items-end m-0 row">
            <h3>HISTORIAL DE MANTENIMIENTO</h3>
            <div>
                <button type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-primary" @click="addHistorial">
                    <i class="la la-plus"></i>Agregar
                </button>
                <button type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-danger" @click="delHistorial" v-if="form.length > 1">
                    <i class="la la-minus"></i>Eliminar
                </button>
            </div>
        </div>
        <hr>

        <div v-for="(v, index) in $v.form.$each.$iter" :key="index">
            <div class="row w-100 pl-4">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Descripción del Mantenimiento / Verificación <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="v.description.$model" :class="{'is-invalid': v.description.$error}">
                        <div class="invalid-feedback"><span v-if="!v.description.$model">Este campo es requerido</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                   <div class="form-group">
                        <label>Motivo<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="v.reason.$model" :class="{'is-invalid': v.reason.$error}">
                        <div class="invalid-feedback"><span v-if="!v.reason.$model">Este campo es requerido</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                     <div class="form-group">
                        <label>Realizado por<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="v.done.$model" :class="{'is-invalid': v.done.$error}">
                        <div class="invalid-feedback"><span v-if="!v.done.$model">Este campo es requerido</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Fecha de Realización</label>
                        <div class="input-group">
                            <date-picker :config="format" v-model="v.maintenance_date.$model"></date-picker>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea type="text" class="form-control" v-model="v.obs.$model"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <hr class="mb-10 bg-primary">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5 row">
            <button type="submit" class="btn btn-primary" title="Completa los campos obligatorios" :disabled="$v.$invalid">Guardar Historial</button>
        </div>
    </form>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import {required} from "vuelidate/lib/validators";

    export default {
        components: { datePicker },
        //props: [ 'url' ],
        data() {
            return {
                format: { format: 'yyyy/MM/DD' },
                form: [
                    { description: '', done: '',  maintenance_date: '', obs: '', reason: '' }
                ]
            }
        },
        created () {
            axios.get(this.url)
                .then( response => response.data)
                .then( data => { if(data.length > 0) this.form = data })
        },
        validations:{
            form:{
                $each:{
                    description: {required},
                    done: {required},
                    maintenance_date: {},
                    obs: {},
                    reason: {},
                }
            }
        },
        methods: {
            addHistorial() {
                this.form.push({ description: '', done: '',  maintenance_date: '', obs: '', reason: '' })
            },
            delHistorial(){
                this.form.splice((this.form.length-1), 1)
            },
            submit(){
                axios.post(this.url, this.form)
                    .then(response => console.log(response))
                    .catch(error => console.log(error))
            }
        },
    }
</script>
