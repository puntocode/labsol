<template>
    <div class="card-body">
        <form autocomplete="off" @submit.prevent="submit">

            <div class="px-3 row">
                <div class="px-0 col-12 d-flex justify-content-between">
                    <h4>Patron: <span class="text-black-50">{{ data.code }}</span></h4>
                    <span>Magnitud <span class="ml-2 badge badge-info font-weight-bold">{{ data.magnitude.name }}</span></span>
                </div>
                <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                    <h4 class="font-bold w-100">Ensayos</h4>
                    <div class="position-absolute" style="top: 11px; right: 14px">
                        <span class="mr-3 hover-btn" @click="addEnsayo"><i class="fas fa-plus text-primary"></i></span>
                        <span class="hover-btn" @click="delEnsayo" v-show="form.length > 1"><i class="fas fa-minus text-danger"></i></span>
                    </div>
                </div>
            </div>

            <div class="pt-4 row" v-for="(v, index) in $v.form.$each.$iter" :key="index">
                <div class="col-8">
                    <label>Ensayo</label>
                    <input class="form-control" v-model.trim="v.ensayo.$model" :class="{'is-invalid': v.ensayo.$error}">
                    <div class="invalid-feedback"><span v-if="!v.ensayo.$model">Este campo es requerido</span></div>
                </div>

                <div class="col-4">
                    <label>Unidad de medida</label>
                    <select class="form-control text-capitalize" v-model="v.unit_measurement.$model" @change="changeUnidadMedida(index)">
                        <option v-for="(unidad, index) in unidades" :key="index" :id="unidad">{{ unidad }}</option>
                    </select>
                    <div class="invalid-feedback"><span v-if="!v.unit_measurement.$model">Este campo es requerido</span></div>
                </div>

                <div class="mt-4 col-12 d-flex justify-content-between" v-for="(rank, i) in form[index].rangos" :key="i">
                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">IP</span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.ip">
                        <select class="mx-3 form-control" v-model="rank.ip_medida">
                            <option v-for="(medida,ix) in form[index].selectUnidades" :key="ix" :id="medida">{{ medida }}</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">Valor</span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.valor">
                        <select class="mx-3 form-control" v-model="rank.valor_medida">
                            <option v-for="(medida_valor,ixr) in form[index].selectUnidades" :key="ixr" :id="medida_valor">
                                {{ medida_valor }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <button type="button" class="btn btn-outline-primary" title="Agregar nuevo rango" @click="addRank(index)" v-if="i === 0"><i class="ml-1 fas fa-plus"></i></button>
                        <button type="button" class="btn btn-outline-danger" title="Elimina este valor" @click="delRank(index)" v-else><i class="ml-1 fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="mt-10 col-12 border-bottom border-primary"></div>
            </div>

            <div class="row">
                <div class="my-10 text-center col-12">
                    <button type="submit" class="btn btn-info" :disabled="disable">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
    import SelectForm from '../../SelectForm';
    import {required} from "vuelidate/lib/validators";

    export default {
        components: { SelectForm },
        props: {
            data: {
                type: Object,
                default: {},
            },
        },
        //------------------------------------------------------------------------------------

        data() {
            return {
                form: [{
                    id: 0,
                    patron_id: this.data.id,
                    ensayo: '',
                    unit_measurement: '',
                    rangos: [{
                        ip: '',
                        ip_medida: '',
                        valor: '',
                        valor_medida: ''
                    }],
                    selectUnidades: []
                }],
                rutas: window.routes,
                unidades: [],
                unidades_ide: []
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        validations:{
            form: {
                $each:{
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
            }

        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
               return this.$v.form.$invalid;
            }
        },
        //------------------------------------------------------------------------------------

        methods: {
             async fetch(){
                const res = await axios.get(this.rutas.unidades_ide);
                this.unidades_ide = await res.data;
                this.unidades = await this.data.magnitude.unit_measurement;
            },


            addEnsayo(){
                this.form.push({
                    id: 0,
                    patron_id: this.data.id,
                    ensayo: '',
                    unit_measurement: '',
                    rangos: [{ip: '', ip_medida: '', valor: '', valor_medida: ''}]
                });
            },
            delEnsayo(){
                this.form.pop()
            },
            addRank(index){
                this.form[index].rangos.push({ip: '', ip_medida: '', valor: '', valor_medida: ''});
            },
            delRank(index){
                 this.form[index].rangos.splice((this.form[index].rangos.length-1), 1);
            },
            changeUnidadMedida(index){
                const unidades = this.unidades_ide.map( unidad => {
                    return unidad.simbolo === '-' ? this.form[index].unit_measurement : unidad.simbolo + this.form[index].unit_measurement;
                });
                this.form[index].selectUnidades = unidades;
                this.form[index].rangos.forEach( rango =>{
                    rango.ip_medida = this.form[index].unit_measurement;
                    rango.valor_medida = this.form[index].unit_measurement;
                })
            },



            submit() {
                this.form.forEach(data => { this.insertar(data); });
                this.alerta();
            },
            insertar(data){
                axios.post(this.rutas.store, data)
                    .then(response => { if(response.status == 201) console.log('insertado'); })
                    .catch(error => console.log(error))
            },
            alerta(){
                const options = {
                    title: 'Ensayos Cargadas',
                    text: 'Ensayos cargados correctamente!',
                    icon: 'success',
                    confirmButtonText: 'Ir al Patrón',
                }

                this.$swal.fire(options).
                    then(respuesta => {
                        location.replace(this.rutas.show);
                    });
            },
        },
    }

</script>
