<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <ModalValor
                :valores="valorEdit"
                :valorIp.sync="formulario.valores[valorEdit.fila].ip_valor[valorEdit.columna]"
                :valorIec.sync="formulario.valores[valorEdit.fila].iec_valor[valorEdit.columna]"
                :calibracion_id="form.id"
                @editarCal="editar"
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
                    <div class="card w-100">
                        <div class="card-body p-4" v-html="datos.general"></div>
                    </div>
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
                            v-if="valor.ip_valor[0]"
                            :valor="valor"
                            :columna="0"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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
                            v-if="valor.ip_valor[1]"
                            :valor="valor"
                            :columna="1"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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
                            v-if="valor.ip_valor[2].trim()"
                            :valor="valor"
                            :columna="2"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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
                            v-if="valor.iec_valor[0]"
                            :valor="valor"
                            :columna="0"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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
                            v-if="valor.iec_valor[1]"
                            :valor="valor"
                            :columna="1"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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
                            v-if="valor.id != 0"
                            :valor="valor"
                            :columna="2"
                            :fila="indice"
                            :valor_id="valor.id"
                            :valor-edit.sync="valorEdit"
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

            <HistorialValores :calibracion_id="form.id" :historials.sync="tableHistorial" />

            <CertificadoTable :certificados="certificados" :redondeo="redondeo"  />

            <div class="d-flex justify-content-between mt-12">
                <button
                    type="button"
                    class="btn btn-secondary"
                    @click="atras">Atrás
                </button>

                <button type="button"
                    :disabled="disable"
                    class="btn btn-primary"
                    title="Por favor completa todos los campos para continuar"
                    @click="siguiente">Siguiente
                </button>
            </div>
        </div>

    </fieldset>
</template>

<script>
import EditValor from "./EditValor";
import ModalValor from "./ModalValor";
import encontrark from "../../../functions/encontrar-k.js";
import interpolar from "../../../functions/interpolar.js";
import calcularDes from "../../../functions/calcular-desviacion.js";
import calcularCMC from "../../../functions/calcular-cmc.js";
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
                valorEdit: { anteriores: '', fila: 0, columna: 0, tipo: '' },
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
            async fetch()
            {
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

            cargarValoresDeBD(){
                let indice = this.form.valores.length;
                for(let i = 0; i < this.form.valores.length; i++){
                    this.formulario.valores[i] = this.form.valores[i];
                    this.formulario.resultados.push(this.form.valores[i].resultados);
                    this.certificados.push(this.form.valores[i].certificados);
                    // this.formulario.incertidumbre_result.push(['uno']);
                    // this.formulario.incertidumbre.push(['incertidumbre']);
                }

                document.getElementById(`ip-valor-0-${indice}`).disabled = false;
                document.getElementById(`patron-${indice}`).disabled = false;
                document.getElementById(`ip-medida-${indice}`).disabled = false;
                document.getElementById(`iec-medida-${indice}`).disabled = false;
            },


            //Calculos para la BD -----------------------------------------------------------------
            async calcularIP(indice)
            {
                try{
                    if( this.formulario.valores[indice].iec_valor[2] === '' ) throw new Error('No puedes dejar campos vacíos');

                    // Buscamos la unidad de medida en el IDE
                    const PATRON = this.formulario.valores[indice].patron;
                    const ide = await this.getIde(PATRON);

                    if(!ide.length){
                        this.formulario.valores[indice].iec_valor[2] = '';
                        throw new Error('Por favor carga el IDE del patron seleccionado!');
                    }

                    //Errores en el CMC
                    if(!this.datos.cmcs) throw new Error('Por favor carga los CMC!');
                    const existeCmc = this.datos.cmcs.some(cmc => cmc.patron_code == PATRON);
                    if(!existeCmc){
                        // this.errorLimpiar(indice);
                        throw new Error(`No existe cmc para ese Patron: ${PATRON}`);
                    }


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

                    console.log(cercanos)

                    if(cercanos[0] === undefined || cercanos[1] === undefined){
                        // this.errorLimpiar(indice);
                        throw new Error('Datos no se encuentran en los rangos del IDE!');
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

                    let resul = {
                        valor_id: this.formulario.valores[indice].id,
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

                    await this.calculosBD(resul, indice);

                }catch(error){
                    console.error(error);
                    this.alertaError(error.message)
                }
            },

            async calculosBD(resultados, indice){
                try{
                    const valors = this.formulario.valores[indice];
                    const valor_resultados = resultados;
                    const valor_incertidumbres = await this.calcularIncertidumbre(valor_resultados);

                    const valor_incertidumbres_resultados = await this.incertidumbreResultado(valor_incertidumbres, valor_resultados, valors.patron);
                    if(!valor_incertidumbres_resultados) throw new Error('El punto de calibración no corresponde al CMC, por lo tanto, no está acreditado!');

                    const valor_certificados = await this.calcularCertificado(valor_resultados, valors, valor_incertidumbres_resultados);

                    const valores = {valors, valor_resultados, valor_incertidumbres, valor_incertidumbres_resultados, valor_certificados}

                    if(valor_resultados.valor_id === 0) await this.insertarValors(indice, valores);
                    else this.updateValors(indice, valores);
                }catch(err){
                    console.error(err);
                    this.alertaError('Error en los datos');
                }
            },

            async insertarValors(index, valores){
                try{
                    this.alertaCalculando();
                    console.log(valores)

                    //insertamos en valors y esperamos el id
                    const valor_id = await this.guardarValores(index);
                    valores.valor_resultados.valor_id = valor_id;
                    valores.valor_incertidumbres_resultados.valor_id = valor_id;
                    valores.valor_certificados.valor_id = valor_id;

                    await this.guardarValoresResultados(valores.valor_resultados);
                    await this.guardarIncertidumbres(valores.valor_incertidumbres, valor_id);
                    await this.guardarIncertidumbreResultados(valores.valor_incertidumbres_resultados);
                    await this.guardarValorCertificados(valores.valor_certificados);

                    this.formulario.valores[index].id = valor_id;
                    this.formulario.resultados.push(valores.valor_resultados);
                    this.certificados.push(valores.valor_certificados);
                    document.getElementById(`iec-valor-2-${index}`).disabled = true;
                    this.$swal.close();

                }catch(err){
                    this.errorLimpiar(index);
                    this.alertaError(err.message);
                }
            },

            async updateValors(index, valores){
                try{
                    //actulizar la tabla valors, resultados incer, certificado
                    this.alertaCalculando();
                    console.log(valores)

                    valores.valor_resultados.valor_id = valores.valors.id;
                    valores.valor_incertidumbres_resultados.valor_id = valores.valors.id;
                    valores.valor_certificados.valor_id = valores.valors.id;

                    await this.actualizarValors(valores.valors);
                    await this.actualizarValorsResultado(valores.valor_resultados);
                    await this.actualizarValorsIncerResult(valores.valor_incertidumbres_resultados);
                    await this.actualizarValorsCertificado(valores.valor_certificados);
                    await this.eliminarIncertidumbres(valores.valors.id);
                    await this.guardarIncertidumbres(valores.valor_incertidumbres, valores.valors.id);

                    this.formulario.resultados.splice(index, 1, valores.valor_resultados);
                    this.certificados.splice(index, 1, valores.valor_certificados);

                    this.$swal.close();
                }catch(err){
                    console.log(err);

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
                    patron: resultado.patron,
                    r: resolucion,
                    unidad: resultado.unidad,
                };

                const modelo = this.incertidumbres.map(objeto => ({...objeto}));
                const incertidumbres = this.cargarIncertidumbre(modelo, valores);

                return incertidumbres;
            },

            async incertidumbreResultado(incertidumbres, resultados, patron){
                try{
                    let uDu = incertidumbres.reduce((total, incer) => { return total + (incer.u_du ** 2) }, 0);
                    let incertidumbre_combinada = Math.sqrt(uDu);
                    let potencia = incertidumbres.reduce((total, incer) => { return total + incer.potencia }, 0);

                    let g_libertad_efectivos = Math.pow(incertidumbre_combinada, 4) / potencia;

                    let k = 2;
                    if(g_libertad_efectivos !== Infinity) k = encontrark(g_libertad_efectivos);
                    else g_libertad_efectivos = 0;

                    let incertidumbre_expandida = incertidumbre_combinada * k;
                    let ip = resultados.ip;
                    let unidad = resultados.unidad;

                    console.log({ip, unidad});
                    console.log({incertidumbre_combinada});

                    //comparamos uc con cmc
                    const cmcs = this.datos.cmcs.filter(cmc => cmc.patron_code == patron);
                    const cmcDesdeHasta = await calcularCMC(ip, unidad, cmcs);
                    if(!cmcDesdeHasta) throw new Error('Error al calcular el cmc');
                    let cmc = cmcDesdeHasta.cmc;
                    console.log('rango: ', cmcDesdeHasta);
                    if(unidad !== cmcDesdeHasta.unidad) cmc = convertirUnidad(cmcDesdeHasta.unidad, unidad, cmc);
                    if(incertidumbre_combinada < cmc) incertidumbre_combinada = cmc;
                    console.log({incertidumbre_combinada});

                    let data = {incertidumbre_combinada, potencia, g_libertad_efectivos, k, incertidumbre_expandida, ip, unidad, patron};
                    return data;
                }catch(err){
                    console.error(err.message);
                }
            },

            calcularCertificado(resultado, valores, incerResult){
                let medidaG = this.medidaGlobal;
                let unidadAconvertir = valores.iec_medida;
                let unidad = resultado.unidad;
                let k = incerResult.k;

                let ip = resultado.ip_corregido;
                let iec = resultado.iec;
                let e = resultado.error_iec;
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

                let data = {ip, iec, e, u, k, unidad: unidadAconvertir};
                return data;
            },


            //Calculos internos --------------------------------------------------------------------
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

            cargarIncertidumbre(incertidumbres, valores){
                let incer = [];

                for (let incertidumbre of incertidumbres){
                    let u = calcularFormula(incertidumbre.formula, valores);
                    let u_du = u * incertidumbre.contribucion_du;
                    let g_libertad = incertidumbre.tipo == 'A' ? valores.n -1 : '∞';
                    let potencia = incertidumbre.tipo == 'A' ? Math.pow(u_du, 4) / g_libertad : 0;
                    let incertidumbre_id = incertidumbre.id;
                    // let valor_id = valores.valor_id;

                    let data = {u, u_du, g_libertad, potencia, incertidumbre_id};
                    incer.push(data);
                }

                return incer;
            },


            //Metdos front --------------------------------------------------------------------
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

            bloquear(inputName, edit){
                if( $(inputName).val() === '' ){
                    this.alertaError('No puedes dejar un campo vacío!!');
                    return;
                }

                $(inputName).attr('disabled', true);
            },

            async errorLimpiar(indice)
            {
                //guarda historial error
                const valor = this.formulario.valores[indice];
                const historico = await this.guardarHistorico(valor);
                this.tableHistorial.push(historico);

                if(valor.id > 0) this.eliminarValors(valor.id);

                this.formulario.valores[indice].iec_valor = ['', '', ''];
                this.formulario.valores[indice].ip_valor = ['', '', ''];
                this.formulario.valores[indice].id = 0;
                $(`#ip-valor-0-${indice}`).attr('disabled', false);
            },


            //Finales --------------------------------------------------------------------
            async editar(valor){
                try{
                    const hist = await axios.post(this.rutas.calibracionHistorialStore, valor);

                    if(valor.tipo === 'ip_valor') this.formulario.valores[valor.fila].ip_valor[valor.columna] = valor.nuevos;
                    else this.formulario.valores[valor.fila].iec_valor[valor.columna] = valor.nuevos;

                    this.calcularIP(valor.fila)
                        .then(response => console.log(response))
                        .catch(err =>{ throw new Error(err.message) })

                }catch(err){
                    let mensaje = err.message == 'Request failed with status code 401' ? 'Pin incorrecto' : err.message;
                    this.alertaError(mensaje);
                }
            },

            siguiente() {
                // this.submit();
                this.$emit('click-next')
            },

            atras() {
                this.$emit('click-back')
            },


            //Axios --------------------------------------------------------------------
            getIde(patron){
                return axios.get(this.rutas.patronUmIde, {params: {'patron': patron}})
                    .then(response => response.data.ide);
            },

            guardarValores(indice){
                return axios.post(this.rutas.valorStore, this.formulario.valores[indice])
                    .then(response => this.formulario.valores[indice].id = response.data.id)
            },

            guardarValoresResultados(resultado){
                return axios.post(this.rutas.valorResultadoStore, resultado)
                    .then(response => response.data)
            },

            guardarIncertidumbres(incertidumbres, valor_id){
                return axios.post(this.rutas.valorIncertidumbreStore, {incertidumbres, valor_id})
                    .then(response => response.data);
            },

            guardarIncertidumbreResultados(incertidumbreResultados){
                return axios.post(this.rutas.valorIncertidumbreResultadoStore, incertidumbreResultados)
                    .then(response => response.data);
            },

            guardarValorCertificados(valorCertificados){
                return axios.post(this.rutas.valorCertificadoStore, valorCertificados)
                    .then(response => response.data);
            },

            guardarHistorico(historico){
                return axios.post(this.rutas.guardarHistorico, historico)
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            eliminarValors(valor_id){
                axios.delete(`${this.rutas.valorIndex}/${valor_id}`)
                    .then(resp => resp)
            },

            actualizarValors(data){
                return axios.put(`${this.rutas.valorIndex}/${data.id}`, data)
                    .then(res =>{ if(res.status == 200) return res.data });
            },

            actualizarValorsResultado(resultado){
                return axios.put(this.rutas.valorResultadoUpdate, resultado)
                    .then(response => response.data)
            },

            actualizarValorsIncerResult(incerResultado){
                return axios.put(this.rutas.valorIncertidumbreResultadoUpdate, incerResultado)
                    .then(response => response.data)
            },

            actualizarValorsCertificado(certificado){
                return axios.put(this.rutas.valorCertificadoUpdate, certificado)
                    .then(response => response.data);
            },

            eliminarIncertidumbres(valor_id){
                return axios.delete(this.rutas.valorIncertidumbreDelete, { data: {valor_id}} )
                    .then(res => res.data);
            },

            guardarHistorico(historial){
                return axios.post(this.rutas.calibracionHistorialStore, historial)
                    .then(res =>{ if(res.status == 200) return res.data })
                    .catch(err => console.log(err));
            },

        }

    }
</script>


<style lang="scss" scoped>
    .input-icons { width: 100%; margin-right: 6px;
        i { position: absolute; }
    }
</style>
