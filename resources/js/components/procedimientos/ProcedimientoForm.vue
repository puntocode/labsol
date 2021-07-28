<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label>Código <span class="text-danger">*</span></label>
                    <input autofocus type="text" class="form-control" v-model.trim="$v.form.code.$model" :class="{'is-invalid': $v.form.code.$error }">
                    <div class="invalid-feedback"><span v-if="!$v.form.code.required">Este campo es requerido</span></div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label>Procedimiento <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model.trim="$v.form.name.$model" :class="{'is-invalid': $v.form.name.$error }">
                    <div class="invalid-feedback"><span v-if="!$v.form.name.required">Este campo es requerido</span></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Revisión</label>
                    <input type="number" class="form-control" v-model.trim="$v.form.revision.$model" :class="{'is-invalid': $v.form.revision.$error }">
                    <div class="invalid-feedback"><span v-if="!$v.form.revision.numeric">Este campo debe ser numerico</span></div>
                    <div class="invalid-feedback"><span v-if="!$v.form.revision.required">Este campo es requerido</span></div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Detentor</label>
                    <input type="text" class="form-control text-uppercase" v-model="form.valve">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Vigencia</label>
                    <div class="input-group">
                        <date-picker v-model="form.validity" :config="format"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Alcance Acreditado</label>
                    <label class="switchBtn">
                        <input v-model="form.accredited_scope" type="checkbox">
                        <div class="slide round">{{ scopeText }}</div>
                    </label>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="" class="h3">Patrones</label>
                    <select-multiple v-model="form.patron_id" :options="patrones" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="" class="h3">Instrumentos</label>
                    <select-multiple v-model="form.instrumento_id" :options="instrumentos" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-primary mt-10" :disabled="$v.$invalid" title="Completa los campos obligatorios">{{ textoBtn }}</button>
            </div>
        </div>

    </form>
</template>

<script>
    import {required, numeric} from "vuelidate/lib/validators";
    import datePicker from 'vue-bootstrap-datetimepicker';
    import SelectMultiple from 'v-select2-multiple-component';


    export default {
        props: ['form', 'action', 'rutas'],
        components: { datePicker, SelectMultiple },
        data() {
            return {
                format: {
                    format: 'yyyy/MM/DD',
                },
                options: {
                    icon: "success",
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonColor: "#3699FF",
                    denyButtonColor: "#808080",
                    confirmButtonText: 'Crear Nuevo',
                    denyButtonText: 'Ir a la lista',
                },
                patrones: [],
                instrumentos: []
            }
        },

        created () {
            this.patronInstrumento(this.rutas.getPatron, this.patrones);
            this.patronInstrumento(this.rutas.getInstrumentos, this.instrumentos);
        },

         validations:{
            form:{
                name: {required},
                code: {required},
                revision: {required, numeric}
            }
        },


        computed: {
            scopeText() {
                return this.form.accredited_scope ? 'SI' : 'NO'
            },
            textoBtn(){
                return this.action === 'create' ? 'Crear' : 'Actualizar';
            },
            rutaBtn(){
                return this.action === 'create' ? this.rutas.create : this.rutas.show;
            }
        },


        methods: {
            patronInstrumento(ruta, array){
                axios.get(ruta)
                .then( response => response.data)
                .then( data =>  data.forEach(datos =>  array.push({id: datos.id, text: datos.code})) );
            },
            submit() {
                if(this.action === 'create') this.crear();
                else this.actualizar();
            },
            crear(){
                axios.post(this.rutas.store, this.form)
                    .then(response => {
                        if(response.status == 200) this.alerta();
                    })
                    .catch(error => console.log(error))
            },
            actualizar(){
                axios.put(this.rutas.update, this.form)
                    .then(response => {
                        if(response.status == 200) this.alerta("Procedimiento actualizado correctamente!!", 'Actualizado');
                    })
                    .catch(error => console.log(error))
            },
            alerta(mensaje = 'Procedimiento insertado correctamente!', tipo = 'Insertado'){
                this.options.text = mensaje;
                this.options.title = tipo;
                if(this.action === 'update') this.options.confirmButtonText = 'Ver Procedimiento';
                this.$swal(this.options)
                    .then( result => {
                        if (result.isConfirmed) location.href = this.rutaBtn;
                        else location.href = this.rutas.index;
                    })
            }

        },

    }
</script>

<style>
.switchBtn {
    position: relative;
    display: inline-block;
    width: 65px;
    height: 34px;
}
.switchBtn input {display:none;}
.slide {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    padding: 8px;
    color: #fff;
}
.slide:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 34px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}
input:checked + .slide {
    background-color: #8CE196;
    padding-left: 40px;
}
input:focus + .slide {
    box-shadow: 0 0 1px #01aeed;
}
input:checked + .slide:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    left: -20px;
}
.slide.round {
    border-radius: 34px;
}
.slide.round:before {
    border-radius: 50%;
}

/* .select2-container .select2-selection--single{ height: 45px}
.select2-container--default .select2-selection--single .select2-selection__arrow{height: 45px;} */
.select2-container--default .select2-selection--multiple { padding: 10px }
</style>


