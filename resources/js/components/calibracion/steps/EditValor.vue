<template>
    <div class="modal fade" id="modalUnidades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Campo</h5>
                </div>

                <form class="mb-5" autocomplete="off" @submit.prevent="submit">
                    <div class="modal-body">
                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Anterior</label>
                                <input :value="data.anteriores" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Nuevo</label>

                                <input v-if="data.type === 'number'" v-model="form.nuevos" type="number" class="form-control" step="0.01">

                                <select v-else class="form-control" v-model="form.nuevos">
                                    <option v-for="(unidad, i) in data.select" :key="i" :id="`${i}-sl-medida`">{{ unidad }}</option>
                                </select>
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
                        <button id="btn-cancel-um" type="button" class="btn btn-light-secondatry text-secondary font-weight-bold" data-dismiss="modal" v-show="!spin">Cancelar</button>
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
        props:[ 'data', 'valores' ],
        data() {
            return {
                form:{
                    anteriores: '',
                    nuevos: '',
                    pin: ''
                },
                spin: false,
                rutas: window.routesEdit,
            }
        },
        methods: {
            async submit(){
                try{
                    this.spin = true;

                    this.form.anteriores = this.data.anteriores;
                    this.form.campo = this.data.campo;
                    this.form.calibracion_id = this.data.calibracion_id;

                    const his = await this.comprobarPin();
                    console.log(his);

                    if(this.data.tabla){
                        this.limpiarTabla();
                        this.$emit('limpiarResults');
                        this.$emit('update:valores', this.valores);
                    }

                    await this.updateCalibracion();
                    this.$emit('updateForm', {campo: this.form.campo, valor: this.form.nuevos});

                    document.getElementById("btn-cancel-um").click();

                }catch(err){
                    console.error('EditValor', err);
                    this.$swal.fire('Error', err, 'error');
                }

                this.spin = false;
            },

            comprobarPin(){
                return new Promise ((resolve, reject) => {
                    axios.post(this.rutas.calibracionHistorialStore, this.form)
                        .then(resp => resolve(resp.data))
                        .catch(err => reject('Pin Incorrecto'));
                })
            },

            eliminarValores(id){
                console.log('eliminar resultados', id);
            },

            limpiarTabla(){
                if(this.data.campo === 'ip_medida'){
                    this.valores.forEach(valor => valor.ip_medida  = '');
                    return
                }

                this.valores.forEach(valor => valor.iec_medida = '');
            },

            updateCalibracion(){
                return new Promise ((resolve, reject) => {
                    let data  = {campo:this.form.campo, valor: this.form.nuevos, id: this.form.calibracion_id, pin: this.form.pin};

                    axios.put(this.rutas.updateCampo, data)
                        .then(resp => resolve(resp.data))
                        .catch(err => reject('No se puede actualizar el campo'));
                })
            }


        },

         computed: {
            desactivado() {
                return !this.form.nuevos || !this.form.pin  || this.spin;
            }
        },
    }
</script>



