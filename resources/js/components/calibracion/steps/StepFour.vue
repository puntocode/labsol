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
                    <select class="form-control" v-model="valor.patron" :disabled="formulario.resultados.length != indice" :id="`patron-${indice}`">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.ip_medida" @change="changeUMValor($event, indice, 'ip')"
                    :id="`ip-medida-${indice}`" :disabled="formulario.resultados.length != indice">
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
                    :disabled="formulario.resultados.length != indice" @change="changeUMValor($event, indice, 'iec')" >
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

            <div class="row my-18">
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
                            <tr v-for="(resultado, index) in formulario.resultados" :key="index">
                                <td>{{ resultado.ip.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                                <td>{{ resultado.desvIP.toFixed(4) }} {{ resultado.unidad }}</td>
                                <td v-text="resultado.errorIP === 'Error'
                                    ? 'Error'
                                    : `${resultado.errorIP} ${resultado.unidad}`">
                                </td>
                                <td>{{ resultado.ipCorregido.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                                <td>{{ resultado.iec.toFixed(redondeo) }} {{ resultado.unidad }}</td>
                                <td>{{ resultado.desvIEC.toFixed(4) }} {{ resultado.unidad }}</td>
                                <td>{{ resultado.errorIEC.toFixed(redondeo) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <PresupuestoIncertidumbre :incertidumbres="formulario.incertidumbre" />

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
import calcularFormula from "../../../functions/formulas.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";
import PresupuestoIncertidumbre from "../PresupuestoIncertidumbre";

    export default {
        components: { PresupuestoIncertidumbre },
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
                    ],
                    resultados: [],
                    incertidumbre: [],
                },
                medidaGlobal: this.form.unidad_medida,
                redondeo: 2,
                rutas: window.routes,
                subMultiplos: [],
                selectPatrones: [],
                selectIEC: [],
                selectIP: [],
                unidadMedidas: [],
                incertidumbre_ebc: [],
                incertidumbre_patron: [],
            }
        },
        //------------------------------------------------------------------------------------

        mounted () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        computed: {
            disable(){
                return this.formulario.resultados.length !== this.formulario.valores.length;
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

                //selecciona las incertidumbre del procedimiento
                this.incertidumbre_ebc = [
                    {
                        contribucion: 'EBC',
                        nombre: 'Incertidumbre repetibilidad EBC',
                        tipo: 'A',
                        distribucion: 'normal',
                        formula: 'u_rep_ebc',
                        fuente: '𝑠',
                        divisor: '√3',
                        contribucion_u:  0,
                        coeficiente: 1,
                        contribucion_du: 1,
                        u_du: 0,
                        grados_libertad_for: 'n-1',
                        grados_libertad: 0
                    },
                    {
                        contribucion: 'EBC',
                        nombre: 'Incertidumbre resolución EBC',
                        tipo: 'B',
                        distribucion: 'rectangular',
                        formula: 'u_res_ebc',
                        fuente: '𝑟/2',
                        divisor: '√3',
                        contribucion_u:  0,
                        coeficiente: 1,
                        contribucion_du: 1,
                        u_du: 0,
                        grados_libertad_for: '∞',
                        grados_libertad: '∞'
                    },
                ];
                this. incertidumbre_patron = [
                    {
                        contribucion: 'PATRON',
                        nombre: 'Incertidumbre patrón',
                        tipo: 'B',
                        distribucion: 'normal',
                        formula: 'p_inc_p',
                        fuente: 'U',
                        divisor: 'k',
                        contribucion_u:  0,
                        coeficiente: 1,
                        contribucion_du: 1,
                        u_du: 0,
                        grados_libertad_for: '∞',
                        grados_libertad: '∞'
                    },
                    {
                        contribucion: 'PATRON',
                        nombre: 'Incertidumbre resolución EBC',
                        tipo: 'B',
                        distribucion: 'rectangular',
                        formula: 'p_inc_res',
                        fuente: '𝑟/2',
                        divisor: '√3',
                        contribucion_u:  0,
                        coeficiente: 1,
                        contribucion_du: 1,
                        u_du: 0,
                        grados_libertad_for: '∞',
                        grados_libertad: '∞'
                    },
                    {
                        contribucion: 'PATRON',
                        nombre: 'Incertidumbre repetibilidad patrón',
                        tipo: 'A',
                        distribucion: 'normal',
                        formula: 'p_inc_rep',
                        fuente: '𝑠',
                        divisor: '√3',
                        contribucion_u:  0,
                        coeficiente: 1,
                        contribucion_du: 1,
                        u_du: 0,
                        grados_libertad_for: 'n-1',
                        grados_libertad: 0
                    },
                ];
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
                let errorIp = null;

                //array con la columna deriva para encontrar Error Patron
                const arrayDeriva = rangosDeriva.map( numero => numero.ip.valor);
                const cercanos = encontrarCercanos(arrayDeriva, promedio);

                if(cercanos[0] === undefined || cercanos[1] === undefined) errorIp = 'Error';
                else errorIp = this.calcularInterpolacion(promedio, cercanos, rangosDeriva);

                //Calculo IP corregido
                let ipCorregido = promedio;
                if(errorIp !== 'Error') ipCorregido += parseFloat(errorIp);


                //Calculo IEC
                const unidadIECgeneral = this.formulario.valores_medidas.iec_medida_general;
                const unidadMedidaIEC = this.formulario.valores[indice].iec_medida;
                const arrayValoresIEC = this.convertirUnidadBase(this.formulario.valores[indice].iec_valor, unidadMedidaIEC, unidadIECgeneral);
                const arrayEnIdeIEC = this.convertirUnidadIde(arrayValoresIEC, unidadIECgeneral, unidadIde)
                const promedioIEC = (arrayEnIdeIEC.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                const desviacionIEC = calcularDes(arrayEnIdeIEC);
                const errorIec = promedioIEC - ipCorregido;

                let uk = 0
                if(cercanos[0] != undefined || cercanos[1] != undefined) uk = this.calcularInterpolacion(promedio, cercanos, rangosDeriva, false);

                const result = {
                    patron: patron,
                    ip: promedio,
                    desvIP: desviacion,
                    errorIP: errorIp,
                    ipCorregido: ipCorregido,
                    iec: promedioIEC,
                    desvIEC: desviacionIEC,
                    errorIEC: errorIec,
                    unidad: unidadIde,
                    uk: parseFloat(uk),
                }
                this.formulario.resultados.push(result);
                this.calcularIncertidumbre(result);


                $(`#iec-valor-2-${indice}`).attr('disabled', true);
                this.$swal.close();
            },

            calcularIncertidumbre(resultado){
                const ebc = this.incertidumbre_ebc;
                const patron = this.incertidumbre_patron;
                let resolucion = convertirBase(this.formulario.resolucion_medida, parseFloat(this.formulario.resolucion));
                resolucion = convertirUnidad(resultado.unidad, this.formulario.unidad_medida, resolucion);

                const valores = {
                    ip: resultado.ip,
                    sIEC: resultado.desvIEC,
                    sIP: resultado.desvIP,
                    n: 3,
                    uk: resultado.uk,
                    patron: resultado.patron,
                    r: resolucion,
                    unidad: resultado.unidad
                };
                console.log({valores})

                this.cargarIncertidumbre(ebc, valores);
                this.cargarIncertidumbre(patron, valores);

                this.formulario.incertidumbre.push( {incertidumbre_ebc: ebc, incertidumbre_patron: patron, valores} )
            },


            convertirUnidadBase(array, unidadMedida, UnidadBase){
                if(unidadMedida !== UnidadBase){
                    const valorUno = convertirBase(unidadMedida, parseFloat(array[0]));
                    const valorDos = convertirBase(unidadMedida, parseFloat(array[1]));
                    const valorTres = convertirBase(unidadMedida, parseFloat(array[2]));
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

            calcularInterpolacion(promedio, cercanos, deriva, buscarError = true){
                const x = promedio;
                const x0 = cercanos[0];
                const x1 = cercanos[1];
                const y0Busqueda = deriva.find( der => der.ip.valor == x0 );
                const y1Busqueda = deriva.find( der => der.ip.valor == x1 );
                let y0 = 0;
                let y1 = 0;

                if(buscarError){
                    y0 = parseFloat(y0Busqueda.e_actual.valor);
                    y1 = parseFloat(y1Busqueda.e_actual.valor);
                }else{
                    y0 = parseFloat(y0Busqueda.uc.valor);
                    y1 = parseFloat(y1Busqueda.uc.valor);
                }

                const interpolacion = interpolar(x, x0, x1, y0, y1);
                return interpolacion.toFixed(5);
            },

            cargarIncertidumbre(array, valores){
              array.forEach( incer => {
                    const u = calcularFormula(incer.formula, valores);
                    const uDu = u * incer.contribucion_du;
                    const gLibertad = incer.tipo == 'A' ? valores.n -1 : '∞';
                    const potencia = incer.tipo == 'A' ? Math.pow(uDu, 4) / gLibertad : 0;

                    incer.contribucion_u = u.toExponential(2);
                    incer.u_du =  uDu.toExponential(2);
                    incer.grados_libertad = gLibertad;
                    incer.potenciado = potencia === 0 ? 0 : potencia.toExponential(2);
                });
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
                this.$emit('update:form', this.formulario);
            },

        }


    }
</script>

<style lang="scss" scoped>

</style>
