<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <div class="form-group row text-left">
                <label class="col-md-2 col-form-label">Documentos</label>
                <div class="col-md-10">
                    <a  v-if="datos.procedimiento.accredited_scope"
                        class="badge badge-info mr-5"
                        target="_blank"
                        :href="`${asset}media/docs/alcance-acreditado.pdf`">
                        Alcance Acreditado
                    </a>

                    <a  v-for="(documento, index) of documentos" :key="index"
                        class="badge badge-info mr-5"
                        target="_blank"
                        :href="documento.url">
                        {{documento.nombre }}
                    </a>
                </div>

            </div>

            <div class="form-group row text-left border-bottom border-primary pb-10">
                <label class="col-md-2 col-form-label">Observaciones Generales</label>
                <div class="col-md-10">
                    <textarea type="text" class="form-control" v-model="datos.general" disabled></textarea>
                </div>
            </div>

            <div class="row mt-12">
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

                    <input
                        type="number"
                        step="0.01"
                        class="form-control mr-3"
                        :id="`ip-valor-0-${indice}`"
                        v-model="valor.ip_valor[0]"
                        @blur="bloquear(`#ip-valor-0-${indice}`, {fila:indice, columna: 0, valor: 'ip-valor'})"
                        :disabled="valor.patron.trim() === '' || valor.ip_medida.trim() === '' || formulario.resultados.length != indice">

                    <input
                        type="number"
                        step="0.01"
                        class="form-control mr-3"
                        :id="`ip-valor-1-${indice}`"
                        @blur="bloquear(`#ip-valor-1-${indice}`, {fila:indice, columna: 1, valor: 'ip-valor'})"
                        v-model="valor.ip_valor[1]"
                        :disabled="valor.ip_valor[0] === '' || valor.iec_valor[0] === ''">

                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        :id="`ip-valor-2-${indice}`"
                        @blur="bloquear(`#ip-valor-2-${indice}`, {fila:indice, columna: 2, valor: 'ip-valor'})"
                        v-model="valor.ip_valor[2]"
                        :disabled="valor.ip_valor[1] === '' || valor.iec_valor[1] === ''">
                </div>

                <div class="col-md-5 d-flex">
                    <select class="form-control mr-3" v-model="valor.iec_medida" :id="`iec-medida-${indice}`"
                    :disabled="formulario.resultados.length != indice" @change="changeUMValor($event, indice, 'iec')" >
                        <option v-for="(iec, i) in selectIEC" :key="i">{{ iec }}</option>
                    </select>

                    <input
                        type="number"
                        step="0.01"
                        class="form-control mr-3"
                        :id="`iec-valor-0-${indice}`"
                        @blur="bloquear(`#iec-valor-0-${indice}`, {fila:indice, columna: 0, valor: 'iec-valor'})"
                        v-model="valor.iec_valor[0]"
                        :disabled="valor.ip_valor[0] === '' || valor.iec_medida === ''">

                    <input
                        type="number"
                        step="0.01" class="form-control mr-3"
                        :id="`iec-valor-1-${indice}`"
                        @blur="bloquear(`#iec-valor-1-${indice}`, {fila:indice, columna: 1, valor: 'iec-valor'})"
                        v-model="valor.iec_valor[1]"
                        :disabled="valor.ip_valor[1] === '' || valor.iec_valor[0] === ''">

                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        :id="`iec-valor-2-${indice}`"
                        @blur="calcularIP(indice)"
                        v-model="valor.iec_valor[2]"
                        :disabled="valor.ip_valor[2] === '' || valor.iec_valor[1] === ''">
                </div>
            </div>


            <div class="col-12 text center mt-6">
                <button type="button" @click="editar" class="btn btn-primary" v-if="Object.keys(registroEdit).length != 0">Editar Último</button>
                <hr>
            </div>

            <CertificadoTable :certificados="certificados" :redondeo="redondeo"  />

            <ResultadoTable :resultados="formulario.resultados" :redondeo="redondeo"  />

            <PresupuestoIncertidumbre
                :incertidumbres="formulario.incertidumbre"
                :resultados="formulario.incertidumbre_result"
            />

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
import encontrark from "../../../functions/encontrar-k.js";
import interpolar from "../../../functions/interpolar.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import convertirBase from "../../../functions/convertir-base.js";
import ResultadoTable from "../ResultadoTable";
import calcularFormula from "../../../functions/formulas.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import CertificadoTable from "../CertificadoTable";
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";
import convertirBaseInverso from "../../../functions/convertir-base-inverso.js";
import PresupuestoIncertidumbre from "../PresupuestoIncertidumbre";

    export default {
        components: { PresupuestoIncertidumbre, CertificadoTable, ResultadoTable },
        props: ['form', 'medida', 'datos', 'incertidumbres'],
        data() {
            return {
                asset: window.asset,
                certificados: [],
                documentos: [],
                formulario: {
                    valores_medidas: { ip_medida_general: '', iec_medida_general: this.form.unidad_medida },
                    valores: [
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', '']},
                    ],
                    resultados: [],
                    incertidumbre: [],
                    incertidumbre_result: []
                },
                medidaGlobal: this.form.unidad_medida,
                redondeo: 2,
                registroEdit: {},
                resol: this.form.resolucion,
                rutas: window.routes,
                selectIEC: [],
                selectIP: [],
                selectPatrones: [],
                subMultiplos: [],
                unidadMedidas: [],
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
            },
        },
        //------------------------------------------------------------------------------------


        methods: {
            async fetch(){
                this.selectPatrones = this.form.patrones[0].code;
                this.unidadMedidas = this.medida.unit_measurement;

                let resolution = String(this.form.resolucion);
                resolution = resolution.split('.');
                if(resolution.length === 2){
                    let redondeo = resolution[1].split('');
                    this.redondeo = redondeo.length+1;
                }

                //si existe un solo patron entonces autocompletar los patrones
                if(this.selectPatrones.length == 1) this.formulario.valores.forEach( valor => valor.patron = this.selectPatrones[0] );
                if(this.form.ip_medida) this.formulario.valores_medidas.ip_medida_general = this.form.ip_medida;

                this.getDocumentos(this.selectPatrones);

                const RESP = await axios.get(this.rutas.submultiplos);
                this.subMultiplos = await RESP.data;

                this.subMultiplos.forEach(multiplo =>{
                    let unidad = multiplo.simbolo === '-' ? this.medidaGlobal : multiplo.simbolo + this.medidaGlobal;
                    this.selectIEC.push(unidad);
                });

            },

            async calcularIP(indice)
            {
                if( this.formulario.valores[indice].iec_valor[2] === '' ){
                    this.alertaError('No puedes dejar un campo vacío!!');
                    return;
                }

                this.registroEdit = {fila: indice, columna: 2, valor: 'iec-valor'};

                // Buscamos la unidad de medida en el IDE
                const PATRON = this.formulario.valores[indice].patron;
                const ide = await this.ide(PATRON);

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
                const arrayValores = await this.convertirUnidadBase(this.formulario.valores[indice].ip_valor, unidadMedidaIP, unidadIPgeneral);
                const arrayEnIde = await this.convertirUnidadIde(arrayValores, unidadIPgeneral, unidadIde)

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
                if(cercanos[0] !== undefined && cercanos[1] !== undefined) uk = this.calcularInterpolacion(promedio, cercanos, rangosDeriva, false);


                //Guarda Valores en la BD
                const VALOR_ID = await this.guardarValores(indice);

                let result = {
                    valor_id: VALOR_ID,
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
                let resultados = await this.guardarValoresResultados(result);
                this.formulario.resultados.push(resultados);

                //Guarda las Incertidumbres en la BD
                let incertidumbres = await this.calcularIncertidumbre(result);
                this.formulario.incertidumbre.push(incertidumbres);

                let incertidumbre_result = await this.incertidumbreResultado(incertidumbres, indice);
                this.formulario.incertidumbre_result.push(incertidumbre_result);

                let certificado = await this.calcularCertificado(indice);
                this.certificados.push(certificado);

                $(`#iec-valor-2-${indice}`).attr('disabled', true);
                this.$swal.close();
            },

            calcularCertificado(indice){
                const unidadAconvertir = this.formulario.valores[0].iec_medida;
                const unidad = this.formulario.resultados[indice].unidad;
                const k = this.formulario.incertidumbre_result[indice].k;

                let ip = this.formulario.resultados[indice].ip_corregido;
                let iec = this.formulario.resultados[indice].iec;
                let e = this.formulario.resultados[indice].error_iec;
                let valor_id = this.formulario.resultados[indice].valor_id;
                let u = this.formulario.incertidumbre_result[indice].incertidumbre_expandida;

                if(unidad !== this.medidaGlobal){
                    ip = convertirUnidad(this.medidaGlobal, unidad, ip);
                    iec = convertirUnidad(this.medidaGlobal, unidad, iec);
                    e = convertirUnidad(this.medidaGlobal, unidad, e);
                    u = convertirUnidad(this.medidaGlobal, unidad, u);
                }

                if(unidadAconvertir !== this.medidaGlobal){
                    const arrSub = unidadAconvertir.split('');
                    const diferencia = arrSub[0];

                    ip = convertirBaseInverso(diferencia, ip);
                    iec = convertirBaseInverso(diferencia, iec);
                    e = convertirBaseInverso(diferencia, e);
                    u = convertirBaseInverso(diferencia, u);
                }

                let data = {ip, iec, e, u, k, valor_id, unidad: unidadAconvertir};

                return axios.post(this.rutas.valorCertificadoStore, data)
                    .then(response => response.data);
                //this.certificado.push();
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

            convertirResolucion(unidad){
                let resolucion = this.resol;

                if(this.medidaGlobal !== this.form.resolucion_medida){
                    resolucion = convertirBase(this.form.resolucion_medida, parseFloat(resolucion));
                }

                if(unidad !== this.medidaGlobal){
                    resolucion = convertirUnidad(unidad, this.medidaGlobal, resolucion);
                }

                return resolucion;
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

            async calcularIncertidumbre(resultado)
            {
                const resolucion = await this.convertirResolucion(resultado.unidad);

                const valores = {
                    ip: resultado.ip,
                    sIEC: resultado.desv_iec,
                    sIP: resultado.desv_ip,
                    n: 3,
                    uk: resultado.uk,
                    patron: resultado.patron,
                    r: resolucion,
                    unidad: resultado.unidad,
                    valor_id: resultado.valor_id
                };
                console.log({valores})

                const INCER_MODEL = this.incertidumbres.map(objeto => ({...objeto}));
                const INCERTIDUMBRES = await this.cargarIncertidumbre(INCER_MODEL, valores);

                let incer_result = [];
                for(let i = 0; i < INCER_MODEL.length; i++){
                    incer_result.push({...INCER_MODEL[i], ...INCERTIDUMBRES[i]});
                }

                return incer_result;
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

                return axios.post(this.rutas.valorIncertidumbreStore, incer)
                    .then(response => response.data);
            },

            incertidumbreResultado(incertidumbres, indice){
                let uDu = incertidumbres.reduce((total, incer) => { return total + (incer.u_du ** 2) }, 0);
                let incertidumbre_combinada = Math.sqrt(uDu);
                let potencia = incertidumbres.reduce((total, incer) => { return total + incer.potencia }, 0);
                let g_libertad_efectivos = Math.pow(incertidumbre_combinada, 4) / potencia;
                let k = encontrark(g_libertad_efectivos);
                let incertidumbre_expandida = incertidumbre_combinada * k;
                let ip = this.formulario.resultados[indice].ip;
                let unidad = this.formulario.resultados[indice].unidad;
                let patron = this.formulario.valores[indice].patron;
                let valor_id = incertidumbres[0].valor_id;

                let data = {incertidumbre_combinada, potencia, g_libertad_efectivos, k, incertidumbre_expandida, ip, unidad, patron, valor_id};
                return axios.post(this.rutas.valorIncertidumbreResultadoStore, data)
                    .then(response => response.data);

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

            async getDocumentos(patrones){
                try{
                    for (let patron of patrones){
                        const RES = await axios.get(this.rutas.manuales, {params: {'patron': patron}})
                        let documents = await RES.data.documents;

                        if(documents){
                            documents.forEach(documento => {
                                if(documento.category == 'MANUAL') this.documentos.push({paton: patron, url: documento.url, nombre: documento.name})
                            })
                        }
                    }
                }catch(error){
                    console.log(error);
                }
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

            bloquear(inputName, edit){
                if( $(inputName).val() === '' ){
                    this.alertaError('No puedes dejar un campo vacío!!');
                    return;
                }

               $(inputName).attr('disabled', true);
               this.registroEdit = edit;
            },

            editar(){
                console.log(this.registroEdit.fila+', '+this.registroEdit.columna+', '+this.registroEdit.valor);
                const fila = this.registroEdit.fila;
                const col = this.registroEdit.columna;
                const valor = this.registroEdit.valor;

                $(`#${valor}-${col}-${fila}`).attr('disabled', false);
                $(`#${valor}-${col}-${fila}`).select();

                if(valor === 'iec-valor' && col === 2){
                    this.formulario.resultados.pop();
                    this.formulario.incertidumbre.pop();
                    this.certificado.pop();
                }
            },

            siguiente() {
                this.submit();
                this.$emit('click-next')
            },

            submit(){
                if(this.form.ip_medida !== this.formulario.valores_medidas.ip_medida_general){
                    let formulario = {...this.form};
                    formulario.ip_medida = this.formulario.valores_medidas.ip_medida_general;
                    axios.put(`${this.rutas.index}/${formulario.id}`, formulario)
                        .then(response => { if(response.status === 200) this.$emit('update:form', formulario); });
                }
            },

            ide(patron){
                return axios.get(this.rutas.patronUmIde, {params: {'patron': patron}})
                    .then(response => response.data.ide);
            },

            guardarValores(indice){
                return axios.post(this.rutas.valorStore, this.formulario.valores[indice])
                    .then(response => response.data.id);
            },

            guardarValoresResultados(resultado){
                return axios.post(this.rutas.valorResultadoStore, resultado)
                    .then(response => response.data);
            },


        }

    }
</script>
