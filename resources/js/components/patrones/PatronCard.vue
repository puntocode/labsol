<template>
    <div class="card-body">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <patron-form v-else :form="form" :action="action" :rutas="rutas"></patron-form>
    </div>
</template>

<script>
    import PatronForm from './PatronForm'
    import GridLoader from 'vue-spinner/src/GridLoader.vue'

    export default {
        props:['id'],
        components: { PatronForm, GridLoader },
        data() {
            return {
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
                    precision: [
                        {title: 'precision', value: ['']}
                    ],
                    error_max: [
                        {title: 'error', value: ['']}
                    ]
                },
                loading: true,
                action: 'create',
                rutas: window.routes,
                color: '#009BDD',
            }
        },
        created(){
            this.fetch();
        },
        methods:{
            async fetch(){
                if(this.id > 0){
                    this.action = 'update'
                    await axios.get(this.rutas.getPatron)
                        .then(response => this.form = response.data)
                        .catch(error => console.log(error))
                }

                this.loading = false;
            }
        }
    }
</script>

