<template>
    <div class="card-body pt-0">
        <div class="row" v-if="loading">
            <div class="col-12 d-flex justify-content-center">
                <grid-loader :loading="loading" color="#009BDD" :size="'25px'"></grid-loader>
            </div>
        </div>


        <div class="row" v-else>
            <form @submit.prevent="submit">

                <!----------------------------- Patron ------------------------->

                <div v-for="(rangos, index) in form" :key="index" class="my-12 px-6 row">
                    <div class="p-2 mb-8 text-center col-12 bg-secondary position-relative">
                        <h4 class="font-bold w-100">Rangos</h4>
                        <div class="position-absolute" style="top: 11px; right: 14px">
                            <span class="mr-3 hover-btn" @click="addRango(index)"><i class="fas fa-plus text-primary"></i></span>
                            <span class="hover-btn" @click="addRango(index, false)" v-show="rangos.cmc_rangos.length > 1">
                                <i class="fas fa-minus text-danger"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 d-flex mb-8 align-items-center">
                        <span class="title mr-10">Patron</span>
                        <input class="form-control" :value="rangos.code" disabled>
                        <span class="mx-4">Unidad Medida</span>
                        <select class="form-control" v-model="rangos.unidad_medida">
                            <option v-for="(magnitud, i) in magnitudes" :key="i">{{ magnitud }}</option>
                        </select>
                    </div>


                    <!----------------------------- Rangos------------------------->

                    <div
                        class="col-12 d-flex align-items-center py-4"
                        v-for="(rango, k) in rangos.cmc_rangos"
                        :key="k">

                        <span class="title mr-3">Rango</span>
                        <div class="d-flex align-items-center">
                            <span class="mr-3">de</span>
                            <input type="number" step="0.000001" class="form-control" v-model="rango.rango_de">
                            <input class="form-control ml-3" :value="rangos.unidad_medida" disabled>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="mx-3">a</span>
                            <input type="number" step="0.000001" class="form-control" v-model="rango.rango_a">
                            <input class="form-control ml-3" :value="rangos.unidad_medida" disabled>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="mx-3 title">cmc</span>
                            <input type="number" step="0.000001" class="form-control" v-model="rango.cmc">
                            <input class="form-control ml-3" :value="rangos.unidad_medida" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary" :disabled="$v.form.$invalid">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import GridLoader from 'vue-spinner/src/GridLoader.vue'
    import {required} from "vuelidate/lib/validators";


    export default {
        components: {GridLoader},
        props: ['procedimiento'],


        data() {
            return {
                loading: true,
                form: [],
                magnitudes: this.procedimiento.magnitud.unit_measurement,
                rutas: window.routes
            }
        },


        created () {
            if(!this.procedimiento.cmcs.length) this.iniciar();
            else this.cargados();
        },


        validations:{
            form:{
                $each:{
                    id: {required},
                    unidad_medida: {required},
                    cmc_rangos: {
                        $each:{
                            rango_de: {required},
                            rango_a: {required},
                            cmc: {required},
                        }
                    }
                }
            }
        },



        methods: {
            async iniciar() {
                try{
                    const patrones = this.obtenerPatrones();
                    const patrones_ids = await this.obtenerIdsPatrones(patrones);

                    //cargamos la tabla cmcs por primera vez
                    let form = { procedimiento_id: this.procedimiento.id, patrones_ids}
                    const resp = await axios.post(this.rutas.insertCmc, form);
                    if(resp.data === 200) location.reload();
                }catch(err){
                    console.error(err);
                }
            },


            async obtenerIdsPatrones(patronesCodigo){
                try{
                    let patronesIds = [];

                    for(let i = 0; i < patronesCodigo.length; i++){
                        let res = await axios.get(this.rutas.getPatron, {params: {code: patronesCodigo[i]} });
                        let data = await res.data;
                        patronesIds.push({patron_id: data.id, unidad_medida: this.procedimiento.magnitud.unit_measurement[0]});
                    }

                    return patronesIds;
                }catch(err){
                    console.error(err);
                }
            },

            async submit(){
                try{
                    const res = await axios.put(this.rutas.updateCmc, this.form);
                    const data = await res.data;
                    console.log(data);

                }catch(err){
                    console.error(err);
                }
            },


            cargados(){
                this.form = this.procedimiento.cmcs.map(cmc => ({
                    id: cmc.pivot.id,
                    code: cmc.code,
                    unidad_medida: cmc.pivot.unidad_medida,
                    procedimiento_id: this.procedimiento.id,
                    cmc_rangos: [ {id: 0, rango_de: '', rango_a: '', cmc: '',} ]
                }));
                this.loading = false;
            },

            obtenerPatrones(){
                let patrones = [];
                this.procedimiento.patrones.forEach(patron => {
                    patron.code.forEach(codigo => patrones.push(codigo) );
                });
                return patrones;
            },

            addRango(index, add = true){
                if(add) this.form[index].cmc_rangos.push({id: 0, rango_de: '', rango_a: '', cmc: '',});
                else this.form[index].cmc_rangos.pop();
            },
        },
    }
</script>

<style lang="scss">
    .title{font-size: 18px; font-weight: 600;}
</style>
