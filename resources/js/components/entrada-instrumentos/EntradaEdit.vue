<template>
    <div class="card-body">
        <!-- Datos del Cliente --------------------------------------------------------------------------------->
        <div class="row">
            <div class="p-2 mx-0 mb-5 text-center col-12 bg-secondary">
                <h4 class="font-bold">INFORMACIÓN DEL CLIENTE</h4>
            </div>

            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label>Cliente</label>
                    <input type="text" class="form-control" :value="data.entrada.cliente.name" disabled>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label>RUC</label>
                    <input type="text" class="form-control" :value="data.entrada.cliente.ruc" disabled>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label>Contacto</label>
                    <input type="text" class="form-control" :value="data.entrada.contact.nombre" disabled>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label>Teléfono / Cel</label>
                    <input type="text" class="form-control" :value="data.entrada.contact.telefono" disabled>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" :value="data.entrada.contact.direccion" disabled>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" :value="data.entrada.contact.email" disabled>
                </div>
            </div>
        </div>

        <form class="mt-8" autocomplete="off" @submit.prevent="submit">
            <div class="row">
                <div class="p-2 mx-0 text-center col-12 bg-secondary">
                    <h4 class="font-bold">EDITAR INSTRUMENTOS</h4>
                </div>
            </div>

            <div class="py-10 row border-bottom border-primary" v-for="(expediente, index) in form.expedientes" :key="index">
                <div class="col-md-2">
                     <div class="form-group">
                        <label>Cantidad</label>
                        <input class="form-control" :value="data.cantidades[index].cantidad" disabled>
                    </div>
                </div>

                <div class="col-md-7">
                     <div class="form-group">
                        <label>Equipo <span class="text-danger">*</span></label>
                        <Select2 :id="`select-instrumento-${expediente.instrumento_id}`" v-model="expediente.instrumento_id" :options="selectInstumentos" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Servicio</label>
                        <input class="form-control" :value="expediente.service" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Certificado a nombre de</label>
                        <input class="form-control" v-model="expediente.certificate">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>RUC</label>
                        <input class="form-control" v-model="expediente.certificate_ruc">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Dirección</label>
                        <input class="form-control" v-model="expediente.certificate_adress">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                         <label>Observaciones</label>
                        <textarea v-model="expediente.obs" class="form-control"></textarea>
                    </div>
                </div>

            </div>

            <div class="mt-5 row">
                <div class="text-center col-12">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Select2 from 'v-select2-component';

    export default {
        components: { Select2 },
        props: ['data'],
        data() {
            return {
                form: {
                    expedientes: []
                },
                selectInstumentos: []
            }
        },
        created () {
            this.cargarSelect();
        },
        methods: {
            async cargarSelect(){
                this.data.instrumentos.forEach( instrumento => this.selectInstumentos.push({id: instrumento.id, text: instrumento.name}) );

                //funcion obtener unicos
                let expedienteUnicos = [];
                this.form.expedientes = this.data.expedientes.filter( expediente => {
                    let exists = !expedienteUnicos[expediente.instrumento_id];
                    expedienteUnicos[expediente.instrumento_id] = true;
                    return exists;
                });
            },
            submit() {
                console.log('submit')
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
