<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <ModalValor
                :valores="valorEdit"
                :last-value="valorLastEdit"
                :valores-medidas="formulario.valores_medidas"
                :incertidumbre="{resolucion: this.resol, medida_global: this.medidaGlobal, resolucion_medida: this.form.resolucion_medida, modelo: incertidumbres}"
                :form-valores.sync="formulario.valores"
                :table-hist.sync="tableHistorial"
                :table-cert.sync="certificados"
            />


            <!-------------------------------- Documentos ------------------------------------------------------------------------------------------------>
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

            <!-------------------------------- Formulario ------------------------------------------------------------------------------------------------>
            <div class="row mt-4" v-for="(valor, indice) in formulario.valores" :key="indice">
                <div class="col-md-2">
                    <select
                        class="form-control"
                        v-model="valor.patron"
                        :disabled="formulario.resultados.length != indice || valor.id > 0"
                        :id="`patron-${indice}`">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>
                </div>

                <!-------------------------------- Input IP --------------------------------------------------->
                <div class="col-md-5 d-flex">
                    <select
                        class="form-control mr-3"
                        v-model="valor.ip_medida"
                        @change="changeUMValor($event, indice, 'ip')"
                        :id="`ip-medida-${indice}`"
                        :disabled="formulario.resultados.length != indice || valor.id > 0">
                        <option v-for="(ip, i) in selectIP" :key="i">{{ ip }}</option>
                    </select>

                    <div class="input-icons">
                        <EditValor
                            v-if="valor.ip_valor[0].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="0"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="ip_valor"
                        />
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            :id="`ip-valor-0-${indice}`"
                            v-model="valor.ip_valor[0]"
                            @blur="bloquear(`#ip-valor-0-${indice}`, {fila:indice, columna: 0, valor: 'ip-valor'})"
                            :disabled="valor.patron.trim() === '' || valor.ip_medida.trim() === '' || formulario.resultados.length != indice || valor.id > 0">
                    </div>

                    <div class="input-icons">
                       <EditValor
                            v-if="valor.ip_valor[1].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="1"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="ip_valor"
                        />
                        <input
                            type="number"
                            step="0.01"
                            class="form-control mr-3"
                            :id="`ip-valor-1-${indice}`"
                            @blur="bloquear(`#ip-valor-1-${indice}`, {fila:indice, columna: 1, valor: 'ip-valor'})"
                            v-model="valor.ip_valor[1]"
                            :disabled="valor.ip_valor[0] === '' || valor.iec_valor[0] === '' || valor.id > 0">
                    </div>

                    <div class="input-icons">
                        <EditValor
                            v-if="valor.ip_valor[2].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="2"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="ip_valor"
                        />
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            :id="`ip-valor-2-${indice}`"
                            @blur="bloquear(`#ip-valor-2-${indice}`, {fila:indice, columna: 2, valor: 'ip-valor'})"
                            v-model="valor.ip_valor[2]"
                            :disabled="valor.ip_valor[1] === '' || valor.iec_valor[1] === '' || valor.id > 0">
                    </div>
                </div>

                <!-------------------------------- Input IEC -------------------------------------------------->
                <div class="col-md-5 d-flex">
                    <select
                        class="form-control mr-3"
                        v-model="valor.iec_medida"
                        :id="`iec-medida-${indice}`"
                        :disabled="formulario.resultados.length != indice || valor.id > 0"
                        @change="changeUMValor($event, indice, 'iec')" >
                        <option v-for="(iec, i) in selectIEC" :key="i">{{ iec }}</option>
                    </select>

                    <div class="input-icons">
                        <EditValor
                            v-if="valor.iec_valor[0].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="0"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="iec_valor"
                        />
                        <input
                            type="number"
                            step="0.01"
                            class="form-control mr-3"
                            :id="`iec-valor-0-${indice}`"
                            @blur="bloquear(`#iec-valor-0-${indice}`, {fila:indice, columna: 0, valor: 'iec-valor'})"
                            v-model="valor.iec_valor[0]"
                            :disabled="valor.ip_valor[0] === '' || valor.iec_medida === '' || valor.id > 0">
                    </div>

                    <div class="input-icons">
                        <EditValor
                            v-if="valor.iec_valor[1].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="1"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="iec_valor"
                        />
                        <input
                            type="number"
                            step="0.01" class="form-control mr-3"
                            :id="`iec-valor-1-${indice}`"
                            @blur="bloquear(`#iec-valor-1-${indice}`, {fila:indice, columna: 1, valor: 'iec-valor'})"
                            v-model="valor.iec_valor[1]"
                            :disabled="valor.ip_valor[1] === '' || valor.iec_valor[0] === '' || valor.id > 0">
                    </div>

                    <div class="input-icons">
                        <EditValor
                            v-if="valor.iec_valor[2].trim() !== '' && valor.id != 0"
                            :valor="valor"
                            :index="2"
                            :global="indice"
                            :valor-edit.sync="valorEdit"
                            :last-edit.sync="valorLastEdit"
                            tipo="iec_valor"
                        />
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            :id="`iec-valor-2-${indice}`"
                            @blur="calcularIP(indice)"
                            v-model="valor.iec_valor[2]"
                            :disabled="valor.ip_valor[2] === '' || valor.iec_valor[1] === '' || valor.id > 0">
                    </div>
                </div>
            </div>

            <HistorialValores :calibracion_id="form.id" :table-historial="tableHistorial" />

            <CertificadoTable :certificados="certificados" :redondeo="redondeo"  />

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
import EditValor from "./EditValor";
import ModalValor from "./ModalValor";
import encontrark from "../../../functions/encontrar-k.js";
import interpolar from "../../../functions/interpolar.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import convertirBase from "../../../functions/convertir-base.js";
import calcularFormula from "../../../functions/formulas.js";
import convertirUnidad from "../../../functions/convertir-unidad.js";
import CertificadoTable from "../CertificadoTable";
import HistorialValores from "../HistorialValores";
import encontrarCercanos from "../../../functions/encontrar-cercanos.js";
import convertirBaseInverso from "../../../functions/convertir-base-inverso.js";

    export default {
        components: { CertificadoTable, HistorialValores, EditValor, ModalValor },
        props: ['form', 'medida', 'datos', 'incertidumbres'],
        data() {
            return {
                asset: window.asset,
                certificados: [],
                documentos: [],
                formulario: {
                    valores_medidas: { ip_medida_general: '', iec_medida_general: this.form.unidad_medida },
                    valores: [
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', ''], id:0 },
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', ''], id:0 },
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', ''], id:0 },
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', ''], id:0 },
                        {calibracion_id: this.form.id, patron: '', ip_medida: '', ip_valor: ['', '', ''], iec_medida: '', iec_valor: ['', '', ''], id:0 },
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
                valorTemp: {valorId:0, index: undefined},
                valorEdit: { anterior: '', indice: '', tipo: '', global: 0 },
                valorLastEdit: [],
                tableHistorial: [],
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

                if(this.form.valores.length) this.cargarValoresDeBD();
            },

            async calcularIP(indice)
            {
                try{
                    if( this.formulario.valores[indice].iec_valor[2] === '' ){
                        this.alertaError('No puedes dejar un campo vacío!!');
                        return;
                    }

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

                    if(cercanos[0] === undefined || cercanos[1] === undefined){
                        this.errorLimpiar(indice, 'No se encuentra el rango en el IDE');
                        return
                    }else{
                        errorIp = this.calcularInterpolacion(promedio, cercanos, rangosDeriva);
                    }

                    //Calculo IP corregido
                    let ipCorregido = promedio;
                    if(errorIp !== null) ipCorregido += parseFloat(errorIp);


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
                    this.valorTemp = {valorId: VALOR_ID, index: indice};

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

                }catch(error){
                    console.warn(error)
                    if(this.valorTemp.valorId > 0 ) axios.delete(`${this.rutas.valorIndex}/${this.valorTemp.valorId}`)
                    if(this.valorTemp.index !== undefined ) this.errorInsertar();
                    this.errorLimpiar(indice)
                }
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

            async submit(){
                try{
                    let formulario = {...this.form};
                    formulario.ip_medida = this.formulario.valores_medidas.ip_medida_general;

                    //entra la primera vez
                    if(!this.form.ip_medida && this.formulario.valores_medidas.ip_medida_general !== ''){
                        console.log('Entra primera vez');
                        let res = await axios.put(`${this.rutas.index}/${formulario.id}`, formulario);
                        let datos = await res.data;
                        return;
                    }

                    //si se cambia de valores
                    if(this.form.ip_medida !== this.formulario.valores_medidas.ip_medida_general){
                        console.log('Se cambia de valores');
                        let res = await axios.put(this.rutas.updateHistorico, formulario);
                        let datos = await res.data;
                    }

                }catch(error){
                    console.error(error);
                }
            },

            ide(patron){
                return axios.get(this.rutas.patronUmIde, {params: {'patron': patron}})
                    .then(response => response.data.ide);
            },

            guardarValores(indice){
                return axios.post(this.rutas.valorStore, this.formulario.valores[indice])
                    .then(response => this.formulario.valores[indice].id = response.data.id);
            },

            guardarValoresResultados(resultado){
                return axios.post(this.rutas.valorResultadoStore, resultado)
                    .then(response => response.data)
            },

            cargarValoresDeBD(){
                let indice = this.form.valores.length;
                for(let i = 0; i < this.form.valores.length; i++){
                    this.formulario.valores[i] = this.form.valores[i];
                    this.formulario.resultados.push(this.form.valores[i].resultados);
                    this.certificados.push(this.form.valores[i].certificados);
                    this.formulario.incertidumbre_result.push(['uno'])
                    this.formulario.incertidumbre.push(['incertidumbre'])
                }

                document.getElementById(`ip-valor-0-${indice}`).disabled = false;
                document.getElementById(`patron-${indice}`).disabled = false;
                document.getElementById(`ip-medida-${indice}`).disabled = false;
                document.getElementById(`iec-medida-${indice}`).disabled = false;
            },

            errorInsertar()
            {
                if(this.formulario.resultados.length){
                    let resultado = this.formulario.resultados.some(result => result.valor_id == this.valorTemp.valorId);
                    if(resultado) this.formulario.resultados.pop();
                }

                if(this.formulario.incertidumbre.length == (this.valorTemp.index+1) ){
                    let incertidumbre = this.formulario.incertidumbre[this.valorTemp.index].some(result => result.valor_id == this.valorTemp.valorId);
                    if(incertidumbre) this.formulario.incertidumbre.pop();
                }

                if(this.formulario.incertidumbre_result.length == (this.valorTemp.index+1) ){
                    let incerResult = this.formulario.incertidumbre_result.some(result => result.valor_id == this.valorTemp.valorId);
                    if(incerResult) this.formulario.incertidumbre.pop();
                }
            },

            errorLimpiar(indice, mensaje = 'Ocurrió un error. Por favor verifica los datos!')
            {
                this.formulario.valores[indice].iec_valor = ['', '', ''];
                this.formulario.valores[indice].ip_valor = ['', '', ''];

                $(`#ip-valor-0-${indice}`).attr('disabled', false);
                this.alertaError(mensaje);
                this.valorTemp = {valorId: 0, index: undefined}
            }

        }

    }
</script>


<style lang="scss" scoped>
    .input-icons { width: 100%; margin-right: 6px;
        i { position: absolute; }
    }
</style>
