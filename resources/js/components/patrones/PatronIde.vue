<template>
    <div class="card-body">
        <form autocomplete="off" @submit.prevent="submit">

            <div class="px-3 row">
                <div class="px-0 col-12 d-flex justify-content-between">
                    <h4>Patron: <span class="text-black-50">{{ data.code }}</span></h4>
                    <span>Magnitud
                        <span v-for="magnitud in data.magnitude" :key="magnitud.id" class="ml-2 badge badge-info font-weight-bold">{{ magnitud.name }}</span>
                    </span>
                </div>
                <div class="py-2 mt-8 text-center col-12 bg-secondary position-relative">
                    <h4 class="font-bold w-100">Magnitudes</h4>
                    <div class="position-absolute" style="top: 11px; right: 14px">
                        <span class="mr-3 hover-btn" @click="addIde"><i class="fas fa-plus text-primary"></i></span>
                        <span class="hover-btn" @click="delIde" v-show="form.length > 1"><i class="fas fa-minus text-danger"></i></span>
                    </div>
                </div>
            </div>

            <div class="pt-4 row" v-for="(v, index) in $v.form.$each.$iter" :key="index">
                <div class="col-8">
                    <label>Magnitud</label>
                    <input class="form-control" v-model.trim="v.magnitude.$model" :class="{'is-invalid': v.magnitude.$error}">
                    <div class="invalid-feedback"><span v-if="!v.magnitude.$model">Este campo es requerido</span></div>
                </div>

                <div class="col-4">
                    <label>Unidad de medida</label>
                    <select class="form-control" v-model="v.unit_measurement.$model" @change="changeUnidadMedida($event, index)">
                        <option v-for="(unidad, index) in unidades" :key="index" :id="unidad">{{ unidad }}</option>
                    </select>
                    <div class="invalid-feedback"><span v-if="!v.unit_measurement.$model">Este campo es requerido</span></div>
                </div>

                <div class="mt-4 col-12 d-flex justify-content-between" v-for="(rank, i) in form[index].rangos" :key="i">
                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">Rango</span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.rango">
                        <select class="mx-3 form-control" v-model="rank.rango_medida">
                            <option v-for="(medida,ix) in form[index].selectUnidades" :key="ix" :id="medida">{{ medida }}</option>
                        </select>
                    </div>

                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center" v-text="resolution"></span>
                        <input class="mx-3 align-self-center form-control" v-model="rank.resolucion">
                        <select class="mx-3 form-control" v-model="rank.resolucion_medida">
                            <option v-for="(medida_resolucion,ixr) in form[index].selectUnidades" :key="ixr" :id="medida_resolucion">
                                {{ medida_resolucion }}
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
    import SelectForm from '../SelectForm';
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
                    magnitude: '',
                    unit_measurement: '',
                    rangos: [ {rango: '', rango_medida: '', resolucion: '', resolucion_medida: ''} ],
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
                    magnitude: {required},
                    unit_measurement: {required},
                    rangos: {
                        $each:{
                            rango: {required},
                            rango_medida: {required},
                            resolucion: {required},
                            resolucion_medida: {required},
                        }
                    }
                }
            }

        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch(){
                this.data.magnitude.forEach(magnitud => {
                    for(let i = 0; i < magnitud.unit_measurement.length; i++){
                        this.unidades.push(magnitud.unit_measurement[i]);
                    }
                })

                //this.unidades = await this.data.magnitude.unit_measurement;
                let datos = await axios.get(this.rutas.unidades_ide);
                this.unidades_ide = await datos.data;
            },

            submit() {
                this.form.forEach(data => {
                    if(data.id === 0) this.insertar(data);
                    else this.actualizar(data);
                });
                this.alerta();
            },

            insertar(data){
                axios.post(this.rutas.store, data)
                    .then(response => { if(response.status == 201) console.log('insertado'); })
                    .catch(error => console.log(error))
            },
            actualizar(data){
                const url = `${this.rutas.index}/${data.id}`;
                axios.put(url, this.form)
                    .then(response => { if(response.status == 200) console.log('actualizado'); })
                    .catch(error => console.log(error))
            },

            addIde(){
                this.form.push({
                    id: 0,
                    patron_id: this.data.id,
                    magnitude: '',
                    unit_measurement: '',
                    rangos: [{rango: '', rango_medida: '', resolucion: '', resolucion_medida: ''}]
                });
            },
            delIde(){
                this.form.splice((this.form.length-1), 1)
            },
            addRank(index){
                this.form[index].rangos.push({rango: '', rango_medida: '', resolucion: '', resolucion_medida: ''});
            },
            delRank(index){
                 this.form[index].rangos.splice((this.form[index].rangos.length-1), 1);
            },

            changeUnidadMedida(event, index){
                const unidades = this.unidades_ide.map( unidad => {
                    return unidad.simbolo === '-' ? this.form[index].unit_measurement : unidad.simbolo + this.form[index].unit_measurement;
                });
                this.form[index].selectUnidades = unidades;
            },

            alerta(){
                const options = {
                    title: 'Magintudes Cargadas',
                    text: 'Magnitudes cargadas correctamente!',
                    icon: 'success',
                    confirmButtonText: 'Cargar Detalles',
                    cancelButtonText: 'Ir al patrón',
                    showCancelButton: true,
                }

                this.$swal.fire(options).
                    then(respuesta => {
                        if(respuesta.isConfirmed) location.replace(this.rutas.patronIdeShow);
                        else location.replace(this.rutas.show);
                    });
            },

            alertaError(mensaje = 'Error al insertar!', title = 'Error', icon = 'danger'){
                this.$swal.fire(title, mensaje, icon);
            }
        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
                return this.$v.form.$invalid;
            },
            resolution(){
                return this.data.type == 'DIGITAL' ? 'Resolución' : 'División';
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
