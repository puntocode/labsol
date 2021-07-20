<template>
    <div class="card-body">
        <form-pattern v-if="loading" :form="form" :action="action" ></form-pattern>
    </div>
</template>

<script>
import FormPattern from './FormPattern'
    export default {
        props:['id'],
        components: {
            FormPattern,
        },
        data() {
            return {
                form: {
                    id: 0,
                    code: '',
                    description: '',
                    certificate_no: '',
                    brand: '',
                    status_pattern_id: 0,
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
                loading: false,
                action: 'create'
            }
        },
        created(){
            this.fetch();
        },
        methods:{
            fetch(){
                if(this.id > 0){
                    this.action = 'update'
                    axios.get(`/panel/patron/${this.id}`)
                        .then(response => {
                            this.form.alert_calibration_id = response.data.alert_calibration_id;
                            this.form.brand = response.data.brand;
                            this.form.calibration_period = response.data.calibration_period;
                            this.form.certificate_no = response.data.certificate_no;
                            this.form.code = response.data.code;
                            this.form.description = response.data.description;
                            this.form.id = response.data.id;
                            this.form.last_calibration = response.data.last_calibration;
                            this.form.magnitude_id = response.data.magnitude_id;
                            this.form.next_calibration = response.data.next_calibration;
                            this.form.rank = response.data.rank;
                            this.form.status_pattern_id = response.data.status_pattern_id;
                            this.form.error_max = response.data.error_max;
                            this.form.precision = response.data.precision;
                            // console.log(this.form)
                        })
                        .catch(error => console.log(error))
                }
                this.loading = true;
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
