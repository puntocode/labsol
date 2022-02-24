<template>
    <div class="modal fade" id="valorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Valor</h5>
                </div>

                <form class="mb-5" autocomplete="off" @submit.prevent="editar">
                    <div class="modal-body">
                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Anterior</label>
                                <input type="number" v-model="valores.anteriores" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Nuevo</label>
                                <input type="number" v-model="form.nuevos" class="form-control" step="0.01">
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">PIN</label>
                                <input type="password" v-model="form.pin" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="border-0 modal-footer justify-content-center pt-0">
                        <button id="btn-cancel" type="button" class="btn btn-light-secondatry text-secondary font-weight-bold" data-dismiss="modal" v-show="!spin">Cancelar</button>
                        <button type="submit" class="btn btn-primary" :disabled="desactivado" title="Completa todos los campos requeridos">
                            <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                            <span v-else>Editar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:[ 'valores', 'calibracion_id' ],
        data() {
            return {
                form:{
                    anteriores: '',
                    nuevos: '',
                    calibracion_id: this.calibracion_id,
                    campo: 'calibracion',
                    pin: '',
                },
                spin: false,
                rutas: window.routesEdit,
            }
        },

        methods: {


            //async -------------------------------------------------------------------------
            async editar(){
                const tipo = this.valores.tipo == 'ip_valor' ? 'IP' : 'IEC';

                this.spin = true;
                this.form.anteriores = this.valores.anteriores;
                this.form.campo = `Punto calibracion ${tipo} (${this.valores.fila + 1}, ${this.valores.columna + 1})`;

                 try{

                    if(this.valores.valor_id == 0){
                        const hist = await axios.post(this.rutas.calibracionHistorialStore, this.form);

                        if(this.valores.tipo === 'ip_valor') this.$emit('update:valorIp', hist.data.nuevos);
                        else this.$emit('update:valorIec', hist.nuevos);

                    }else{
                        this.valores.nuevos = this.form.nuevos;
                        this.valores.campo = this.form.campo;
                        this.valores.calibracion_id = this.calibracion_id;
                        this.valores.pin = this.form.pin;
                        this.$emit('editarCal', this.valores);
                    }

                    document.getElementById("btn-cancel").click();
                    this.form.nuevos = '';
                    this.spin = false;

                }catch(err){
                    this.$swal.fire('Error', 'Pin incorrecto', 'error');
                    this.spin = false;
                }

            },

        },

        computed: {
            desactivado() {
                return !this.form.nuevos || !this.form.pin  || this.spin;
            }
        },

    }
</script>

<style lang="scss" scoped>

</style>
