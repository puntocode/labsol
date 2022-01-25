import { MessageDisplayedEvent } from '../../../metronic/plugins/formvalidation/src/js/plugins/Message';
<template>
   <div class="card-body pt-3">
        <form class="mb-5" autocomplete="off" @submit.prevent="submit">

            <div class="row align-items-end">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Magnitud <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-uppercase" v-model="form.name">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" v-model="form.condition_type">
                            <option value="PATRON">PATRON</option>
                            <option value="EQUIPO">EQUIPO</option>
                            <option value="TODOS">TODOS</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 mb-6">
                    <h4 class="font-bold w-100">Unidades de Medida</h4>
                    <div class="position-absolute" style="top: 11px; right: 14px">
                        <span class="mr-3 hover-btn" @click="addUnit()"><i class="fas fa-plus text-primary"></i></span>
                        <span class="hover-btn" @click="addUnit(false)" v-show="delShow"><i class="fas fa-minus text-danger"></i></span>
                    </div>
                </div>

                <div class="col-md-3" v-for="(medida, index) in form.unit_measurement" :key="index">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="form.unit_measurement[index]">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5 row">
                <a :href="rutas.index" class="btn btn-secondary mr-2" title="Volver a listado">Volver</a>
                <button type="submit" class="btn btn-primary" :disabled="disable" title="Completa los campos obligatorios">{{ textoBtn }}</button>
            </div>

        </form>
    </div>
</template>

<script>
    export default {
        props: ['magnitud'],
        data() {
            return {
                form: {id: 0, name: '', condition_type: 'TODOS', unit_measurement: [] },
                rutas: window.routes
            }
        },

        created () {
            if(this.magnitud) this.form = this.magnitud;
        },

        computed: {
            textoBtn() {
                return this.form.id === 0 ? 'Crear' : 'Actualizar';
            },

            disable(){
                return this.form.name.trim() === ''
            },

            delShow(){
                return this.form.unit_measurement !== null && this.form.unit_measurement.length;
            }
        },

        methods: {
            addUnit(suma = true) {
                if(this.form.unit_measurement == null) this.form.unit_measurement = [];

                if(suma) this.form.unit_measurement.push('');
                else this.form.unit_measurement.pop();
            },

            async submit(){
                try{
                    //comprobamos array medidas
                    if(this.form.unit_measurement.length){
                        const ban = this.form.unit_measurement.some(medida => medida == '');
                        if(ban){
                            this.$swal.fire('Error', 'Las medidas no pueden estar vacías!', 'error');
                            return;
                        }
                    }

                    let res = null;
                    if(this.form.id === 0) res = await axios.post(this.rutas.store, this.form);
                    else res = await axios.put(`${this.rutas.index}/${this.form.id}`, this.form);

                    let mensaje = this.form.id === 0 ? 'Creado' : 'Actualizado';

                    this.$swal('Ok', `La magnitud se ha ${mensaje}`, 'success')
                        .then( response => location.href = this.rutas.index);

                }catch(err){
                    this.$swal.fire('Error', 'Ocurrio un error inesperado', 'error');
                }
            }
        },

    }
</script>

<style lang="scss" scoped>

</style>
