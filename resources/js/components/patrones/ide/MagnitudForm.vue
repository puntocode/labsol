<template>
    <form @submit.prevent="submit">
        <!----------------------------- Input Cabecera ------------------------->
        <div class="mt-8 row">
            <div class="col-8">
                <label>Magnitud</label>
                <input class="form-control" v-model.trim="$v.form.magnitude.$model" :class="{'is-invalid': $v.form.magnitude.$error}">
                <div class="invalid-feedback"><span v-if="!$v.form.magnitude.$model">Este campo es requerido</span></div>
            </div>

            <div class="col-4">
                <label>Unidad de medida</label>
                <select class="form-control text-capitalize" v-model="$v.form.unit_measurement.$model" @change="cargarSelectUnidades()">
                    <option v-for="(unidad, index) in unidades" :key="index" :id="unidad">{{ unidad }}</option>
                </select>
                <div class="invalid-feedback"><span v-if="!$v.form.unit_measurement.$model">Este campo es requerido</span></div>
            </div>
        </div>

        <!----------------------------- Input Rango ---------------------------->
        <div class="mt-5 row" v-for="(rank, i) in form.rangos" :key="i">
            <div class="col-4">
                <div class="d-flex align-items-stretch">
                    <span class="align-self-center">Rango</span>
                    <input class="mx-3 align-self-center form-control" v-model="rank.rango">
                    <select class="mx-3 form-control" v-model="rank.rango_medida">
                        <option v-for="(medida,ix) in selectUnidades" :key="ix" :id="medida">{{ medida }}</option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="d-flex align-items-stretch">
                    <span class="align-self-center">Resolución</span>
                    <input class="mx-3 align-self-center form-control" v-model="rank.resolucion">
                    <select class="mx-3 form-control" v-model="rank.resolucion_medida">
                        <option v-for="(medida_resolucion,ixr) in selectUnidades" :key="ixr" :id="medida_resolucion">
                            {{ medida_resolucion }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="d-flex justify-content-end">
                    <button type="button" class="mr-3 btn btn-outline-primary" v-show="i == 0" title="Agregar nuevo rango" @click="addRank()"><i class="ml-1 fas fa-plus"></i></button>
                    <a :href="`${rutas.ideRank}/${rank.id}/edit`" class="mr-3 btn btn-outline-primary font-weight-bold" v-if="rank.id > 0">Detalle</a>
                    <button type="button" class="btn btn-outline-danger" title="Elimina este valor" @click="delRank(i)"><i class="ml-1 fas fa-trash"></i></button>
                </div>
            </div>
        </div>

        <!----------------------------- BTN submit ----------------------------->
        <div class="my-8 row">
            <div class="text-center col-12">
                <hr>
                <button type="submit" class="btn btn-primary" :disabled="$v.form.$invalid">Editar Magnitud</button>
            </div>
        </div>
    </form>
</template>

<script>
    import {required} from "vuelidate/lib/validators";

    export default {
        props: ['data', 'patron'],

        //------------------------------------------------------------------------------------
        data() {
            return {
                form: this.data,
                rutas: window.routes,
                unidades: this.patron.magnitude.unit_measurement,
                unidades_ide: [],
                selectUnidades: []
            }
        },

        //------------------------------------------------------------------------------------
        created () {
            this.fetch();
        },

        //------------------------------------------------------------------------------------
        validations:{
            form:{
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
        },

        //------------------------------------------------------------------------------------
        methods: {
            async fetch(){
                let datos = await axios.get(this.rutas.unidades_ide);
                this.unidades_ide = await datos.data;
                this.cargarSelectUnidades();
            },
            cargarSelectUnidades(){
                const unidades = this.unidades_ide.map( unidad => {
                    return unidad.simbolo === '-' ? this.form.unit_measurement : unidad.simbolo + this.form.unit_measurement;
                });
                this.selectUnidades = unidades;
            },
            addRank(){
                this.form.rangos.push({rango: '', rango_medida: '', resolucion: '', resolucion_medida: '', id: 0});
            },
            delRank(index){
                const id = this.form.rangos[index].id;
                if(id > 0) this.eliminarRango(id, index);
                else this.form.rangos.splice(index, 1);
            },
            submit(){
                axios.put(this.rutas.actualizar, this.form)
                    .then(response => { if(response.status == 200) this.alerta() })
                    .catch(error => this.alertaError())
            },
            eliminarRango(id, index){
                this.$swal.fire({
                    title: 'Eliminar',
                    text: 'Desea eliminar este registro?',
                    icon: 'question',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'Cancelar',
                    showCancelButton: true,
                }).then( result => {
                        if(result.isConfirmed){
                            axios.delete(`${this.rutas.ideRank}/${id}`)
                                .then( response => {
                                    if(response.status === 200) {
                                        this.form.rangos.splice(index, 1);
                                        this.$swal.fire('Eliminado', 'Eliminado correctamente', 'success');
                                    }
                                }).catch( error =>  this.alertaError('Error al eliminar el rango!') )
                        }
                    });
            },

            alerta(){
                const options = {
                    title: 'Magintud Actualizada',
                    text: 'Magnitudes actualizadas correctamente!',
                    icon: 'success',
                    confirmButtonText: 'Editar Detalles',
                    cancelButtonText: 'Volver',
                    showCancelButton: true,
                }

                this.$swal.fire(options).
                    then(respuesta => {
                        if(respuesta.isConfirmed) location.reload();
                        else location.replace(this.rutas.patronIdeShow);
                    });
            },
            alertaError(mensaje = 'Error al actualizar!'){
                this.$swal.fire('Error', mensaje, 'error');
            }
        }
    }
</script>
