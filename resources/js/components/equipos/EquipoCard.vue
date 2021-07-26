<template>
   <div class="card-body">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <equipo-form v-else :form="form" :action="action" :rutas="rutas"></equipo-form>
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
                    error_max: ''
                }
            }
        },
        created(){
            this.fetch();
        },
        methods:{
            async fetch(){
                if(this.id > 0){
                    this.action = 'update'
                    await axios.get(this.rutas.getEquipo)
                        .then(response => this.form = response.data)
                        .catch(error => console.log(error))
                }

                this.loading = false;
            }
        }
    }
</script>
