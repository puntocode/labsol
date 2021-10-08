<template>
    <div class="card-body">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <patron-form v-else :form="form" :action="action" :rutas="rutas" :select-procedimientos="selectProcedimientos"></patron-form>
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
                    calibration_period: '',
                    last_calibration: '',
                    next_calibration: '',
                    model: '',
                    type: '',
                    serie_number: '',
                    tolerance: '',
                    uncertainty: '',
                    ubication: 'Laboratorio',
                    magnitude_id: 0,
                    condition_id: 0,
                    alert_calibration_id: 0,
                    procedimiento_id: 0,
                    rank: [''],
                    headboard: {codigo: '', revision: '', vigencia: ''},
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
                    await axios.get(this.rutas.getPatron).then(response => this.form = response.data)
                }

                const procedimientos = await axios.get(this.rutas.procedimientos).then( response => response.data );
                procedimientos.forEach( procedimiento => this.selectProcedimientos.push({id: procedimiento.id, text: `${procedimiento.code} - ${procedimiento.name}`}) );

                this.loading = false;
            }
        }
    }
</script>

