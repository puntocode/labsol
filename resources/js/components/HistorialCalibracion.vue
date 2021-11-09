<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
        <h3>HISTORIAL DE CALIBRACIONES O CARACTERIZACIONES</h3>
        <hr>

        <div class="row w-100 pl-4">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>N° de Certificado <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model="$v.form.certificate_no.$model" :class="{'is-invalid': $v.form.certificate_no.$error}">
                    <div class="invalid-feedback"><span v-if="!$v.form.certificate_no.$model">Este campo es requerido</span></div>
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
                    <label>Fecha de Calibración</label>
                    <div class="input-group">
                        <date-picker :config="format" v-model="$v.form.calibration.$model"></date-picker>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Próxima Calibración</label>
                    <div class="input-group">
                        <date-picker :config="format" v-model="$v.form.next_calibration.$model" :disabled="readonly"></date-picker>
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

            <div class="col-12">
                <div class="form-group">
                    <label>Certificado</label>
                    <div class="custom-file mb-3" v-if="form.certificate === null">
                        <input type="file" class="custom-file-input" :class="{'is-invalid': error}" accept=".xlsx, .xls, .doc, .docx, .ppt, .pptx, .pdf" @change="cargarArchivo($event)">
                        <label id="text-certificate" class="custom-file-label">Click para subir certificado...</label>
                        <span class="text-danger" v-if="error">Por favor suba un archivo tipo documento</span>
                    </div>

                    <input class="form-control mb-3" :value="form.certificate" disabled v-else>
                    <span class="text-danger pointer" v-if="eliminarCertificado" @click="delCertificado">Eliminar certificado</span>

                </div>
            </div>


            <div class="col-12">
                <hr class="mb-10 bg-primary">
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5 row">
            <button type="submit" class="btn btn-primary" title="Completa los campos obligatorios" :disabled="disabled">
                <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                <span v-else>Guardar Historial</span>
            </button>
        </div>
    </form>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import {required} from "vuelidate/lib/validators";
    import moment from 'moment';

    export default {
        components: { datePicker },
        props: [ 'rutas', 'id', ],
        data() {
            return {
                anho: window.anho,
                error: false,
                file: null,
                format: { format: 'yyyy/MM/DD' },
                form:{
                    certificate: null,
                    certificate_no: '',
                    done: '',
                    id: 0,
                    next_calibration: '',
                    calibration: '',
                    obs: ''
                },
                header: {},
                spin: false
            }
        },

        created () {
            if(this.id > 0) this.getHistory();
        },

        validations:{
            form: {
                certificate_no: {required},
                done: {required},
                calibration: {},
                next_calibration: {},
                obs: {}
            }

        },

        //-------------------------------------------------------------------------------------------------
        methods: {
            getHistory(){
                axios.get(this.rutas.getHis)
                    .then(response => this.form = response.data)
            },
            async submit(){
                this.spin = true;

                let datos;
                if(this.id > 0) datos = await this.actualizar();
                else datos = await this.crear();

                if(this.file !== null) this.guardarArchivo(datos.id);
                this.spin = false;
                this.alerta();
            },
            async crear(){
                try{
                    const res = await axios.post(this.rutas.storeHis, this.form);
                    const datos = await res.data;
                    return datos;
                }catch(error){
                    this.alertaError('Error al guardar');
                }
            },
            async actualizar(){
                try{
                    const res = await axios.put(this.rutas.updateHis, this.form);
                    const datos = await res.data;
                    return datos;
                }catch(error){
                    this.alertaError('Error al guardar');
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
                    return
                }

            },
            guardarArchivo(id){
                const formData = new FormData();
                formData.append("certificate", this.file);

                axios.post(`${this.rutas.index}/doc-store/${id}`,
                    formData, { headers: {'Content-Type': 'multipart/form-data'} })
                    .then( response => response.data)
                    .catch( error => this.alertaError('Error al subir el archivo'))
            },
            deleteDocument(){
                axios.post(`${this.rutas.index}/doc-delete/${this.form.id}`)
                    .then(response =>{ if(response.status == 200) this.form.certificate = null })
                    .catch(error => this.alertaError('No se pudo eliminar el documento'))
            },


            delCertificado(){
                if(this.form.certificate !== null){
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
            alerta(){
                const options = {
                    icon: "success",
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonColor: "#3699FF",
                    denyButtonColor: "#808080",
                    confirmButtonText: 'Ir a la ficha',
                    denyButtonText: 'Crear Nuevo',
                    text: this.form.id === 0 ? 'Historial insertado correctamente' : 'Historial actualizado correctamente',
                    title: this.form.id === 0 ? 'Insertado' : 'Actualizado'
                };

                this.$swal(options)
                    .then( result => {
                        if (result.isConfirmed) location.href = this.rutas.ficha;
                        else location.href = this.rutas.hisNew
                    })
            },
            alertaError(text){
                this.$swal('Error', text, 'error');
            },
        },

        computed: {
            disabled(){
                return this.$v.form.$invalid || this.spin || this.error;
            },
            readonly() {
                return parseInt(this.anho) > 0 ? true : false;
            },
            calibrationEmpty(){
                return this.form.calibration === null || !this.form.calibration.trim().length;
            },
            eliminarCertificado(){
                return this.form.certificate !== null || this.file !== null;
            },
        },

        watch: {
            'form.calibration': function(){
                if(this.readonly && !this.calibrationEmpty){
                    let fecha = moment(this.form.calibration, 'YYYY/MM/DD');
                    fecha.add(parseInt(this.anho), 'years');
                    this.form.next_calibration = fecha;
                }
            }
        }
    }
</script>
