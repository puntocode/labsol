<template>
   <div class="card-body">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <equipo-form v-else :form="form" :action="action" :rutas="rutas" :select-procedimientos="selectProcedimientos"></equipo-form>
    </div>
</template>

<script>
    import EquipoForm from './EquipoForm'
    import GridLoader from 'vue-spinner/src/GridLoader.vue'
    export default {
        props:['id'],
        components: { EquipoForm, GridLoader },
        data() {
            return {
                loading: true,
                action: 'create',
                rutas: window.routes,
                color: '#009BDD',
                form: {
                    id: 0,
                    code: '',
                    description: '',
                    certificate_no: '',
                    brand: '',
                    condition_id: 0,
                    magnitude_id: 0,
                    alert_calibration_id: 0,
                    rank: [''],
                    calibration_period: '',
                    last_calibration: '',
                    next_calibration: '',
                    resolution: '',
                    error_max: '',
                    model: '',
                    type: '',
                    serie_number: '',
                    tolerance: '',
                    uncertainty: '',
                    ubication: 'Laboratorio',
                    procedimiento_id: 0,
                },
                selectProcedimientos: [{id: 0, text: 'SIN PROCEDIMIENTO'}]
            }
        },
        created(){
            this.fetch();
        },
        methods:{
            async fetch(){
                if(this.id > 0){
                    this.action = 'update'
                    await axios.get(this.rutas.getEquipo).then(response => this.form = response.data)
                }

                const procedimientos = await axios.get(this.rutas.procedimientos).then( response => response.data );
                procedimientos.forEach( procedimiento => this.selectProcedimientos.push({id: procedimiento.id, text: `${procedimiento.code} - ${procedimiento.name}`}) );
                this.loading = false;
            }
        }
    }
</script>
