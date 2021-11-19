<template>
    <div>
        <div class="my-8 d-flex justify-content-center" v-if="loading">
            <grid-loader :loading="loading" :color="color" :size="'25px'"></grid-loader>
        </div>

        <form v-else  @submit.prevent="submit" autocomplete="off">
            <!----------------------------- Cabecera ------------------------------------>
            <div class="my-8 row">
                <div class="col-md-4">
                    <label for="rango">Magnitud</label>
                    <h3>{{ data.patron_ide.magnitude }}</h3>
                </div>
                <div class="col-md-3">
                    <label for="rango">Rango</label>
                    <h3>{{ data.rango }} {{ data.rango_medida }}</h3>
                </div>
                <div class="col-md-3">
                    <label for="rango" v-text="resolution"></label>
                    <h3>{{ data.resolucion }} {{ data.resolucion_medida }}</h3>
                </div>
                <div class="pt-4 text-right col-md-2">
                    <button type="button" class="btn btn-outline-primary" @click="addAnterior">+ E</button>
                    <button type="button" class="btn btn-outline-danger" @click="delAnterior" v-show="form.e_anterior.length > 1">- E</button>
                </div>
            </div>

            <!----------------------------- Tabla Deriva -------------------------------->
            <div class="container-scroll">
                <div class="row">
                    <div class="pb-4 col-4">
                        <label class="text-center">IP</label>
                        <div class="d-flex">
                            <input id="ip-value" type="number" step="0.000001" class="form-control" v-model="form.ip.valor">
                            <select class="mx-3 form-control" v-model="form.ip.medida">
                                <option v-for="(medida,i) in selectUnidades" :key="i" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="pb-4 col-4">
                        <label class="text-center">U</label>
                        <div class="d-flex">
                            <input class="form-control" type="number" step="0.000001" v-model="form.u.valor">
                            <select class="mx-3 form-control" v-model="form.u.medida">
                                <option v-for="(medida,i) in selectUnidades" :key="i" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="pb-4 col-2 col-lg-2">
                        <label class="text-center">K</label>
                        <div class="d-flex">
                            <input type="number" step="0.000001" class="form-control" v-model="form.k">
                        </div>
                    </div>

                    <div class="pb-4 col-4 col-lg-2">
                        <label class="text-center">UC</label>
                        <div class="d-flex">
                            <input class="form-control" disabled v-model="form.uc.valor">
                            <input class="mx-3 form-control" v-model="form.uc.medida" disabled>
                        </div>
                    </div>

                    <div class="pb-4 col-4">
                        <label class="text-center">E (actual)</label>
                        <div class="d-flex">
                            <input type="number" step="0.000001" class="form-control" v-model="form.e_actual.valor">
                            <select class="mx-3 form-control" v-model="form.e_actual.medida">
                                <option v-for="(medida,ix) in selectUnidades" :key="ix" :id="medida">{{ medida }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4" v-for="(e, i) in form.e_anterior" :key="i">
                        <label class="text-center">E (anterior)</label>
                        <div class="d-flex">
                            <input type="number" step="0.000001" class="form-control" v-model="e.valor">
                            <input class="mx-3 form-control" v-model="e.medida" disabled>
                        </div>
                    </div>

                    <div class="pb-4 col-4">
                        <label class="text-center">Deriva</label>
                        <div class="d-flex">
                            <input class="form-control" disabled v-model="form.deriva.valor">
                            <input class="mx-3 form-control" v-model="form.deriva.medida" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <!----------------------------- BTN submit ---------------------------------->
            <div class="row">
                <div class="my-8 text-center col-12">
                    <hr>
                    <button type="submit" class="btn btn-primary" :disabled="$v.form.$invalid">
                        <i v-if="guardando" class="fas fa-spinner fa-spin"></i>
                        <span v-else>{{ textoBtn }}</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-8 row" v-if="table.length > 0">
            <div class="col-12">
                <TableDeriva :derivas="table" @editarDeriva="editarPadre" />
            </div>
        </div>
    </div>
</template>

<script>
    import TableDeriva from './TableDeriva';
    import {required} from "vuelidate/lib/validators";
    import GridLoader from 'vue-spinner/src/GridLoader.vue';

    export default {
        props: ['data'],
        components: { GridLoader, TableDeriva },

        //------------------------------------------------------------------------------------
        data() {
            return {
                form: {
                    id: 0,
                    k: '',
                    u: { valor: '', medida: ''},
                    ip: { valor: '', medida: ''},
                    uc: { valor: '', medida: ''},
                    deriva: { valor: '', medida: ''},
                    e_actual: {valor: '', medida: ''},
                    e_anterior: [{valor: '', medida: ''}],
                    ide_rango_id: this.data.id
                },
                guardando: false,
                table: {},
                loading: true,
                rutas: window.routes,
                unidades_ide: [],
                selectUnidades: [],
                color: '#009BDD',
            }
        },

        //------------------------------------------------------------------------------------
        created () {
            this.fetch();
        },

        //------------------------------------------------------------------------------------
        validations:{
            form: {
                k: {required},
                u: { valor: {required}, medida: {required} },
                ip: { valor: {required}, medida: {required} },
                e_actual: { valor: {required}, medida: {required} },
                deriva: { valor: {required}, medida: {required} },
            }
        },

        //------------------------------------------------------------------------------------
        methods: {
            async fetch(){
                let datos = await axios.get(this.rutas.unidades_ide);
                this.unidades_ide = await datos.data;

                const unidades = this.unidades_ide.map( unidad => {
                    return unidad.simbolo === '-' ? this.data.patron_ide.unit_measurement : unidad.simbolo + this.data.patron_ide.unit_measurement;
                });
                this.selectUnidades = unidades;
                this.table = this.data.rango_derivas;
                this.loading = false;
            },
            calcularUc(){
                this.form.u.valor.trim() == '' || this.form.k <= 0
                    ? this.form.uc.valor = ''
                    : this.form.uc.valor = (this.form.u.valor / this.form.k);
            },
            addAnterior(){
                if(this.form.e_actual.medida.trim() == '') this.alertaError('Por favor ingrese una unidad de medida en E (actual)');
                else this.form.e_anterior.push({valor: '', medida: this.form.e_actual.medida});
            },
            delAnterior(){
                this.form.e_anterior.pop();
               // this.form.e_anterior.splice((this.form.e_anterior.length-1), 1);
            },
            alertaError(mensaje = 'Error al insertar!'){
                this.$swal.fire('Error', mensaje, 'error');
                this.guardando = false;
            },
            alertSuccess(mensaje = 'Insertado correctamente!', title = 'Insertado'){
                this.limpiarForm();
                this.$swal.fire(title, mensaje, 'success')
                    .then(result =>{  if (result.isConfirmed) $('#ip-value').focus(); });
                this.guardando = false;
            },
            limpiarForm(){
                this.form.id = 0;
                this.form.ip.valor = '';
                this.form.u.valor = '';
                this.form.e_actual.valor = '';
                this.form.e_anterior.forEach(anterior => anterior.valor = '');
            },
            submit(){
                this.guardando = true;
                if(this.form.id === 0) this.insertar();
                else this.actualizar();
            },
            insertar(){
                axios.post(this.rutas.ruta_deriva, this.form)
                    .then(response => {
                        if(response.status == 200){
                            this.table.push(response.data);
                            this.alertSuccess();
                        }
                    })
                    .catch(error => this.alertaError())
            },
            async actualizar(){
                try{
                    const res = await axios.put(`${this.rutas.ruta_deriva}/${this.form.id}`, this.form);
                    const datos = await res.data;
                    this.table.splice(this.form.index, 1,datos);
                    this.alertSuccess('Actualizado correctamente', 'Actualizado');
                }catch(error){
                    this.alertaError('Error al actualizar');
                }
            },
            editarPadre(deriva){
                this.form = deriva;
            }
        },

        //------------------------------------------------------------------------------------
        computed: {
            cantidadDecimal(){
                return this.e_actual.valor.trim() === '' ? 0 : Math.floor(this.e_actual.valor.trim());
            },
            valorDeriva(){
                if (this.form.e_actual.valor == '') return '';

                return this.form.e_anterior[0].valor == null || this.form.e_anterior[0].valor.trim() === ''
                    ? parseFloat(this.data.resolucion) / 2
                    : parseFloat(this.form.e_actual.valor - this.form.e_anterior[0].valor).toFixed(4);
            },
            medidaDeriva(){
                return this.form.e_anterior[0].valor === null || this.form.e_anterior[0].valor.trim() === ''
                    ? this.data.resolucion_medida
                    : this.form.e_actual.medida
            },
            textoBtn(){
                return this.form.id > 0 ? 'Actualizar' : 'Guardar';
            },
            resolution(){
                return this.data.type == 'DIGITAL' ? 'Resolución' : 'División';
            }
        },

        //------------------------------------------------------------------------------------
        watch: {
            'form.k': function(){
                this.calcularUc();
            },
            'form.u.valor': function(){
                this.calcularUc();
            },
            'form.u.medida': function(){
                this.form.uc.medida = this.form.u.medida
            },
            'form.e_actual.medida': function(){
                this.form.deriva.medida = this.medidaDeriva
                for(let i = 0; i < this.form.e_anterior.length; i++){
                    this.form.e_anterior[i].medida = this.form.e_actual.medida
                }
            },
            valorDeriva(){
                this.form.deriva.valor = this.valorDeriva;
            },
            medidaDeriva(){
                this.form.deriva.medida = this.medidaDeriva;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .container-scroll > .row { overflow-x: auto; white-space: nowrap;}
    .container-scroll > .row > .col-2 { display: inline-block; float: none;}
</style>
