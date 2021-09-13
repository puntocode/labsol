<template>
     <div class="modal-content">
        <div class="modal-header bg-primary rounded-0">
            <h5 class="modal-title text-white" id="modal-label">Asignar Técnico</h5>
        </div>
        <form class="mb-5" autocomplete="off" @submit.prevent="asignar">
            <div class="modal-body">
                <div class="row mb-6">
                    <div class="col-10 mx-auto">
                        <h4>Expediente N°: <span id="nro-expediente" class="font-weight-bold"></span></h4>
                    </div>
                </div>
                <div class="row mb-6">
                    <div class="col-10 mx-auto">
                        <label for="date">Fecha</label>
                        <date-picker v-model="formData.delivery_date" :config="options"></date-picker>
                    </div>
                </div>
                <div class="row h-100">
                    <div class="col-10 mx-auto">
                        <Kanban :asignados.sync="formData.asignados" :disponibles.sync="tecnicos" />
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
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
        props: ['data'],
        components: { Kanban, datePicker },

        data() {
            return {
                formData: {
                    asignados: [],
                    number: [],
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
                this.formData.number.push($('#nro-expediente').text());

                axios.put(this.rutas.updateTecnicos, this.formData)
                    .then(response => {
                        if(response.status === 200) this.alerta();
                    })
            },
            cancelar(){
                this.formData.number = [];
                this.tecnicos = this.tecnicos.concat(this.formData.asignados);
                this.formData.asignados = [];
                this.formData.personales = [];
                this.formData.delivery_date = '';
                $('#btn-cancelar').click();
            },
            alerta(){
                this.$swal('Técnicos Asignado!', 'El expedientes se han acutalizado con éxito!','success')
                    .then( result => {
                        if (result.isConfirmed) this.cambiarNombre();
                        else this.cambiarNombre();
                    })
            },
            cambiarNombre(){
                if(this.data === null) this.vistaTabla();
                else this.vistaShow();
            },
            vistaTabla(){
                let html = '';
                this.formData.asignados.forEach(tecnico => {
                    html += `<span><i class="fas fa-user mr-2"></i>${tecnico.fullname}</span><br>`;
                });
                const exp = this.formData.number[0];
                const deliveryDate = this.convertirFecha(this.formData.delivery_date);

                $(`#text-${exp}`).html(html);
                $(`#date-${exp}`).html(deliveryDate);

                this.cancelar();
            },
            vistaShow(){
                const deliveryDate = this.convertirFecha(this.formData.delivery_date);

                //crea y cargar el array de historial
                const historial = { delivery_date: deliveryDate, tecnicos: this.formData.personales.slice()}
                this.data.historial.push(historial);

                //modifica el array expediente
                this.data.expediente.tecnicos = this.formData.personales.slice();
                this.data.expediente.delivery_date = deliveryDate;

                //cierra el modal
                this.cancelar();
            },
            convertirFecha(date){
                let fecha = moment(date, 'YYYY/MM/DD');
                return moment(fecha).format('DD/MM/YYYY');
            }
        },

        computed: {
            desactivado() {
                return this.formData.delivery_date === null || this.formData.delivery_date.trim() === '' || this.formData.asignados.length === 0;
            }
        },

    }
</script>
