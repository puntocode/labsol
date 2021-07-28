<template>
    <div class="card-body">
        <div class="d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>
        <procedimiento-form v-else :form="form" :action="action" :rutas="rutas"></procedimiento-form>
    </div>
</template>

<script>
    import ProcedimientoForm from './ProcedimientoForm'
    import GridLoader from 'vue-spinner/src/GridLoader.vue'

    export default {
        props: ['id'],
        components: { ProcedimientoForm, GridLoader },
        data() {
            return {
                loading: true,
                action: 'create',
                rutas: window.routes,
                color: '#009BDD',
                form: {
                    id: 0,
                    code: '',
                    name: '',
                    revision: 0,
                    validity: '',
                    valve: '',
                    accredited_scope: false,
                    patron_id: [],
                    instrumento_id: [],
                }
            }
        },
        created () {
            this.fetch();
        },
        methods:{
            async fetch(){
                 if(this.id > 0){
                    this.action = 'update'
                    await axios.get(this.rutas.getProcedimiento)
                        .then(response => {
                            this.form = response.data;

                        })
                        .catch(error => console.log(error))
                }

                this.loading = false;
            }
        }
    }
</script>
