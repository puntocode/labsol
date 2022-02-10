<template>
    <div class="row mx-2">

        <form @submit.prevent="submit">
            <div class="col-12 d-flex align-items-center py-4">
                <span class="title mr-3">Rango</span>
                <div class="d-flex align-items-center">
                    <span class="mr-3">de</span>
                    <input type="number" step="0.000001" class="form-control" v-model="form.rango_de">
                    <input class="form-control ml-3" :value="form.rango_unidad" disabled>
                </div>
                <div class="d-flex align-items-center">
                    <span class="mx-3">a</span>
                    <input type="number" step="0.000001" class="form-control" v-model="form.rango_a">
                    <select class="form-control ml-3" v-model="form.rango_unidad">
                        <option v-for="(unidad, i) in selectUnidades" :key="i">{{ unidad }}</option>
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <span class="mx-3 title">cmc</span>
                    <input type="number" step="0.000001" class="form-control" v-model="form.cmc">
                    <select class="form-control ml-3" v-model="form.cmc_unidad">
                        <option v-for="(unidad, i) in selectUnidades" :key="i">{{ unidad }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success ml-4" :disabled="$v.form.$invalid">
                    <i v-if="loading" class="fas fa-spinner fa-spin px-0"></i>
                    <i v-else class="fas fa-check px-0"></i>
                </button>
            </div>
        </form>

        <div class="col-12 my-8">
            <CmcTable
                @editarCmc="editCmc"
                :cmc-table="cmcRangos"
                :show="true"
                v-if="cmcRangos.length" />
        </div>
    </div>
</template>

<script>
    import {required} from "vuelidate/lib/validators";
    import CmcTable from './CmcTable';


    export default {
        components: {CmcTable},
        props: ['patron', 'medida', 'procedimiento_id'],

        data() {
            return {
                cmcRangos: [],
                form: {
                    id: 0,
                    patron_code: this.patron,
                    patron_medida: '',
                    cmc: '',
                    cmc_unidad: '',
                    rango_a: '',
                    rango_de: '',
                    rango_unidad: '',
                    procedimiento_id: this.procedimiento_id
                },
                loading: false,
                subMultiplos: [],
                selectUnidades: [],
                rutas: window.routes
            }
        },

        created () {
            this.fetch();
        },


        validations:{
            form:{
                id: {required},
                rango_de: {required},
                rango_a: {required},
                cmc: {required},
                cmc_unidad: {required},
                rango_unidad: {required},
                patron_medida: {required},
            }
        },

        methods: {
            async fetch(){
                try{
                    const res = await axios.get(this.rutas.getSubMultiplos);
                    const data = await res.data;
                    this.subMultiplos = data.map(multiplo => multiplo.simbolo);

                    let params = {params: {procedimiento_id: this.procedimiento_id, patron_code: this.patron}};
                    const response = await axios.get(this.rutas.getCmcs, params);
                    this.cmcRangos = await response.data;
                }catch(err){
                    console.error(err);
                }
            },

            async submit(){
                try{
                    this.loading = true;
                    let result;

                    if(this.form.id === 0) result = await this.insertar();
                    else  result = await this.actualizar();

                    let title = this.form.id === 0 ? 'Insertado' : 'Actualizado';
                    this.limpiar('success', title, result.cmc);
                }catch(err){
                    this.limpiar('error');
                    throw new Error('Error al insertar');
                }
            },

            insertar(){
                return axios.post(this.rutas.insertar, this.form)
                    .then(res =>{ if(res.status == 201) return res.data });
            },

            actualizar(){
                return axios.put(this.rutas.actualizar, this.form)
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            editCmc(cmcObj){
                this.$emit('update:medida', cmcObj.patron_medida)
                this.form = cmcObj;
            },

            limpiar(tipo, title = 'Insertado', datos){
                if(tipo == 'success') this.$swal.fire(title, `CMC ${title} Correctamente!!`, 'success');
                else this.$swal.fire('Error', 'Error en los datos', 'error');

                if(title == 'Insertado')this.cmcRangos.push(datos);
                else this.cmcRangos.splice(this.form.index, 1, datos);

                this.form.id = 0;
                this.form.cmc = '';
                this.form.rango_a = '';
                this.form.rango_de = '';
                this.loading = false;
            }
        },

        watch: {
            medida(){
                this.selectUnidades = this.subMultiplos.map( multiplo => {
                    return multiplo === '-' ? this.medida : multiplo + this.medida;
                });

                this.form.rango_unidad = '';
                this.form.patron_medida = this.medida;
            }
        }
    }
</script>

<style lang="scss">
    .title{font-size: 18px; font-weight: 600;}
</style>
