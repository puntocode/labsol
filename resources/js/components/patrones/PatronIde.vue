<template>
    <div class="card-body">
        <form autocomplete="off" @submit.prevent="submit">

            <div class="row px-3">
                <div class="col-12 px-0 d-flex justify-content-between">
                    <h4>Patron: <span class="text-black-50">{{ data.code }}</span></h4>
                    <span>Magnitud <span class="badge badge-info font-weight-bold ml-2">{{ data.magnitude.name }}</span></span>
                </div>
                <div class="col-12 text-center mt-8 py-2 bg-secondary position-relative">
                    <h4 class="font-bold w-100">Magnitudes</h4>
                    <div class="position-absolute" style="top: 11px; right: 14px">
                        <span class="hover-btn mr-3" @click="addIde"><i class="fas fa-plus text-primary"></i></span>
                        <span class="hover-btn" @click="delIde" v-show="form.length > 1"><i class="fas fa-minus text-danger"></i></span>
                    </div>
                </div>
            </div>

            <div class="row pt-4" v-for="(v, index) in $v.form.$each.$iter" :key="index">
                <div class="col-8">
                    <label for="">Magnitud</label>
                    <input class="form-control" v-model.trim="v.magnitude.$model" :class="{'is-invalid': v.magnitude.$error}">
                    <div class="invalid-feedback"><span v-if="!v.magnitude.$model">Este campo es requerido</span></div>
                </div>

                <div class="col-4">
                    <label for="">Unidad de medida</label>
                    <select class="form-control text-capitalize" v-model="v.unit_measurement.$model" @change="changeUnidadMedida($event, index)">
                        <option v-for="(unidad, index) in unidades" :key="index" :id="unidad">{{ unidad }}</option>
                    </select>
                    <div class="invalid-feedback"><span v-if="!v.unit_measurement.$model">Este campo es requerido</span></div>
                </div>

                <div class="col-12 mt-4 d-flex justify-content-between" v-for="(rank, i) in form[index].rango" :key="i">
                    <div class="d-flex align-items-stretch">
                        <span class="align-self-center">Rango</span>
                        <input class="align-self-center form-control mx-3" v-model="rank.rango">
                        <input class="align-self-center form-control" v-model="rank.unidad_medida" disabled>
                        <select class="form-control mx-3" v-model="rank.ide_medida" @change="changeMedidaIde($event, index, i)">
                            <option v-for="(medida,ix) in unidades_ide" :key="ix" :id="medida.simbolo">{{ medida.simbolo }}</option>
                        </select>
                        <!-- <button type="button" class="btn btn-primary align-self-center">Cargar</button> -->
                    </div>

                    <div>
                        <button type="button" class="btn btn-outline-primary" title="Agregar nuevo rango" @click="addRank(index)" v-if="i === 0"><i class="fas fa-plus ml-1"></i></button>
                        <button type="button" class="btn btn-outline-danger" title="Elimina este valor" @click="delRank(index)" v-else><i class="fas fa-trash ml-1"></i></button>
                    </div>
                </div>

                <div class="col-12 mt-10 border-bottom border-primary"></div>
            </div>

            <div class="row">
                <div class="col-12 my-10 text-center">
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

        data() {
            return {
                form: [{
                    id: 0,
                    patron_id: this.data.id,
                    magnitude: '',
                    unit_measurement: '',
                    rango: [{rango: '', unidad_medida: '', ide_medida: '-'}]
                }],
                rutas: window.routes,
                unidades: [],
                unidades_ide: []
            }
        },

        created () {
            this.fetch();
        },

        validations:{
            form: {
                $each:{
                    patron_id: {required},
                    magnitude: {required},
                    unit_measurement: {required},
                }
            }

        },

        methods: {
            async fetch(){
                this.unidades = await this.data.magnitude.unit_measurement;
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
                    rango: [{rango: '', unidad_medida: '', ide_medida: '-'}]
                });
            },
            delIde(){
                this.form.splice((this.form.length-1), 1)
            },
            addRank(index){
                this.form[index].rango.push({rango: '', unidad_medida: '', ide_medida: '-'});
            },
            delRank(index){
                 this.form[index].rango.splice((this.form[index].rango.length-1), 1);
            },

            changeUnidadMedida(event, index){
                const data = this.form[index].rango;
                for (let i = 0; i < data.length; i++) {
                    this.form[index].rango[i].unidad_medida = event.target.value;
                    this.form[index].rango[i].ide_medida = '-';
                }
            },
            changeMedidaIde(event, indexForm, indexRango){
                const selected = event.target.value;
                const unidad = this.form[indexForm].unit_measurement;

                if(selected !== '-') this.form[indexForm].rango[indexRango].unidad_medida = `${selected}${unidad}`;
                else this.form[indexForm].rango[indexRango].unidad_medida = unidad;
            },

             alerta(mensaje = 'Magnitudes cargada correctamente!', title = 'Cargado', icon = 'success'){
                this.$swal.fire(title, mensaje, icon);
            }
        },

        computed: {
            disable() {
                return this.$v.form.$invalid;
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
