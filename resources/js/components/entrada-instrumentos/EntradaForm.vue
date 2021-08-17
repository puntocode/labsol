<template>
    <div class="card-body">
        <form class="mb-5 px-10" autocomplete="off" @submit.prevent="submit" v-if="formulario">
            <div class="row">
                <div class="col-12 border-bottom border-primary mb-5">
                    <h4 class="text-black-50 text-primary">Cliente</h4>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Cliente <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" :value="cliente.name" disabled v-if="readOnly">
                        <Select2 v-model="form.cliente_id" :options="selectClientes" @change="myChangeEvent($event)" v-else />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>RUC</label>
                        <input type="text" class="form-control" v-model="cliente.ruc" disabled>
                    </div>
                </div>
            </div>

            <div v-if="form.cliente_id > 0">
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
                            <input type="text" class="form-control" v-model="form.contact.direccion">
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" v-model="form.contact.email">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-8">
                <div class="col-12 border-bottom border-primary mb-5">
                    <h4 class="text-black-50 text-primary">Certificado</h4>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>A nombre de: <span class="text-danger">*</span></label>
                        <input class="form-control" :value="form.certificate" disabled v-if="readOnly">
                        <input :class="{'is-invalid': $v.form.certificate.$error }" class="form-control" v-model.trim="$v.form.certificate.$model" v-else>
                        <div class="invalid-feedback"><span v-if="!$v.form.certificate.required">Este campo es requerido</span></div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>RUC</label>
                        <input type="text" class="form-control" v-model="form.certificate_ruc">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" v-model="form.certificate_address">
                    </div>
                </div>
            </div>

            <div class="row mt-8">
                <div class="col-12 d-flex justify-content-between border-bottom border-primary mb-5 align-items-end pb-3" >
                    <h4 class="text-black-50 text-primary">Instrumento</h4>
                    <div class="radio-inline type" v-if="!readOnly">
                        <p class="my-auto mx-4">Ingreso</p>
                        <input type="radio" id="LS" value="LS" v-model="form.type">
                        <label for="LS">LS</label>
                        <input type="radio" id="LSI" value="LSI" v-model="form.type">
                        <label for="LSI">LSI</label>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Cantidad <span class="text-danger">*</span></label>
                        <input class="form-control" :value="form.quantity" disabled v-if="readOnly">
                        <input type="number" v-model.trim="$v.form.quantity.$model" class="form-control" :class="{'is-invalid': $v.form.quantity.$error }" v-else>
                        <div class="invalid-feedback"><span v-if="!$v.form.quantity.required">Este campo es requerido y de tipo numerico</span></div>
                    </div>
                </div>

                <div class="col-12 col-lg-9">
                    <div class="form-group">
                        <label>Equipo <span class="text-danger">*</span></label>
                        <input class="form-control" :value="form.instrument" disabled v-if="readOnly">
                        <input v-model.trim="$v.form.instrument.$model" class="form-control" :class="{'is-invalid': $v.form.instrument.$error }" v-else>
                        <div class="invalid-feedback"><span v-if="!$v.form.instrument.required">Este campo es requerido</span></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Servicio <span class="text-danger">*</span></label>
                        <input class="form-control" :value="servicio.fullname" disabled v-if="readOnly">
                        <Select2 id="select-procedimiento" v-model="form.procedimiento_id" :options="selectProcedimiento" v-else />
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea v-model="form.obs" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="row mt-8" v-if="form.type === 'LS'">
                <div class="col-12 border-bottom border-primary mb-5">
                    <h4 class="text-black-50 text-primary">Detalles</h4>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Recibido por: <span class="text-danger">*</span></label>
                        <input class="form-control" :value="user.fullname" disabled v-if="readOnly">
                        <Select2 id="select-user" v-model="form.user_id" :options="selectUsuarios" v-else />
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>Prioridad <span class="text-danger">*</span></label>
                        <div class="priority">
                            <input type="radio" id="normal" value="NORMAL" v-model="form.priority">
                            <label for="normal" class="border-primary text-primary" style="--color: #009BDD">Normal</label>
                            <input type="radio" id="urgente" value="URGENTE" v-model="form.priority">
                            <label for="urgente" class="border-danger text-danger" style="--color: #F2253E">Urgente (24hs.)</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="form-group">
                        <label>Entregado por: <span class="text-danger">*</span></label>
                        <input v-model="form.delivered" class="form-control" :disabled="readOnly">
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label>CI: <span class="text-danger">*</span></label>
                        <input type="number" v-model="form.identification" class="form-control" :disabled="readOnly">
                    </div>
                </div>
            </div>

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
                form: {
                    certificate: '',
                    certificate_ruc: '',
                    certificate_address: '',
                    cliente_id: 0,
                    contact: {},
                    delivered: '',
                    identification: '',
                    instrument: '',
                    obs: '',
                    quantity: '',
                    priority: 'NORMAL',
                    procedimiento_id: 0,
                    type: 'LS',
                    user_id: 0,
                },
                formulario: true,
                selectClientes: [],
                selectContacto: [],
                selectProcedimiento: [],
                selectUsuarios: [],
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
                certificate: {required},
                quantity: {required},
                instrument: {required},
            }
        },

        methods: {
            cargarSelect(){
                this.data.clientes.forEach( cliente => this.selectClientes.push({id: cliente.id, text: cliente.name}) );
                this.data.usuarios.forEach( usuario => this.selectUsuarios.push({id: usuario.id, text: usuario.fullname}) );
                this.data.procedimientos.forEach( procedimiento => this.selectProcedimiento.push({id: procedimiento.id, text: procedimiento.fullname}) );
            },
            submit() {
                const method = this.form.id > 0 ? 'put' : 'post';
                const url = this.form.id > 0 ? this.rutas.update : this.rutas.store;
                let data = this.form;

                axios({method, url, data})
                    .then(response =>{ if(response.status === 201) this.formulario = false })
                    .catch(error => console.log(error))
            },
            async myChangeEvent(val){
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

                this.form.certificate = this.cliente.name;
                this.form.certificate_ruc = this.cliente.ruc;
            },
            selectContacChange(event){
                this.form.contact = { nombre: event.text, email: event.email, telefono: event.telefono, direccion: event.direccion};
            },
            async datosModificar(){
                this.form = await this.data.entradaInstrumento;
                this.cliente = this.data.clientes.find( cliente => cliente.id === this.form.cliente_id );
                this.servicio = this.data.procedimientos.find( procedimiento => procedimiento.id === this.form.procedimiento_id );
                this.user = this.data.usuarios.find( user => user.id === this.form.user_id );
            }
        },

        computed: {
            disable() {
                return this.$v.form.$invalid || this.formValid
            },
            formValid(){
                return this.form.cliente_id === 0 || this.form.procedimiento_id === 0 || Object.keys(this.form.contact).length === 0 && this.form.contact.constructor === Object
                    || (this.form.type === 'LS' && this.form.user_id === 0)
                    || (this.form.type === 'LS' && this.form.delivered.trim() === '')
                    || (this.form.type === 'LS' && this.form.identification <= 0)
            },
            textoBtn(){
                return this.form.id > 0 ? 'Actualizar' : 'Crear';
            },
            readOnly(){
                return this.data.id > 0;
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
</style>
