<template>
    <div class="modal fade" id="valorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Editar Valor</h5>
                </div>

                <form class="mb-5" autocomplete="off" @submit.prevent="editar">
                    <div class="modal-body">
                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Anterior</label>
                                <input type="number" v-model="valores.anterior" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">Valor Nuevo</label>
                                <input type="number" v-model="nuevo" class="form-control" step="0.01">
                            </div>
                        </div>

                        <div class="mb-6 row">
                            <div class="mx-auto col-10">
                                <label for="date">PIN</label>
                                <input type="password" v-model="pin" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="border-0 modal-footer justify-content-center pt-0">
                        <button id="btn-cancel" type="button" class="btn btn-light-secondatry text-secondary font-weight-bold" data-dismiss="modal" @click="cancelar" v-show="!spin">Cancelar</button>
                        <button type="submit" class="btn btn-primary" :disabled="desactivado" title="Completa todos los campos requeridos">
                            <i v-if="spin" class="fas fa-spinner fa-spin"></i>
                            <span v-else>Editar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import convertirBase from "../../../functions/convertir-base.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import interpolar from "../../../functions/interpolar.js";


    export default {
        props: ['valores', 'lastValue', 'formValores', 'valoresMedidas',],
        data() {
            return {
                spin: false,
                nuevo: '',
                pin: '',
                pinUser: '1234',
                rutas: window.routesEdit,
            }
        },

        methods: {
            //axios -------------------------------------------------------------------------
            guardarHistorico(){
                return axios.post(this.rutas.guardarHistorico, this.lastValue)
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            actualizarValor(data){
                let id = this.lastValue.id;
                data.valor_id = id
                return axios.put(`${this.rutas.valorIndex}/${id}`, data)
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            obtenerDatosHistorial(){
                return axios.get(this.rutas.valoresHistorial, {params: {calibracion_id: this.lastValue.calibracion_id}})
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            actualizarValorResultados(resultado){
                return axios.put(`${this.rutas.valorResultadoIndex}/${this.lastValue.resultados.id}`, resultado)
                    .then(response => response.data)
            },

            //async -------------------------------------------------------------------------
            async editar() {
                try{
                    this.spin = true;
                    let hist = await this.guardarHistorico();

                    if(hist){
                        if(this.valores.tipo === 'ip_valor') hist.ip_valor[this.valores.indice] = this.nuevo;
                        else hist.iec_valor[this.valores.indice] = this.nuevo;

                        let valorRes = await this.actualizarValor(hist);
                        this.actualizarForm();
                        let resultado = await this.calcularNuevoResultado();
                    }

                    this.finalizar();
                }catch(error){
                    console.error(error);
                }

            },

            async calcularNuevoResultado(){
                try{
                    let value = this.formValores[this.valores.global];

                    const PATRON = value.patron;
                    const IDE = await axios.get(this.rutas.patronUmIde, {params: {'patron': PATRON}});
                    let ides = await IDE.data.ide;

                    //Unidades de medida
                    let unidadIde = ides[0].unit_measurement;
                    let rangosDeriva = ides[0].rangos[0].rango_derivas;
                    let unidadIPgeneral = this.valoresMedidas.ip_medida_general;
                    let unidadMedidaIP = value.ip_medida;

                    //Array de valores convertidos a unidad Base
                    let arrayValores = await this.convertirUnidadBase(value.ip_valor, unidadMedidaIP, unidadIPgeneral);
                    let arrayEnIde = await this.convertirUnidadIde(arrayValores, unidadIPgeneral, unidadIde);


                    //Calculo IP
                    let promedio = (arrayEnIde.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                    let desviacion = calcularDes(arrayEnIde);
                    let errorIp = null;

                    //array con la columna deriva para encontrar Error Patron
                    let arrayDeriva = rangosDeriva.map( numero => numero.ip.valor);
                    let cercanos = encontrarCercanos(arrayDeriva, promedio);
                    console.log(`cercanos: ${cercanos}`);

                    if(!cercanos[0] || !cercanos[1]){
                        //this.errorLimpiar(indice, 'No se encuentra el rango en el IDE');
                        return
                    }else{
                        errorIp = this.calcularInterpolacion(promedio, cercanos, rangosDeriva);
                    }

                    //Calculo IP corregido
                    let ipCorregido = promedio;
                    if(errorIp !== null) ipCorregido += parseFloat(errorIp);

                    //Calculo IEC
                    let unidadIECgeneral = this.valoresMedidas.iec_medida_general;
                    let unidadMedidaIEC = value.iec_medida;
                    let arrayValoresIEC = this.convertirUnidadBase(value.iec_valor, unidadMedidaIEC, unidadIECgeneral);
                    let arrayEnIdeIEC = this.convertirUnidadIde(arrayValoresIEC, unidadIECgeneral, unidadIde)
                    let promedioIEC = (arrayEnIdeIEC.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                    let desviacionIEC = calcularDes(arrayEnIdeIEC);
                    let errorIec = promedioIEC - ipCorregido;

                    let uk = 0
                    if(cercanos[0] !== undefined && cercanos[1] !== undefined) uk = this.calcularInterpolacion(promedio, cercanos, rangosDeriva, false);

                    let result = {
                        valor_id: this.lastValue.id,
                        desv_ip: desviacion,
                        desv_iec: desviacionIEC,
                        error_iec: errorIec,
                        error_ip: errorIp,
                        patron: PATRON,
                        iec: promedioIEC,
                        ip: promedio,
                        ip_corregido: ipCorregido,
                        unidad: unidadIde,
                        uk: parseFloat(uk),
                    }

                    let resultados = await this.actualizarValorResultados(result);
                    console.log(resultados);

                    //Guarda Valores en la BD
                    // const VALOR_ID = await this.guardarValores(indice);
                    // this.valorTemp = {valorId: VALOR_ID, index: indice};


                }catch(error){

                }


            },

            async finalizar()
            {
                let tableHistorial = await this.obtenerDatosHistorial();
                this.$emit('update:table-hist', tableHistorial);
                this.spin = false;
                document.getElementById("btn-cancel").click();
            },


            //metodos -------------------------------------------------------------------------
            actualizarForm(){
                if(this.valores.tipo === 'ip_valor'){
                    this.formValores[this.valores.global].ip_valor[this.valores.indice] = this.nuevo;
                } else{
                    this.formValores[this.valores.global].iec_valor[this.valores.indice] = this.nuevo;
                }

            },

            convertirUnidadBase(array, unidadMedida, UnidadBase){
                if(unidadMedida !== UnidadBase){
                    const valorUno = convertirBase(unidadMedida, parseFloat(array[0]));
                    const valorDos = convertirBase(unidadMedida, parseFloat(array[1]));
                    const valorTres = convertirBase(unidadMedida, parseFloat(array[2]));
                    return [valorUno, valorDos, valorTres];
                }

                return [ parseFloat(array[0]), parseFloat(array[1]), parseFloat(array[2]) ];
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
                return interpolacion;
            },

            cancelar(){
                this.nuevo = '';
            },
        },

        computed: {
            desactivado() {
                return this.nuevo == '' || (this.pin != this.pinUser) || this.spin;
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
