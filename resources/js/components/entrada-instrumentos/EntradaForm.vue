<template>
    <div class="card-body">
        <form class="mb-5 px-10" autocomplete="off" @submit.prevent="submit" v-if="formulario">
            <!-- Información del Cliente -->
            <div class="row">
                <div class="col-12 mb-5 text-center mx-0 p-2 bg-secondary">
                    <h4 class="font-bold">INFORMACIÓN DEL CLIENTE</h4>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Cliente <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="cliente.name" disabled v-if="readOnly">
                        <Select2 v-model="form.cliente_id" :options="selectClientes" @change="selectClienteChange($event)" v-else />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>RUC</label>
                        <input type="text" class="form-control" v-model="cliente.ruc" disabled>
                    </div>
                </div>
            </div>

            <!-- Elegir el contacto del Cliente -->
            <div class="row mt-8">
                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Contacto <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="form.contact.nombre" disabled v-if="readOnly">
                        <Select2 id="select-contact" v-model="form.contact.nombre" :options="selectContacto" @select="selectContacChange($event)" v-else />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Teléfono / Cel</label>
                        <input type="text" class="form-control" :value="form.contact.telefono" disabled>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" v-model="form.contact.direccion" disabled>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="form.contact.email" disabled>
                    </div>
                </div>
            </div>

            <!-- Control de ingreso de instrumentos -->
            <div class="row mt-8">
                <div class="col-12 text-center mx-0 p-2 bg-secondary position-relative">
                    <h4 class="font-bold w-100">CONTROL DE INGRESO DE INSTRUMENTOS</h4>
                    <div class="position-absolute" style="top: 11px; right: 14px">
                        <span class="hover-btn mr-3" @click="addService"><i class="fas fa-plus text-primary"></i></span>
                        <span class="hover-btn" @click="delService" v-show="cantidadServicio > 1"><i class="fas fa-minus text-danger"></i></span>
                    </div>
                </div>
            </div>

            <!-- Agregar mas Instrumentos -->
            <div class="row mt-2 border-bottom border-primary py-5" v-for="(v, index) in $v.form.servicio.$each.$iter" :key="index">
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Cantidad <span class="text-danger">*</span></label>
                        <!-- <input class="form-control" :value="form.servicio.quantity" disabled v-if="readOnly"> -->
                        <input type="number" v-model.trim="v.quantity.$model" class="form-control" :class="{'is-invalid': v.quantity.$error}">
                        <div class="invalid-feedback"><span v-if="!v.quantity.$model">Este campo es requerido y de tipo numerico</span></div>
                    </div>
                </div>

                 <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Equipo <span class="text-danger">*</span></label>
                        <!-- <input class="form-control" :value="instrumento.name" disabled v-if="readOnly"> -->
                        <Select2 :id="`select-instrumento-${cantidadServicio}`" v-model="v.instrumento_id.$model" :options="selectInstumentos" />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Prioridad <span class="text-danger">*</span></label>
                        <div class="priority">
                            <input type="radio" :id="`normal-${index}`" value="NORMAL" v-model="v.priority.$model">
                            <label :for="`normal-${index}`" class="border-primary text-primary" style="--color: #009BDD">Normal</label>
                            <input type="radio" :id="`urgente-${index}`" value="URGENTE" v-model="v.priority.$model">
                            <label :for="`urgente-${index}`" class="border-danger text-danger" style="--color: #F2253E">Urgente (24hs.)</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Servicio <span class="text-danger">*</span></label>
                        <!-- <input class="form-control" :value="servicio.service" disabled v-if="readOnly"> -->
                        <input type="text" v-model.trim="v.service.$model" class="form-control" :class="{'is-invalid': v.service.$error}" />
                        <div class="invalid-feedback"><span v-if="!v.service.$model">Este campo es requerido</span></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea v-model="v.obs.$model" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Certificado a nombre de:</label>
                        <input type="text" v-model="v.certificate.$model" class="form-control" />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>RUC</label>
                        <input class="form-control" v-model="v.certificate_ruc.$model">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input class="form-control" v-model="v.certificate_adress.$model">
                    </div>
                </div>
            </div>

            <!-- Obs general & Elegir LS o LSI -->
            <div class="row mt-14">
                <div class="col-12 mb-5 text-center mx-0 p-2 bg-secondary">
                    <h4 class="font-bold">OBSERVACIONES GENERALES</h4>
                </div>
                <div class="col-12">
                    <VueEditor v-model="form.obs_general" />
                </div>
                <!-- <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones Generales </label>
                        <textarea v-model="form.obs_general" class="form-control"></textarea>
                    </div>
                </div> -->

                <div class="col-12">
                    <div class="radio-inline type mt-6" v-if="!readOnly">
                        <p class="my-auto mx-4">Ingreso</p>
                        <input type="radio" id="LS" value="LS" v-model="form.type">
                        <label for="LS">LS</label>
                        <input type="radio" id="LSI" value="LSI" v-model="form.type">
                        <label for="LSI">LSI</label>
                    </div>
                </div>
            </div>

            <!-- Control de Recepción de istrumentos -->
            <div class="row mt-8" v-if="form.type === 'LS'">
                <div class="col-12 mb-5 text-center mx-0 p-2 bg-secondary">
                    <h4 class="font-bold">CONTROL DE RECEPCIÓN DE INSTRUMENTOS</h4>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="form-group">
                        <label>Recibido por: <span class="text-danger">*</span></label>
                        <input class="form-control" :value="user.fullname" disabled v-if="readOnly">
                        <Select2 id="select-user" v-model="form.user_id" :options="selectUsuarios" v-else />
                    </div>
                </div>


                <div class="col-12 col-lg-5">
                    <div class="form-group">
                        <label>Entregado por: <span class="text-danger">*</span></label>
                        <input v-model="form.delivered" class="form-control" :disabled="readOnly">
                    </div>
                </div>

                <div class="col-12 col-lg-2">
                    <div class="form-group">
                        <label>CI: <span class="text-danger">*</span></label>
                        <input type="number" v-model="form.identification" class="form-control" :disabled="readOnly">
                    </div>
                </div>
            </div>

            <!-- Boton de Insertar -->
            <div class="row mt-8">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary" :disabled="disable" title="Completa todos los campos requeridos"> {{ textoBtn }}</button>
                </div>
            </div>
        </form>

        <div class="row" v-else>
            <div class="col-12 mb-8 text-center">
                <success-animation></success-animation>
                <div class="d-flex justify-content-center">
                    <a :href="this.rutas.show" class="btn btn-info" v-if="this.form.id > 0">Ver Entrada</a>
                    <a :href="this.rutas.index" class="btn btn-secondary mx-3">Ir a la lista</a>
                    <a :href="this.rutas.create" class="btn btn-primary">Crear Nueva Entrada</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {required} from "vuelidate/lib/validators";
    import Select2 from 'v-select2-component';
    import SuccessAnimation from '../SuccessAnimation';
    import { VueEditor } from "vue2-editor";


    export default {
        components: { Select2, SuccessAnimation },

        props: {
            data: {
                type: Object,
                default: [],
            },
        },

        data() {
            return {
                cliente: {},
                instrumento: {},
                form: {
                    cliente_id: 0,
                    contact: {},
                    delivered: '',
                    identification: '',
                    obs_general: '',
                    servicio: [{
                        certificate: '',
                        certificate_adress: '',
                        certificate_ruc: '',
                        instrumento_id: 1,
                        obs: '',
                        priority: 'NORMAL',
                        quantity: '',
                        service: 'calibración',
                    }],
                    type: 'LS',
                    user_id: 0,
                },
                formulario: true,
                selectClientes: [],
                selectContacto: [],
                selectUsuarios: [],
                selectInstumentos: [],
                servicio: {},
                rutas: window.routes,
                user: {},
            }
        },

        created () {
            this.cargarSelect();
            if(this.data.id > 0) this.datosModificar();
        },

        validations:{
            form:{
                cliente_id: {required},
                servicio: {
                    $each:{
                        certificate: {},
                        certificate_adress: {},
                        certificate_ruc: {},
                        instrumento_id: {},
                        obs: {},
                        priority: {},
                        quantity: {required},
                        service: {required},
                    }
                }
            }
        },

        methods: {
            addService() {
                const servicio = {
                    certificate: '',
                    certificate_adress: '',
                    certificate_ruc: '',
                    instrumento_id: 1,
                    obs: '',
                    priority: 'NORMAL',
                    quantity: '',
                    service: 'calibración',
                }
                this.form.servicio.push(servicio);
            },
            delService(){
                this.form.servicio.splice((this.form.servicio.length-1), 1)
            },

            cargarSelect(){
                this.data.clientes.forEach( cliente => this.selectClientes.push({id: cliente.id, text: cliente.name}) );
                this.data.usuarios.forEach( usuario => this.selectUsuarios.push({id: usuario.id, text: usuario.fullname}) );
                this.data.instrumentos.forEach( instrumento => this.selectInstumentos.push({id: instrumento.id, text: instrumento.name}) );
            },

            submit() {
                const method = this.form.id > 0 ? 'put' : 'post';
                const url = this.form.id > 0 ? this.rutas.update : this.rutas.store;
                let data = this.form;

                axios({method, url, data})
                    .then(response =>{ if(response.status === 201) this.formulario = false })
                    .catch(error => console.log(error))
            },

            async selectClienteChange(val){
                this.cliente = await this.data.clientes.find( cliente => cliente.id == val );

                this.selectContacto = [];
                this.form.contact = {};
                this.cliente.contact.forEach(contacto =>
                    this.selectContacto.push({
                        direccion: contacto.direccion,
                        email: contacto.email,
                        id: contacto.nombre,
                        telefono: contacto.telefono,
                        text: contacto.nombre,
                    })
                );

                this.form.servicio[0].certificate = this.cliente.name;
                this.form.servicio[0].certificate_ruc = this.cliente.ruc;
                this.form.servicio[0].certificate_adress = '';
            },

            async datosModificar(){
                this.form = await this.data.entradaInstrumento;
                this.user = this.data.usuarios.find( user => user.id === this.form.user_id );
                this.cliente = this.data.clientes.find( cliente => cliente.id === this.form.cliente_id );
                this.instrumento = this.data.instrumentos.find( instrumento => instrumento.id === this.form.instrumento_id );
            },

            selectContacChange(event){
                this.form.contact = { nombre: event.text, email: event.email, telefono: event.telefono, direccion: event.direccion};
                this.form.servicio[0].certificate_adress = event.direccion;
            },
        },

        computed: {
            disable() {
                return this.$v.form.$invalid || this.formValid
            },
            formValid(){
                return this.form.cliente_id === 0
                    || Object.keys(this.form.contact).length === 0 && this.form.contact.constructor === Object
                    || (this.form.type === 'LS' && this.form.user_id === 0)
                    || (this.form.type === 'LS' && this.form.delivered.trim() === '')
                    || (this.form.type === 'LS' && this.form.identification <= 0)
            },
            textoBtn(){
                return this.form.id > 0 ? 'Actualizar' : 'Crear';
            },
            readOnly(){
                return this.data.id > 0;
            },
            cantidadServicio(){
                return this.form.servicio.length;
            }
        },
    }
</script>

<style lang="scss">
    h4{font-weight: 300;}
    .form-control{height: 37px;}
    .select2-container .select2-selection--single{ height: 37px}
    .select2-container--default .select2-selection--single .select2-selection__arrow{height: 37px;}

    .type{
        display: flex;
        input[type="radio"]{display: none;
            &:checked + label{ background-color: #009BDD; color: #fff;
                &:before{height: 12px; width: 12px; border: 2px solid white; background-color: #009BDD;}
            }
        }
        label{position: relative; font-size: 12px; border:1px solid #E4E6EF; padding: 8px 15px; border-radius: 5px; display: flex; margin-right: 15px; align-items: center; cursor: pointer;margin-bottom: auto;}
    }

    .hover-btn{cursor: pointer;}
</style>
