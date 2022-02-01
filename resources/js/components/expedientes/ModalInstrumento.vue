<template>
    <div>
        <button class="btn btn-warning" data-toggle="modal" data-target="#instrumentoModal" :disabled="disable">Editar Instrumento</button>

        <div class="modal fade" id="instrumentoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">Editar Instrumento</h5>
                    </div>

                    <form class="mb-5" autocomplete="off" @submit.prevent="editar">
                        <div class="modal-body">
                            <div class="row">
                                <div class="mx-auto col-10">
                                    <h5>Expediente N°:
                                        <span v-for="expediente in expedientes" :key="expediente" class="badge badge-warning mr-2">{{ expediente }}</span>
                                    </h5>
                                </div>
                            </div>

                            <div class="mt-6 row">
                                <div class="mx-auto col-10">
                                    <label for="date">Instrumento</label>
                                    <select class="form-control" v-model="instrumento">
                                        <option v-for="inst in instrumentos" :key="inst.id" :value="inst.id">{{ inst.name }}</option>
                                    </select>
                                    <!-- <input v-model="instrumento" class="form-control"> -->
                                </div>
                            </div>

                        </div>
                        <div class="border-0 modal-footer justify-content-center pt-0">
                            <button id="btn-cancel" type="button" class="btn btn-light-secondatry text-secondary font-weight-bold" data-dismiss="modal" v-show="!spin">Cancelar</button>
                            <button type="submit" class="btn btn-primary" :disabled="instrumento === ''" title="Completa todos los campos requeridos">
                                <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                                <span v-else>Editar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['expedientes'],

        data() {
            return {
                spin: false,
                instrumento: '',
                instrumentos: [],
                rutas: window.routesEdit,
            }
        },

        created () {
            this.fetch();
        },

        methods: {
            async fetch(){
                let res = await axios.get(this.rutas.instrumentos);
                this.instrumentos = await res.data;
                // this.instrumentos = instrumentos.map(inst => { return {id: inst.id, text: inst.name} });
            },

            editar() {
                this.spin = true;
                let data = this.expedientes.map( exp => { return {number: exp, instrumento_id: this.instrumento} });
                axios.put(this.rutas.editar, data)
                    .then(response =>{ if(response.status == 200) this.limpiar(); })
                    .catch(err => console.error(err))
            },

            limpiar(){
                this.spin = false;
                this.instrumento = '';
                document.getElementById("btn-cancel").click();
                this.$swal('Ok', 'El instrumento se ha modificado', 'success')
                        .then( response => location.reload());
            }
        },

        computed: {
            disable() {
                return !this.expedientes.length
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
