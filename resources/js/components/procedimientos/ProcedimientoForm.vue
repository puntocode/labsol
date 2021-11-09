<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
        <!-- Codigo -------------------------------------------------------------------------------------------------------------------------->
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

        <!-- Revision ------------------------------------------------------------------------------------------------------------------------>
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
                        <date-picker v-model="form.validity" :config="formato"></date-picker>
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
            <div class="col-12">
               <div class="form-group">
                    <label>Documento</label>

                    <div class="custom-file mb-3" v-if="form.pdf === null">
                        <input type="file" class="custom-file-input" :class="{'is-invalid': error}" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .pdf" @change="cargarArchivo($event)">
                        <label class="custom-file-label" id="text-certificate">Click para subir certificado...</label>
                        <span class="text-danger" v-if="error">Por favor suba un archivo tipo documento</span>
                    </div>
                    <input class="form-control" :value="form.pdf" disabled v-else>

                    <span class="text-danger pointer mt-3" v-if="eliminarCertificado" @click="delCertificado">Eliminar certificado</span>
                </div>
            </div>
        </div>

        <!-- Instrumentos -------------------------------------------------------------------------------------------------------------------->
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="" class="h3">Instrumentos<span class="text-danger">*</span></label>
                    <select-multiple v-model="form.instrumento_id" :options="selectInstrumentos" />
                </div>
            </div>
        </div>

        <!-- Titulo Patrones ----------------------------------------------------------------------------------------------------------------->
        <div class="mt-8 row">
            <div class="p-2 mx-0 text-center col-12 bg-secondary position-relative">
                <h4 class="font-bold w-100">PATRONES</h4>
                <div class="position-absolute" style="top: 11px; right: 14px">
                    <span class="mr-3 hover-btn" @click="addPatron"><i class="fas fa-plus text-primary"></i></span>
                </div>
            </div>
        </div>

        <!-- Patrones ------------------------------------------------------------------------------------------------------------------------>
        <div class="py-8 row border-bottom border-primary" v-for="(pattern, i) in form.patrones" :key="i">
            <div class="col-12">
                 <div class="form-group">

                    <div class="d-flex justify-content-between">
                        <label>Patrones / Equipo Usados <span class="text-danger">*</span></label>
                        <span @click="delPatron(i)"><i class="fas fa-trash text-danger"></i></span>
                    </div>
                    <input v-model="pattern.patron" class="form-control">
                </div>
            </div>

            <div class="col-12">
                 <div class="form-group">
                    <label>Códigos</label>
                    <SelectMultiple v-model="pattern.code" :options="selectPatrones" />
                </div>
            </div>
        </div>

        <!-- Boton Submit -------------------------------------------------------------------------------------------------------------------->
        <div class="row">
            <div class="text-right col">
                <button type="submit" class="mt-10 btn btn-primary" :disabled="$v.$invalid || disable" title="Completa los campos obligatorios">
                    <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                    <span v-else>{{ textoBtn }}</span>
                </button>
            </div>
        </div>

    </form>
</template>

<script>
    import {required, numeric} from "vuelidate/lib/validators";
    import datePicker from 'vue-bootstrap-datetimepicker';
    import SelectMultiple from 'v-select2-multiple-component';

    export default {
        props: ['form'],
        components: { datePicker, SelectMultiple },
        data() {
            return {
                error: false,
                file: null,
                formato: { format: 'yyyy/MM/DD', },
                selectInstrumentos: [],
                selectPatrones: [],
                rutas: window.routes,
                spin: false
            }
        },

        created () {
            this.cargarSelect();
        },

         validations:{
            form:{
                name: {required},
                code: {required},
                revision: {required, numeric},
                patrones: {
                    $each: {
                        patron: {required}
                    }
                }
            }
        },


        computed: {
            scopeText() {
                return this.form.accredited_scope ? 'SI' : 'NO'
            },
            textoBtn(){
                return this.form.id === 0 ? 'Crear' : 'Actualizar';
            },
            eliminarCertificado(){
                return this.form.pdf !== null || this.file !== null;
            },
            disable(){
                return this.error;
            }
        },


        methods: {
            addPatron(){
                this.form.patrones.push({code: [], patron: '', id: 0});
            },
            delPatron(index){
                const id = this.form.patrones[index].id;
                if(id > 0) this.eliminarPatron(id, index);
                this.form.patrones.splice(index, 1);
            },
            delCertificado(){
                if(this.form.pdf !== null){
                    this.$swal.fire({
                        title: 'Eliminar',
                        text: 'Este certificado está guardado en la BD. Desea eliminar este certificado?',
                        icon: 'question',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'Cancelar',
                        showCancelButton: true,
                    })
                    .then( result => { if(result.isConfirmed) this.deleteDocument(); });
                }else{
                    this.file = null;
                    this.error = false;
                    $('#text-certificate').text('Click para subir certificado...');
                }
            },
            cargarArchivo(event){
                const name = event.target.files[0].name;
                const lastDot = name.lastIndexOf('.');
                const ext = name.substring(lastDot + 1);
                //const fileName = name.substring(0, lastDot);

                if(ext === 'pdf' || ext === 'doc' || ext === 'docx' || ext === 'xlsx' || ext === 'xls' || ext === 'pptx' || ext === 'ppt'){
                    this.file = event.target.files[0]
                    this.error = false
                    $('#text-certificate').text(name);
                }else{
                    this.error = true
                    this.file = null
                }
            },


            async cargarSelect(){
                let res = await axios.get(this.rutas.getPatron);
                const patrones = await res.data;

                res = await axios.get(this.rutas.getEquipos);
                const equipos = await res.data;

                const patronesEquipos = [...patrones, ...equipos];
                this.selectPatrones = patronesEquipos.map( patron => { return {id: patron.code, text: patron.code} });

                res = await axios.get(this.rutas.getInstrumentos)
                const instrumentos = await res.data;
                this.selectInstrumentos = instrumentos.map( instrumento => { return {id: instrumento.id, text: instrumento.name} });

               if(this.form.patrones.length === 0) this.addPatron();
               if(this.form.instrumentos.length) this.form.instrumento_id = this.form.instrumentos.map(instrumento => instrumento.id );
            },
            async submit() {
                this.spin = true;

                let id = 0;
                if(this.form.id === 0) id = await this.crear();
                else id = await this.actualizar();
                if(this.file !== null) this.guardarArchivo(id);

                this.spin = false;
                this.alerta(id);
            },
            async crear(){
                try{
                    const res = await axios.post(this.rutas.store, this.form);
                    const datos = await res.data;
                    return datos.id;
                }catch(error){
                    this.alertaError('Error al guardar');
                }
            },
            async actualizar(){
                try{
                    const res = await axios.put(this.rutas.update, this.form);
                    const datos = await res.data;
                    return datos.id;
                }catch(error){
                    this.alertaError('Error al actualizar');
                }
            },
            deleteDocument(){
                axios.post(`${this.rutas.index}/doc-delete/${this.form.id}`)
                    .then(response =>{ if(response.status == 200) this.form.pdf = null })
                    .catch(error => this.alertaError('No se pudo eliminar el documento'))
            },


            eliminarPatron(id){
                this.$swal.fire({
                    title: 'Eliminar',
                    text: 'Este registro está guardado en la BD. Desea eliminar este registro?',
                    icon: 'question',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                }).then( result => {
                        if(result.isConfirmed){
                            axios.delete(`${this.rutas.index}/patron-delete/${id}`)
                                .then( response => { if(response.status === 200) this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success'); })
                                .catch( error =>  this.alertaError() )
                        }
                    });
            },
            guardarArchivo(id){
                const formData = new FormData();
                formData.append("documento", this.file);
                axios.post(`${this.rutas.index}/doc-store/${id}`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                .then( response => response.data)
                .catch( error => this.alertaError('Error al subir el archivo'))
            },


            alerta(id, mensaje = 'Procedimiento insertado correctamente!', titulo = 'Insertado'){
                 const options = {
                    text: mensaje,
                    title: titulo,
                    icon: "success",
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonColor: "#3699FF",
                    denyButtonColor: "#808080",
                    confirmButtonText: 'Ir al Procedimiento',
                    denyButtonText: 'Ir a la lista',
                };

                this.$swal(options)
                    .then( result => {
                        if (result.isConfirmed) location.href = `${this.rutas.index}/${id}`;
                        else location.href = this.rutas.index;
                    })
            },
            alertaError(mensaje = 'Error al eliminar!'){
                this.$swal.fire('Error', mensaje, 'error');
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


.select2-container--default .select2-selection--multiple { padding: 10px }
</style>


