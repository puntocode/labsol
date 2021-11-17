<template>
    <div class="card-body pt-0">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <procedimiento-form v-else :form="form"></procedimiento-form>
    </div>
</template>

<script>
    import ProcedimientoForm from './ProcedimientoForm'
    import GridLoader from 'vue-spinner/src/GridLoader.vue'

    export default {
        props: ['procedimiento'],
        components: { ProcedimientoForm, GridLoader },
        data() {
            return {
                loading: true,
                action: 'create',
                color: '#009BDD',
                form: {
                    id: 0,
                    code: '',
                    name: '',
                    revision: 0,
                    validity: '',
                    valve: '',
                    accredited_scope: false,
                    instrumento_id: [],
                    magnitud_id: 0,
                    patrones: [
                        { id: 0, patron: '', code: [] }
                    ],
                    pdf: null
                }
            }
        },
        created () {
            this.fetch();
        },
        methods:{
            fetch(){
                if(this.procedimiento != null) this.form = this.procedimiento;
                this.loading = false;
            }
        }
    }
</script>
