<template>
     <div class="modal-content">
        <div class="modal-header bg-primary rounded-0">
            <h5 class="text-white modal-title" id="modal-label">Asignar Técnico</h5>
        </div>
        <form class="mb-5" autocomplete="off" @submit.prevent="asignar">
            <div class="modal-body">
                <div class="mb-6 row">
                    <div class="mx-auto col-10">
                        <h4>Expediente N°:
                            <span v-for="numero in numeros" :key="numero" id="nro-expediente" class="font-weight-bold"> {{ numero }} |</span>
                        </h4>
                    </div>
                </div>
                <div class="mb-6 row">
                    <div class="mx-auto col-10">
                        <label for="date">Fecha</label>
                        <date-picker v-model="formData.delivery_date" :config="options"></date-picker>
                    </div>
                </div>
                <div class="row h-100">
                    <div class="mx-auto col-10">
                        <Kanban :asignados.sync="formData.asignados" :disponibles.sync="tecnicos" />
                    </div>
                </div>
            </div>
            <div class="border-0 modal-footer justify-content-center">
                <button type="button" class="btn btn-light-primary font-weight-bold" @click="cancelar" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                <button type="button" class="btn btn-primary font-weight-bold" @click="asignar" :disabled="desactivado">Asignar</button>
            </div>
        </form>
    </div>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';
    import Kanban from '../Kanban.vue';
    import moment from 'moment';

    export default {
        props: ['data', 'numeros', 'expedientes'],
        components: { Kanban, datePicker },

        data() {
            return {
                formData: {
                    asignados: [],
                    number: '',
                    personales: [],
                    delivery_date: ''
                },
                options: { format: 'yyyy/MM/DD' },
                tecnicos: [],
                rutas: window.routes
            }
        },

        mounted () {
            this.cargarTecnico();
        },

        methods: {
            cargarTecnico(){
                axios.get(this.rutas.tecnicos)
                    .then(response => this.tecnicos = Object.values(response.data))
            },

            asignar(){
                this.formData.asignados.forEach(tecnico => this.formData.personales.push({id: tecnico.id, nombre: tecnico.fullname}) );

                this.numeros.forEach( nroExpediente => {
                    this.formData.number = nroExpediente;
                    this.actualizar();
                })

                this.alerta();
            },

            async actualizar(){
                try{
                    const res = await axios.put(this.rutas.updateTecnicos, this.formData)
                    const datos = await res.data;
                    const index = await this.expedientes.findIndex( exp => exp.id === datos.id);
                    await this.expedientes.splice(index, 1, datos);
                }catch(error){
                    console.error(error);
                    this.$swal('Error!', 'Error al actualizar!','error')
                }
            },

            cancelar(){
                this.formData.number = [];
                this.tecnicos = this.tecnicos.concat(this.formData.asignados);
                this.formData.asignados = [];
                this.formData.personales = [];
                this.formData.delivery_date = '';
                this.$emit('update:numeros', []);
                $('#btn-cancelar').click();
            },

            alerta(){
                this.$swal('Técnicos Asignado!', 'El expedientes se han acutalizado con éxito!','success')
                    .then( result => this.cancelar());

                if(this.data !== null) location.reload();
            },
        },

        computed: {
            desactivado() {
                return this.formData.delivery_date === null || this.formData.delivery_date.trim() === '' || this.formData.asignados.length === 0;
            }
        },

    }
</script>
