<template>
    <fieldset>
        <div class="mb-10 form-card">
            <div class="mb-12 d-flex justify-content-between"><slot></slot></div>

            <div class="form-group row text-left" v-for="(patron, index) in patrones" :key="index">
               <label class="col-sm-3 col-form-label" v-text="patron.name"></label>
                <div class="col-md-9">
                    <SelectMultiple v-model="formulario.patrones[index].code" :options="patron.code" />
                </div>
            </div>

            <div class="form-group row text-left">
               <label class="col-sm-3 col-form-label">Equipos De Medición Ambiental</label>
                <div class="col-md-9">
                    <select v-model="formulario.ema" class="form-control">
                        <option v-for="(ema, i) in ambiental" :key="i" :value="ema">{{ ema }}</option>
                    </select>
                </div>
            </div>
        </div>

        <button
            type="button"
            class="float-right next action-button btn btn-primary"
            :disabled="disable"
            @click="siguiente">Siguiente
        </button>
    </fieldset>
</template>

<script>
    import {required, numeric} from "vuelidate/lib/validators";
    import SelectMultiple from 'v-select2-multiple-component';

    export default {
        components: { SelectMultiple },
        props: ['form', 'procedimiento'],
        data() {
            return {
                error: true,
                formulario: {
                    ...this.form,
                    patrones: [],
                    ema: ''
                },
                patrones: [],
                ambiental: []
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch(){
                this.patrones = await this.procedimiento.patrones.map(patron => {
                    return {name: patron.patron, code: patron.code}
                });
                this.formulario.patrones = await this.procedimiento.patrones.map(patron => {
                    return {name: patron.patron, code: []}
                });
                this.ambiental = await this.procedimiento.ambiental.code
                this.formulario.ema = this.ambiental[0];

            },
            siguiente() {
                this.$emit('click-next')
                this.$emit('update:form', this.formulario);
            },
        },
        //------------------------------------------------------------------------------------

        computed: {
            disable() {
                return this.$v.$invalid;
            },
        },
        //------------------------------------------------------------------------------------

        validations:{
            formulario:{
                patrones: {
                    $each: {
                        name: {required},
                        code: {required}
                    }
                }
            }
        }


    }
</script>

<style lang="scss" scoped>


table{
    background: #fff none repeat scroll 0 0;
    border-left: 1px solid #000;
    border-top: 1px solid #000;
    .form-table{border:0px solid #000; margin:0; background:transparent; width:100%}
    tr{ background:#eee;
        td{border-right:1px solid #000; border-bottom:1px solid #000; padding: 0 4px;}
        .bg-notext{background:#ccc;}
        .td-cero{background-color: #fff; border-top: 1px solid #fff; border-left: 1px solid #fff;}
        .borb-0{border-bottom: 1px solid #fff;}
    }
}
</style>
