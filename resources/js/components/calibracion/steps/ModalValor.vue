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
import convertirBaseInverso from "../../../functions/convertir-base-inverso.js";
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import calcularFormula from "../../../functions/formulas.js";
import convertirBase from "../../../functions/convertir-base.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import interpolar from "../../../functions/interpolar.js";
import encontrark from "../../../functions/encontrar-k.js";



    export default {
        props: ['valores', 'lastValue', 'formValores', 'valoresMedidas', 'incertidumbre', 'tableCert'],
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

            obtenerDatosCertificados(){
                return axios.get(this.rutas.valoresCertificado, {params: {valor_id: this.lastValue.id}})
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            actualizarValorResultados(resultado){
                return axios.put(this.rutas.valorResultadoUpdate, resultado)
                    .then(response => response.data)
            },

            eliminarIncertidumbres(valor_id){
                return axios.delete(this.rutas.valorIncertidumbreDelete, { data: {valor_id}} )
                    .then(res => res.data);
            },

            guardarIncertidumbres(incertidumbres){
                axios.post(this.rutas.valorIncertidumbreStore, incertidumbres)
                    .then(response => response.data);
            },

            actualizarIncerResult(incerResultado){
                axios.put(this.rutas.valorIncertidumbreResultadoUpdate, incerResultado)
                    .then(response => response.data)
            },

            actualizarCertificado(certificado){
                return axios.put(this.rutas.valorCertificadoUpdate, certificado)
                    .then(response => response.data);
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

                    let incertidumbres = await this.calcularIncertidumbre(resultados);
                    this.guardarIncertidumbres(incertidumbres);

                    let incertidumbreResult = await this.incertidumbreResultado(incertidumbres, resultados);
                    this.actualizarIncerResult(incertidumbreResult);

                    let certificado = await this.calcularCertificado(result, this.lastValue, incertidumbreResult);
                    let certificadoActualizado = this.actualizarCertificado(certificado);

                    if(certificado){

                    }


                }catch(error){
                    console.error(error);
                }
            },

            async calcularIncertidumbre(resultado)
            {
                const resolucion = await this.convertirResolucion(resultado.unidad);

                const valores = {
                    ip: resultado.ip,
                    sIEC: resultado.desv_iec,
                    sIP: resultado.desv_ip,
                    n: 3,
                    uk: resultado.uk,
                    patron: this.formValores[this.valores.global].patron,
                    r: resolucion,
                    unidad: resultado.unidad,
                    valor_id: resultado.valor_id
                };

                //elimina las incertidumbres viejas
                let eliminados = await this.eliminarIncertidumbres(resultado.valor_id);
                let incertidumbres = [];

                if(eliminados){
                    let modelo = this.incertidumbre.modelo.map(objeto => ({...objeto}));
                    incertidumbres = this.cargarIncertidumbre(modelo, valores);
                }

                return incertidumbres;
            },

            async finalizar()
            {
                let tableHistorial = await this.obtenerDatosHistorial();
                this.$emit('update:table-hist', tableHistorial);
                let valorCertificado = await this.obtenerDatosCertificados();
                this.tableCert.splice(this.valores.global, 1, valorCertificado);
                this.$emit('update:table-cert', this.tableCert);
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

            convertirResolucion(unidad){
                let resolucion = this.incertidumbre.resolucion;

                if(this.incertidumbre.medida_global !== this.incertidumbre.resolucion_medida){
                    resolucion = convertirBase(this.incertidumbre.resolucion_medida, parseFloat(resolucion));
                }

                if(unidad !== this.incertidumbre.medida_global){
                    resolucion = convertirUnidad(unidad, this.incertidumbre.medida_global, resolucion);
                }

                return resolucion;
            },

            cargarIncertidumbre(incertidumbres, valores){
                let incer = [];

                for (let incertidumbre of incertidumbres){
                    let u = calcularFormula(incertidumbre.formula, valores);
                    let u_du = u * incertidumbre.contribucion_du;
                    let g_libertad = incertidumbre.tipo == 'A' ? valores.n -1 : '∞';
                    let potencia = incertidumbre.tipo == 'A' ? Math.pow(u_du, 4) / g_libertad : 0;
                    let incertidumbre_id = incertidumbre.id;
                    let valor_id = valores.valor_id;

                    let data = {u, u_du, g_libertad, potencia, incertidumbre_id, valor_id};
                    incer.push(data);
                }

                return incer;
            },

            calcularCertificado(resultado, valores, incerResult){
                let medidaG = this.incertidumbre.medida_global;
                let unidadAconvertir = valores.iec_medida;
                let unidad = resultado.unidad;
                let k = incerResult.k;

                let ip = resultado.ip_corregido;
                let iec = resultado.iec;
                let e = resultado.error_iec;
                let valor_id = resultado.valor_id;
                let u = incerResult.incertidumbre_expandida;

                if(unidad !== medidaG){
                    ip = convertirUnidad(medidaG, unidad, ip);
                    iec = convertirUnidad(medidaG, unidad, iec);
                    e = convertirUnidad(medidaG, unidad, e);
                    u = convertirUnidad(medidaG, unidad, u);
                }

                if(unidadAconvertir !== medidaG){
                    const arrSub = unidadAconvertir.split('');
                    const diferencia = arrSub[0];

                    ip = convertirBaseInverso(diferencia, ip);
                    iec = convertirBaseInverso(diferencia, iec);
                    e = convertirBaseInverso(diferencia, e);
                    u = convertirBaseInverso(diferencia, u);
                }

                let data = {ip, iec, e, u, k, valor_id, unidad: unidadAconvertir};
                return data;
            },

            incertidumbreResultado(incertidumbres, resultados){
                let uDu = incertidumbres.reduce((total, incer) => { return total + (incer.u_du ** 2) }, 0);
                let incertidumbre_combinada = Math.sqrt(uDu);
                let potencia = incertidumbres.reduce((total, incer) => { return total + incer.potencia }, 0);
                let g_libertad_efectivos = Math.pow(incertidumbre_combinada, 4) / potencia;
                let k = encontrark(g_libertad_efectivos);
                let incertidumbre_expandida = incertidumbre_combinada * k;
                let ip = resultados.ip;
                let unidad = resultados.unidad;
                let patron = this.lastValue.patron;
                let valor_id = resultados.valor_id;

                let data = {incertidumbre_combinada, potencia, g_libertad_efectivos, k, incertidumbre_expandida, ip, unidad, patron, valor_id};
                return data;
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
