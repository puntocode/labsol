<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
         <h3>HISTORIAL DE MANTENIMIENTOS</h3>
        <hr>
        <div class="row w-100 pl-4">
             <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Tipo de Mantenimiento <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model="$v.form.description.$model" :class="{'is-invalid': $v.form.description.$error}">
                    <div class="invalid-feedback"><span v-if="!$v.form.description.$model">Este campo es requerido</span></div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Realizado por<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model="$v.form.done.$model" :class="{'is-invalid': $v.form.done.$error}">
                    <div class="invalid-feedback"><span v-if="!$v.form.done.$model">Este campo es requerido</span></div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Fecha de Mantenimiento</label>
                    <div class="input-group">
                        <date-picker :config="format" v-model="$v.form.maintenance_date.$model"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Próximo Mantenimiento</label>
                    <div class="input-group">
                        <date-picker :config="format" v-model="$v.form.next_maintenance.$model"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea type="text" class="form-control" v-model="$v.form.obs.$model"></textarea>
                </div>
            </div>

            <div class="col-12 mt-5 text-center">
                <button type="submit" class="btn btn-primary" title="Completa los campos obligatorios" :disabled="$v.$invalid || spin">
                    <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                    <span v-else>Guardar Historial</span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import {required} from "vuelidate/lib/validators";

    export default {
        components: { datePicker },
        props: ['id'],
        //-------------------------------------------------------------------------------------------------------
        data() {
            return {
                rutas: window.routes,
                format: { format: 'yyyy/MM/DD' },
                form: { description: '', done: '',  maintenance_date: '', obs: '', next_maintenance: '' },
                spin: false
            }
        },
        //-------------------------------------------------------------------------------------------------------
        created () {
            if(this.id > 0) this.getHistory();
        },
        //-------------------------------------------------------------------------------------------------------
        validations:{
            form:{
                description: {required},
                done: {required},
                maintenance_date: {},
                next_maintenance: {},
                obs: {},
            }
        },
        //-------------------------------------------------------------------------------------------------------
        methods: {
            submit(){
                this.spin = true;
                if(this.id > 0) this.actualizar();
                else this.crear();
            },
            getHistory(){
                axios.get(this.rutas.getHis)
                    .then(response => this.form = response.data)
            },
            crear(){
                axios.post(this.rutas.storeHis, this.form)
                    .then(response =>{ if(response.status == 200) this.alerta(); })
                    .catch(error => console.log(error))
            },
            actualizar(){
                axios.put(this.rutas.updateHis, this.form)
                    .then(response => { if(response.status == 200) this.alerta("Historial actualizado correctamente!!", 'Actualizado'); })
                    .catch(error => console.log(error))
            },
            alerta(mensaje = 'Historial insertado correctamente!', tipo = 'Insertado'){
                this.spin = false;
                const options = {
                    confirmButtonColor: "#3699FF",
                    confirmButtonText: 'Ir a la ficha',
                    denyButtonColor: "#808080",
                    denyButtonText: 'Crear Nuevo',
                    icon: "success",
                    showDenyButton: true,
                    showCancelButton: false,
                    text: mensaje,
                    title: tipo
                }

                this.$swal(options)
                    .then( result => {
                        if (result.isConfirmed) location.href = this.rutas.ficha;
                        else location.href = this.rutas.hisNew
                    })
            }

        },

    }
</script>
