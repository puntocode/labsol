<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="row">
                <div class="col-md-5 offset-md-2 text-center">
                    <h4 class="mb-4">Indicación del Patrón (IP)</h4>
                    <select class="form-control" v-model="formulario.valores_medidas.ip_medida_general" @change="changeUnidadMedida($event)">
                        <option v-for="(unidad, index) in unidadMedidas" :key="index">{{ unidad }}</option>
                    </select>
                </div>

                <div class="col-md-5 text-center">
                    <h4 class="mb-4">Indicación del Equipo Calibrado (IEC)</h4>
                    <input v-model="formulario.valores_medidas.iec_medida_general" class="form-control" disabled>
                </div>
            </div>

            <div class="row mt-4" v-for="(valor, indice) in formulario.valores" :key="indice">
                <div class="col-md-2">
                    <select class="form-control" v-model="valor.patron" :disabled="disableIpMedida" :id="`patron-${indice}`">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.ip_medida" @change="changeUMValor($event, indice, 'ip')"
                    :id="`ip-medida-${indice}`" :disabled="valor.patron === ''">
                        <option v-for="(ip, i) in selectIP" :key="i">{{ ip }}</option>
                    </select>
                    <input type="number" step="0.01" class="form-control mr-3" :id="`ip-valor-0-${indice}`" @blur="bloquear(`#ip-valor-0-${indice}`)"
                        v-model="valor.ip_valor[0]" :disabled="valor.patron.trim() === '' || valor.ip_medida.trim() === ''">

                    <input type="number" step="0.01" class="form-control mr-3" :id="`ip-valor-1-${indice}`" @blur="bloquear(`#ip-valor-1-${indice}`)"
                        v-model="valor.ip_valor[1]" :disabled="valor.ip_valor[0] === '' || valor.iec_valor[0] === ''">

                    <input type="number" step="0.01" class="form-control" :id="`ip-valor-2-${indice}`" @blur="bloquear(`#ip-valor-2-${indice}`)"
                        v-model="valor.ip_valor[2]" :disabled="valor.ip_valor[1] === '' || valor.iec_valor[1] === ''">
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.iec_medida" :id="`iec-medida-${indice}`"
                        :disabled="valor.ip_valor[0] === ''" @change="changeUMValor($event, indice, 'iec')" >
                        <option v-for="(iec, i) in selectIEC" :key="i">{{ iec }}</option>
                    </select>

                    <input type="number" step="0.01" class="form-control mr-3" :id="`iec-valor-0-${indice}`" @blur="bloquear(`#iec-valor-0-${indice}`)"
                        v-model="valor.iec_valor[0]" :disabled="valor.ip_valor[0] === '' || valor.iec_medida === ''">

                    <input type="number" step="0.01" class="form-control mr-3" :id="`iec-valor-1-${indice}`" @blur="bloquear(`#iec-valor-1-${indice}`)"
                        v-model="valor.iec_valor[1]" :disabled="valor.ip_valor[1] === '' || valor.iec_valor[0] === ''">

                    <input type="number" step="0.01" class="form-control" :id="`iec-valor-2-${indice}`" @blur="calcularIP(indice)"
                        v-model="valor.iec_valor[2]" :disabled="valor.ip_valor[2] === '' || valor.iec_valor[1] === ''">
                </div>
            </div>
            <hr>

            <div class="row mt-15">
                <div class="col-12" v-for="(resultado, index) in resultados" :key="index">
                    <span class="text-primary">Promedio carga:</span>
                    <span class="mr-10">{{ resultado.promedioIp }} {{ resultado.unidadIp }}</span>

                    <span class="text-primary">Convertido a Unidad Base:</span>
                    <span class="mr-10">{{ resultado.promedioBase }} {{ resultado.unidadBase }}</span>

                    <span class="text-primary">Convertido a Unidad del Patron:</span>
                    <span>{{ resultado.promedioPatron }} {{ resultado.unidadPatron }}</span>
                </div>
            </div>

            <!-- <div class="row mt-18">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">IP</th>
                            <th scope="col">Desvío estandar IP</th>
                            <th scope="col">Error Patrón</th>
                            <th scope="col">IP Corregido</th>
                            <th scope="col">IEC</th>
                            <th scope="col">Desvío estandar IEC</th>
                            <th scope="col">Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1502 Bar</td>
                                <td>0,0076 Bar</td>
                                <td>0,0061 Bar</td>
                                <td>1.51 Bar</td>
                                <td>1.500 Bar</td>
                                <td>0,00 Bar</td>
                                <td>-0,0077 Bar</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div> -->

            <button type="button"
                class="float-right next action-button btn btn-primary mt-12"
                title="Por favor completa todos los campos para continuar"
                @click="siguiente">Siguiente
            </button>
        </div>
    </fieldset>
</template>

<script>
import convertirBase from "../../../functions/convertir-base.js"
import convertirUnidad from "../../../functions/convertir-unidad.js"

    export default {
        props: ['form', 'medida'],
        data() {
            return {
                formulario: {
                    ...this.form,
                    valores_medidas: { ip_medida_general: '', iec_medida_general: this.form.unidad_medida },
                    valores: [
                        {patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                    ]
                },
                medidaGlobal: this.form.unidad_medida,
                subMultiplos: [],
                unidadMedidas: [],
                selectPatrones: [],
                selectIEC: [],
                selectIP: [],
                resultados: [],
                rutas: window.routes
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        computed: {
            disableIpMedida(){
                return this.formulario.valores_medidas.ip_medida_general.trim() === '';
            }
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

            async calcularIP(indice){

                if( this.formulario.valores[indice].iec_valor[2] === '' ){
                    this.alertaError('No puedes dejar un campo vacío!!');
                    return;
                }

                // Buscamos la unidad de medida en el IDE
                const patron = this.formulario.valores[indice].patron;
                const res = await axios.get(this.rutas.patronUmIde, {params: {'patron': patron}})
                const ide = await res.data.ide;

                if(ide.length === 0){
                    this.alertaError('Por favor carga el IDE del patron seleccionado!')
                    this.formulario.valores[indice].iec_valor[2] = '';
                    return;
                }

                this.alertaCalculando();

                //Unidades de medida
                const unidadIde = ide[0].unit_measurement;
                const unidadIPgeneral = this.formulario.valores_medidas.ip_medida_general;
                const unidadMedidaIP = this.formulario.valores[indice].ip_medida;
                // const unidadIECgeneral = this.formulario.valores_medidas.iec_medida_general;
                // const unidadMedidaIEC = this.formulario.valores[indice].iec_medida;


                // Hallamos el promedio IP
                const valoresIP = this.formulario.valores[indice].ip_valor;
                const sumaIP = valoresIP.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                const promedioIP = sumaIP/3;


                // Convertimos en la unidad base
                let baseIP = {};
                if(unidadMedidaIP !== unidadIPgeneral) baseIP = convertirBase(unidadIPgeneral, unidadMedidaIP, promedioIP);
                else baseIP = {promedio: promedioIP, unidad: unidadIPgeneral};
                console.log(baseIP);

                // Convertimos a la unidad del patron
                let basePatron = {};
                if(unidadIPgeneral !== unidadIde) basePatron = convertirUnidad(unidadIde, baseIP.unidad, baseIP.promedio);
                else basePatron = {promedio: baseIP.promedio, unidadPatron: unidadIde};
                console.log(basePatron);

                this.resultados.push({
                    promedioIp: promedioIP,
                    unidadIp: unidadMedidaIP,
                    promedioBase: baseIP.promedio,
                    unidadBase: baseIP.unidad,
                    promedioPatron: basePatron.promedio,
                    unidadPatron: basePatron.unidadPatron,
                });

                this.finalizarCalculo(indice);
            },

            finalizarCalculo(indice){
                $(`#ip-medida-${indice}`).attr('disabled', true);
                $(`#patron-${indice}`).attr('disabled', true);
                $(`#iec-medida-${indice}`).attr('disabled', true);
                $(`#iec-valor-2-${indice}`).attr('disabled', true);
                this.$swal.close();
            },

            changeUnidadMedida(event){
                const medida = event.target.value;
                this.selectIP = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });
            },

            changeUMValor(event, index, name){
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



            alertaError(mensaje){
                this.$swal.fire('Error', mensaje, 'error')
            },
            alertaCalculando(){
                this.$swal.fire({
                    title: 'Calculando!',
                    html: 'Calculando los datos.',
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                })
            },

            bloquear(inputName){
                if( $(inputName).val() === '' ) this.alertaError('No puedes dejar un campo vacío!!')
                else $(inputName).attr('disabled', true);
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
