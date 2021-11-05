<template>
    <div class="card-body">
        <form autocomplete="off" @submit.prevent="submit">
            <div class="px-3 row">
                <div class="py-2 text-center col-12 bg-secondary text-center">
                    <h4 class="font-bold w-100">Editar Ensayos</h4>
                </div>
            </div>

            <div class="pt-4 row">
                <div class="col-8">
                    <label>Ensayo</label>
                    <input class="form-control" v-model.trim="$v.form.ensayo.$model" :class="{'is-invalid': $v.form.ensayo.$error}">
                    <div class="invalid-feedback"><span v-if="!$v.form.ensayo.$model">Este campo es requerido</span></div>
                </div>

                <div class="col-4">
                    <label>Unidad de medida</label>
                    <select class="form-control text-capitalize" v-model="$v.form.unit_measurement.$model" @change="changeUnidadMedida()">
                        <option v-for="(unidad, index) in unidades" :key="index" :id="unidad">{{ unidad }}</option>
                    </select>
                </div>

                <div class="mt-4 col-12 d-flex justify-content-between" v-for="(rank, i) in form.rangos" :key="i">
                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">IP</span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.ip">
                        <select class="mx-3 form-control" v-model="rank.ip_medida">
                            <option v-for="(medida,ix) in selectUnidades" :key="ix" :id="medida">{{ medida }}</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">Valor</span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.valor">
                        <select class="mx-3 form-control" v-model="rank.valor_medida">
                            <option v-for="(medida_valor,ixr) in selectUnidades" :key="ixr" :id="medida_valor">
                                {{ medida_valor }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <button type="button" class="btn btn-outline-primary" title="Agregar nuevo rango" @click="addRank" v-if="i === 0"><i class="ml-1 fas fa-plus"></i></button>
                        <button type="button" class="btn btn-outline-danger" title="Elimina este valor" @click="delRank" v-else><i class="ml-1 fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="mt-10 col-12 border-bottom border-primary"></div>
            </div>

            <div class="row">
                <div class="my-10 text-center col-12">
                    <button type="submit" class="btn btn-info" :disabled="disable">
                         <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                        <span v-else>Actualizar Ensayo</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {required} from "vuelidate/lib/validators";

    export default {
        props: ['data'],
        data() {
            return {
                form: this.data,
                rutas: window.routes,
                unidades: [],
                unidades_ide: [],
                selectUnidades: [],
                spin: false
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        validations:{
            form: {
                patron_id: {required},
                ensayo: {required},
                unit_measurement: {required},
                rangos: {
                    $each:{
                        ip: {required},
                        ip_medida: {required},
                        valor: {required},
                        valor_medida: {required},
                    }
                }
            }

        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
               return this.$v.form.$invalid || this.spin;
            }
        },
        //------------------------------------------------------------------------------------

        methods: {
             async fetch(){
                const res = await axios.get(this.rutas.unidades_ide);
                this.unidades_ide = await res.data;
                this.unidades = await this.data.patron.magnitude.unit_measurement;
                this.cargarSelectUnidades();
            },


            addRank(){
                this.form.rangos.push({ip: '', ip_medida: '', valor: '', valor_medida: ''});
            },
            delRank(){
                 this.form.rangos.pop();
            },
            changeUnidadMedida(){
                this.cargarSelectUnidades();

                this.form.rangos.forEach( rango =>{
                    rango.ip_medida = this.form.unit_measurement;
                    rango.valor_medida = this.form.unit_measurement;
                })
            },
            cargarSelectUnidades(){
                this.selectUnidades = this.unidades_ide.map( unidad => {
                    return unidad.simbolo === '-' ? this.form.unit_measurement : unidad.simbolo + this.form.unit_measurement;
                });
            },


            submit(){
                this.spin = true;
                axios.put(this.rutas.update, this.form)
                    .then(response => { if(response.status == 200) this.alerta()  })
                    .catch(error => console.log(error))
            },
            alerta(){
                 const options = {
                    title: 'Ensayo Actulalizado',
                    text: 'Ensayo actualizado correctamente!',
                    icon: 'success',
                    confirmButtonText: 'Ir al Patrón',
                }

                this.$swal.fire(options).
                    then(respuesta => {
                        location.replace(this.rutas.show);
                    });
            }


        }

    }
</script>
