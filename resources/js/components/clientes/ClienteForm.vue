<template>
    <form class="mb-5" autocomplete="off" @submit.prevent="submit">

        <div class="row align-items-end">
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label>Cliente <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" v-model.trim="$v.form.name.$model" :class="{'is-invalid': $v.form.name.$error }">
                    <div class="invalid-feedback"><span v-if="!$v.form.name.required">Este campo es requerido</span></div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label>RUC</label>
                    <input type="text" class="form-control" v-model="form.ruc">
                </div>
            </div>
        </div>

        <div class="d-flex form-group justify-content-between align-items-end m-0 row">
            <h3>Contacto</h3>
            <div>
                <button type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-primary" @click="addCliente">
                    <i class="la la-plus"></i>Agregar
                </button>
                <button type="button" title="Agregar nueva fila" class="btn btn-sm font-weight-bolder btn-light-danger" @click="delCliente" v-if="form.contact.length > 1">
                    <i class="la la-minus"></i>Eliminar
                </button>
            </div>
        </div>
        <hr>

        <div v-for="(v, index) in $v.form.contact.$each.$iter" :key="index">
            <div class="row w-100 pl-4">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" v-model="v.direccion.$model">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Nombre de Contacto<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model.trim="v.nombre.$model" :class="{'is-invalid': v.nombre.$error}">
                        <div class="invalid-feedback"><span v-if="!v.nombre.$model">Este campo es requerido</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model.lazy="v.email.$model" :class="{'is-invalid': v.email.$error}">
                        <div class="invalid-feedback"><span v-if="!v.email.$email">El campo debe ser de tipo email</span></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" class="form-control" v-model="v.telefono.$model">
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5 row">
            <a v-if="this.action == 'create'" :href="this.rutas.index" class="btn btn-secondary mr-2" title="Volver a listado">Volver</a>
            <button type="submit" class="btn btn-primary" :disabled="$v.$invalid" title="Completa los campos obligatorios">{{ textoBtn }}</button>
        </div>

    </form>
</template>

<script>
    import {required, numeric, email} from "vuelidate/lib/validators";

    export default {
        props: ['form', 'action', 'rutas'],
        data() {
            return {
                options: {
                    icon: "success",
                    showCancelButton: false,
                    showDenyButton: true,
                    confirmButtonColor: "#3699FF",
                    denyButtonColor: "#808080",
                    confirmButtonText: 'Crear Nuevo',
                    denyButtonText: 'Ir a la lista',
                }
            }
        },
        validations:{
            form:{
                name: {required},
                contact: { required,
                    $each:{
                        nombre: {required},
                        direccion: {},
                        telefono: {numeric},
                        email: {email},
                    }
                }
            }
        },
        methods: {
            addCliente() {
                this.form.contact.push( {'email': '', 'nombre': '', 'telefono': '', 'direccion': '' } )
            },
            delCliente(){
                this.form.contact.splice((this.form.contact.length-1), 1)
            },


            submit(){
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
                        if(response.status == 200) this.alerta("Cliente actualizado correctamente!!", 'Actualizado');
                    })
                    .catch(error => console.log(error))
            },

            alerta(mensaje = 'Cliente insertado correctamente!', tipo = 'Insertado'){
                this.options.text = mensaje;
                this.options.title = tipo;
                this.$swal(this.options)
                    .then( result => {
                        if (result.isConfirmed) location.href = this.rutas.ficha
                        else location.href = this.rutas.index
                    })
            }
        },
        computed: {
            disable() {
                return this.data
            },
            textoBtn(){
                return this.action === 'create' ? 'Crear' : 'Actualizar';
            }
        },
    }
</script>
