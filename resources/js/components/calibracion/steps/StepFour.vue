<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="row">
                <div class="col-md-5 offset-md-2 text-center">
                    <h4 class="mb-4">Indicación del Patrón (IP)</h4>
                    <select class="form-control" v-model="formulario.ip_unidad_medida" @change="changeUnidadMedida($event)">
                        <option v-for="(unidad, index) in unidadMedidas" :key="index">{{ unidad }}</option>
                    </select>
                </div>

                <div class="col-md-5 text-center">
                    <h4 class="mb-4">Indicación del Equipo Calibrado (IEC)</h4>
                    <input v-model="formulario.iec_unidad_medida" class="form-control" disabled>
                </div>
            </div>

            <div class="row mt-4" v-for="(valor, indice) in formulario.valores" :key="indice">
                <div class="col-md-2">
                    <select class="form-control" v-model="valor.patron">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.ip_medida" @change="changeUMValor($event, indice, 'ip')">
                        <option v-for="(ip, i) in selectIP" :key="i">{{ ip }}</option>
                    </select>
                    <input type="number" step="0.01" class="form-control mr-3">
                    <input type="number" step="0.01" class="form-control mr-3">
                    <input type="number" step="0.01" class="form-control">
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.iec_medida" @change="changeUMValor($event, indice, 'iec')">
                        <option v-for="(iec, i) in selectIEC" :key="i">{{ iec }}</option>
                    </select>
                    <input type="number" step="0.01" class="form-control mr-3">
                    <input type="number" step="0.01" class="form-control mr-3">
                    <input type="number" step="0.01" class="form-control">
                </div>
            </div>

            <button type="button"
                class="float-right next action-button btn btn-primary mt-12"
                title="Por favor completa todos los campos para continuar"
                @click="siguiente">Siguiente
            </button>
        </div>
    </fieldset>
</template>

<script>
    export default {
        props: ['form', 'medida'],
        data() {
            return {
                formulario: {
                    ...this.form,
                    ip_unidad_medida: '',
                    iec_unidad_medida: this.form.unidad_medida,
                    valores: [
                        {patron: '', ip_medida: '', ip_valor: [], iec_medida: '', iec_valor: []},
                        {patron: '', ip_medida: '', ip_valor: [], iec_medida: '', iec_valor: []},
                        {patron: '', ip_medida: '', ip_valor: [], iec_medida: '', iec_valor: []},
                        {patron: '', ip_medida: '', ip_valor: [], iec_medida: '', iec_valor: []},
                        {patron: '', ip_medida: '', ip_valor: [], iec_medida: '', iec_valor: []},
                    ]
                },
                medidaGlobal: this.form.unidad_medida,
                subMultiplos: [],
                unidadMedidas: [],
                selectPatrones: [],
                selectIEC: [],
                selectIP: [],
                rutas: window.routes
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch(){
                const res = await axios.get(this.rutas.submultiplos);
                this.subMultiplos = await res.data;
                this.unidadMedidas = this.medida != null ? this.medida.unit_measurement : [];
                this.selectPatrones = this.formulario.patrones[0].code

                this.selectIEC = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? this.medidaGlobal : unidad.simbolo+this.medidaGlobal;
                });
            },

            changeUnidadMedida(event){
                const medida = event.target.value;
                this.selectIP = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });
            },
            changeUMValor(event, index, name){
                console.log(name)
                if(index === 0){
                    const medida = event.target.value;
                    this.$swal.fire({
                        title: 'Cambiar',
                        text: 'Desea cambiar todas las unidades',
                        icon: 'question',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                        showCancelButton: true,
                    })
                    .then( result => {
                        if(result.isConfirmed){
                            this.cambiarUnidadesValor(name, medida);
                        }
                    });

                }

                return;
            },
            cambiarUnidadesValor(name, medida){
                this.formulario.valores.forEach(valor => {
                    if(name === 'ip') valor.ip_medida = medida;
                    else valor.iec_medida = medida;
                })
            },


            siguiente() {
                this.$emit('click-next')
                this.updateForm()
            },
        }


    }
</script>

<style lang="scss" scoped>

</style>
