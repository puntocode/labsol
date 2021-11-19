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
                    <select class="form-control" v-model="valor.patron" :disabled="resultados.length != indice" :id="`patron-${indice}`">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.ip_medida" @change="changeUMValor($event, indice, 'ip')"
                    :id="`ip-medida-${indice}`" :disabled="resultados.length != indice">
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
                    :disabled="resultados.length != indice" @change="changeUMValor($event, indice, 'iec')" >
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

            <!-- <div class="row mt-15">
                <div class="col-12" v-for="(resultado, index) in resultados" :key="index">
                    <span class="text-primary">Promedio carga:</span>
                    <span class="mr-10">{{ resultado.promedioIp }} {{ resultado.unidadIp }}</span>

                    <span class="text-primary">Convertido a Unidad Base:</span>
                    <span class="mr-10">{{ resultado.promedioBase }} {{ resultado.unidadBase }}</span>

                    <span class="text-primary">Convertido a Unidad del Patron:</span>
                    <span>{{ resultado.promedioPatron }} {{ resultado.unidadPatron }}</span>
                </div>
            </div> -->

            <div class="row mt-18">
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
                            <tr v-for="(resultado, index) in resultados" :key="index">
                                <td>{{ resultado.ip }} {{ resultado.unidad }} </td>
                                <td>{{ resultado.desvIP }} {{ resultado.unidad }}</td>
                                <td>{{ resultado.errorIP }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <button type="button"
                :disabled="disable"
                class="float-right next action-button btn btn-primary mt-12"
                title="Por favor completa todos los campos para continuar"
                @click="siguiente">Siguiente
            </button>
        </div>
    </fieldset>
</template>

<script>
import interpolar from "../../../functions/interpolar.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import convertirBase from "../../../functions/convertir-base.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";

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
                redondeo: 2,
                resultados: [],
                rutas: window.routes,
                subMultiplos: [],
                selectPatrones: [],
                selectIEC: [],
                selectIP: [],
                unidadMedidas: [],
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
            this.fetch();
            const interpolacion = interpolar(0.015, 0, 2.48, 0, 0.01);
            console.log(interpolacion);
        },
        //------------------------------------------------------------------------------------

        computed: {
            disable(){
                return this.resultados.length !== this.formulario.valores.length;
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

                const resolution = this.form.resolucion.split('.');
                if(resolution.length === 2){
                    const redondeo = resolution[1].split('');
                    this.redondeo = redondeo.length+1;
                }
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
                const rangosDeriva = ide[0].rangos[0].rango_derivas;
                const unidadIPgeneral = this.formulario.valores_medidas.ip_medida_general;
                const unidadMedidaIP = this.formulario.valores[indice].ip_medida;

                //Array de valores convertidos a unidad Base
                const arrayValores = this.convertirUnidadBase(this.formulario.valores[indice].ip_valor, unidadMedidaIP, unidadIPgeneral);

                //Array de valores convertidos a la unidad IDE
                const arrayEnIde = this.convertirUnidadIde(arrayValores, unidadIPgeneral, unidadIde)

                //Calculo IP
                const promedio = (arrayEnIde.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                const desviacion = calcularDes(arrayEnIde);
                const errorIp = this.calcularError(rangosDeriva, promedio);

                // const unidadIECgeneral = this.formulario.valores_medidas.iec_medida_general;
                // const unidadMedidaIEC = this.formulario.valores[indice].iec_medida;

                const result = {
                    ip: promedio.toFixed(this.redondeo),
                    desvIP: desviacion.toFixed(5),
                    errorIP: errorIp === 'Error' ? 'Error' : `${errorIp} ${unidadIde}`,
                    unidad: unidadIde,
                }
                this.resultados.push(result);


                $(`#iec-valor-2-${indice}`).attr('disabled', true);
                this.$swal.close();
            },


            convertirUnidadBase(array, unidadMedida, UnidadBase){
                if(unidadMedida !== UnidadBase){
                    const valorUno = convertirBase(UnidadBase, unidadMedida, parseFloat(array[0]));
                    const valorDos = convertirBase(UnidadBase, unidadMedida, parseFloat(array[1]));
                    const valorTres = convertirBase(UnidadBase, unidadMedida, parseFloat(array[2]));
                    return [valorUno, valorDos, valorTres];
                }

                return [ parseFloat(array[0]), parseFloat(array[1]), parseFloat(array[2]) ]
            },

            convertirUnidadIde(array, unidadBase, unidadIde){
                if(unidadBase !== unidadIde){
                    const valorUno = convertirUnidad(unidadIde, unidadBase, array[0]);
                    const valorDos = convertirUnidad(unidadIde, unidadBase, array[1]);
                    const valorTres = convertirUnidad(unidadIde, unidadBase, array[2]);
                    return [valorUno, valorDos, valorTres];
                }

                return array;
            },

            calcularError(deriva, promedio){
                let arrayDeriva = [];
                deriva.map( numero => arrayDeriva.push(parseFloat(numero.ip.valor)) );
                const cercanos = encontrarCercanos(arrayDeriva, promedio);

                if(cercanos[0] === undefined || cercanos[1] === undefined) return 'Error';

                const x = promedio;
                const x0 = cercanos[0];
                const x1 = cercanos[1];

                const y0Busqueda = deriva.find( error => error.ip.valor == x0 );
                const y1Busqueda = deriva.find( error => error.ip.valor == x1 );

                const y0 = parseFloat(y0Busqueda.e_actual.valor);
                const y1 = parseFloat(y1Busqueda.e_actual.valor);

                const interpolacion = interpolar(x, x0, x1, y0, y1);
                return interpolacion.toFixed(5);
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
