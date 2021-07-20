<template>
    <div class="card-body pt-3">
        <cliente-form v-if="loading" :form="form" :action="action" @accion="updateAction"></cliente-form>
    </div>
</template>

<script>
    import ClienteForm from './ClienteForm'
    export default {
        props: ['id'],
        components: { ClienteForm },
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
                   loading: false,
               },
                action: 'create'
            }
        },
        created () {
            this.fetch();
        },
        methods:{
            fetch(){
                if(this.id>0){
                    this.action = 'update';
                    axios.get(`/panel/clientes/${this.id}`)
                        .then(response => {
                            this.form = response.data
                            console.log(this.form)
                        })
                        .catch(error => console.log(error))
                }
                this.loading = true
            },
            updateAction(action){
                this.action = action;
            }

        }
    }
</script>


