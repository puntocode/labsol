<template>
    <div class="card-body pt-3">
        <div class="d-flex justify-content-center" v-if="loading"><grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader></div>
        <cliente-form v-else :form="form" :action="action" :rutas="rutas"></cliente-form>
        <!-- <cliente-form v-else :form="form" :action="action" @accion="updateAction"></cliente-form> -->
    </div>
</template>

<script>
    import ClienteForm from './ClienteForm'
    import GridLoader from 'vue-spinner/src/GridLoader.vue'

    export default {
        props: ['id'],
        components: { ClienteForm, GridLoader },
        data() {
            return {
                form: {
                   id: 0,
                   name: '',
                   ruc: '',
                   code: '',
                   contact: [
                       {'email': '', 'nombre': '', 'telefono': '', 'direccion': '' }
                   ],
                },
                loading: true,
                action: 'create',
                color: '#009BDD',
                rutas: window.routes
            }
        },
        created () {
           this.fetch();
        },
        methods:{
            async fetch(){
                if(this.id>0){
                    this.action = 'update';
                    await axios.get(this.rutas.show)
                        .then(response => this.form = response.data)
                        .catch(error => console.log(error))
                }

                this.loading = false
            },
            updateAction(action){
                this.action = action;
            }

        }
    }
</script>


