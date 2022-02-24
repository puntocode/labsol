<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="form-group row text-left mt-10">
                <div class="col-md-6 d-flex">
                    <label class="label-line">Responsable</label>
                    <input type="text" class="form-control" :value="username" disabled />
                </div>

                <div class="col-md-6 d-flex">
                    <!-------------------------------- F. Fin ------------------------------------------------------------------------------------------------>
                    <label class="label-line">Fecha de Culminación<span class="text-danger">*</span></label>
                    <div class="input-group" v-if="form.fecha_fin">
                        <!-- <i class="la la-edit"></i> -->
                        <input class="form-control" :value="form.fecha_fin" disabled />
                    </div>

                    <div v-else class="d-flex w-100">
                        <div class="input-icons">
                            <i class="la la-calendar"></i>
                            <date-picker v-model.lazy="formulario.fecha_fin" class="pl-10" :config="options" @blur="updateCampo('fecha_fin')"></date-picker>
                        </div>

                        <button
                            type="button"
                            class="btn btn-success ml-2 p-0"
                            :disabled="!formulario.fecha_fin"
                            @click="updateCampo('fecha_fin')">
                            <i class="la la-check icon px-3"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <!-------------------------------- Temp. Final ---------------------------------------------------------------------------------------------->
                <div class="col-md-6 d-flex">
                    <label class="label-line">Temperatura Final<span class="text-danger">*</span></label>

                    <div class="input-group">
                        <input v-if="form.temperatura_final" class="form-control" :value="form.temperatura_final" disabled />

                        <input
                            v-else
                            class="form-control"
                            type="number"
                            step="0.01"
                            v-model.lazy="formulario.temperatura_final"
                            @blur="updateCampo('temperatura_final')" />

                        <div class="input-group-append">
                            <span class="input-group-text text-icon">&#8451;</span>
                        </div>
                    </div>
                </div>

                <!-------------------------------- Humedad. Final ------------------------------------------------------------------------------------->
                <div class="col-md-6 d-flex">
                    <label class="label-line">Humedad Relativa Final<span class="text-danger">*</span></label>

                    <div class="input-group">
                        <input v-if="form.humedad_final" class="form-control" :value="form.humedad_final" disabled />

                        <input
                            v-else
                            class="form-control"
                            type="number"
                            step="0.01"
                            v-model.lazy="formulario.humedad_final"
                            @blur="updateCampo('humedad_final')" />

                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-percent"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row text-left mt-10">
                <!-------------------------------- Observaciones ------------------------------------------------------------------------------------->
                <div class="col-md-12 d-flex">
                    <label class="label-line">Observaciones</label>
                    <textarea
                        id="obs"
                        class="form-control w-100"
                        v-model="formulario.obs"
                        @blur="updateCampo('obs', false)"
                    ></textarea>
                </div>
            </div>

            <div class="form-group row text-left">
                <div class="col-12 d-flex">
                    <label class="label-line">Observaciones Generales</label>
                    <div class="card w-100">
                        <div class="card-body p-4" v-html="datos.general"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-between">
            <button
                type="button"
                class="btn btn-secondary"
                @click="atras">Atrás
            </button>

            <button type="button"
                class="btn btn-primary"
                title="Por favor completa todos los campos para continuar"
                :disabled="disable"
                @click="siguiente">Finalizar
            </button>
        </div>
    </fieldset>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker';

    export default {
        components: { datePicker },
        props: ['form', 'datos'],
        data() {
            return {
                formulario: {},
                options: { format: 'yyyy/MM/DD' },
                rutas: window.routes,
                username: window.username,
            }
        },
        //------------------------------------------------------------------------------------

        created () {
           if(!this.formulario.fecha_fin) this.formulario.fecha_fin = new Date().toISOString().substr(0, 10);
           this.formulario.obs = this.form.obs;
        },
        //------------------------------------------------------------------------------------

        methods: {
            siguiente() {
                this.$emit('click-next')
            },

            async updateCampo(campo, obligatorio=true){
                try{
                    const valor = this.formulario[campo];
                    if(!valor && obligatorio) throw new Error('El campo es obligatorio');
                    if(!valor) return;


                    let data  = {campo, valor, id: this.form.id};
                    const res = await axios.put(this.rutas.updateCampo, data);
                    const value = await res.data;

                    if(value) this.$emit('update-form', data);
                    if(campo === 'obs') document.getElementById('obs').disabled = true;
                }catch(err){
                    this.$swal.fire('Error', err.message, 'error');
                }
            },

            atras() {
                this.$emit('click-back')
            },
        },
        //------------------------------------------------------------------------------------

        computed:{
            disable() {
                return !this.form.fecha_fin
                    || !this.form.humedad_final
                    || !this.form.temperatura_final
            }
        },

    }
</script>

<style lang="scss" scoped>
    .label-line{margin: auto 0; flex: 0 0 150px;}
    .input-group-text{max-height: 37px; color:#B5B5C3;}
    .text-icon{font-size: 1.3rem; padding: 0 12px;}
    .input-icons { width: 100%; margin-right: 6px;
        i { position: absolute; padding: 10px; font-size: 20px; }
    }
</style>
