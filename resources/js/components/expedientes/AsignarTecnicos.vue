<template>
   <div class="modal-content">
        <div class="modal-header bg-primary rounded-0">
            <h5 class="modal-title text-white" id="exampleModalLabel">Asignar Técnico(s)</h5>
        </div>
        <form class="mb-5" autocomplete="off" @submit.prevent="asignar">
            <div class="modal-body">
                <div class="row">
                    <div class="col-10 mx-auto mb-6">
                        <label for="" class="h3">Expedientes Nro.</label>
                        <SelectMultiple v-model="form.number" :options="expedientes" />
                    </div>

                    <div class="col-10 mx-auto mb-6">
                        <label for="date">Fecha</label>
                        <date-picker v-model="form.delivery_date" :config="options"></date-picker>
                    </div>
                </div>

                <div class="row h-100">
                    <div class="col-10 mx-auto">
                        <Kanban :asignados.sync="form.asignados" :disponibles.sync="tecnicos" />
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center border-0">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" @click="cancelar" id="cancelar-asignados">Cancelar</button>
                <button type="button" class="btn btn-primary font-weight-bold" @click="asignar" :disabled="disable">Asignar</button>
            </div>
        </form>
    </div>
</template>

<script>
import SelectMultiple from 'v-select2-multiple-component';
import datePicker from 'vue-bootstrap-datetimepicker';
import Kanban from '../Kanban.vue';

    export default {
        props: ['data'],
        components: { SelectMultiple, Kanban, datePicker },

        data() {
            return {
                form: {
                    asignados: [],
                    delivery_date: '',
                    number: [],
                    personales: []
                },
                expedientes: [],
                options: { format: 'yyyy/MM/DD' },
                tecnicos: [],
                rutas: window.routes
            }
        },

        mounted () {
            if(this.data.length > 0)this.cargarSelect();
        },

        methods: {
            cargarSelect(){
                this.expedientes = this.data.map( expediente => expediente.number );
                axios.get(this.rutas.tecnicos)
                    .then(response => this.tecnicos = Object.values(response.data))
            },
            asignar(){
                this.form.asignados.forEach(tecnico => this.form.personales.push({id: tecnico.id, nombre: tecnico.fullname}) );

                 axios.put(this.rutas.updateTecnicos, this.form)
                    .then(response => {
                        if(response.status === 200) this.alerta();
                    })
            },
            cancelar(){
                this.form.number = [];
                this.tecnicos = this.tecnicos.concat(this.form.asignados);
                this.form.asignados = [];
                this.form.personales = [];
                $('#cancelar-asignados').click();
            },
            alerta(){
                this.$swal('Técnicos Asignados!', 'Todos los expedientes se han acutalizado con éxito!','success')
                    .then( result => {
                        if (result.isConfirmed) this.cambiarNombre();
                        else this.cambiarNombre();
                    })
            },
            cambiarNombre(){
                let html = '';
                this.form.asignados.forEach(tecnico => {
                    html += `<span><i class="fas fa-user mr-2"></i>${tecnico.fullname}</span><br>`;
                });

                let fecha = moment(this.form.delivery_date, 'YYYY/MM/DD');
                const deliveryDate = moment(fecha).format('DD/MM/YYYY');

                this.form.number.forEach( expediente => {
                    $(`#text-${expediente}`).html(html);
                    $(`#date-${expediente}`).html(deliveryDate);
                });

                this.cancelar();
            }

        },

        computed: {
            disable() {
                return this.form.delivery_date === null || this.form.delivery_date.trim() === '' || this.form.asignados.length === 0;
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
