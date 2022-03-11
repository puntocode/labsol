<template>
    <fieldset>
        <div class="mb-12 form-card">
            <div class="mb-12 d-flex justify-content-between">
                <slot></slot>
            </div>

            <ModalValor
                :valorIp.sync="formulario.valores[formValor.fila].ip_valor[formValor.columna]"
                :valorIec.sync="formulario.valores[formValor.fila].iec_valor[formValor.columna]"
                :data="formValor"
                @editarValor="editarValor" />

            <EditValor
                :data="formEdit"
                :tabla="formulario.resultados.length"
                :valores.sync="formulario.valores"
                @updateForm="updateForm"
                @limpiarResults="limpiarResults" />


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

            <!-------------------------------- Medidas Generales ------------------------------------------------------------------------------------------>

            <div class="row mb-10 text-left">
                <div class="col-md-2">
                    <label>Unidad de Medida</label>
                </div>
                <div class="col-md-4">
                    <div class="input-icons">
                        <!-- <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                           @click="modalEditar(form.unidad_medida, 'unidad_medida', 'select', unidadMedidas)"
                        ></i> -->
                        <input class="form-control" :value="form.unidad_medida" disabled />
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <label class="mx-5">Resolución</label>

                    <div class="input-icons">
                        <!-- <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                           @click="modalEditar(form.resolucion, 'resolucion', 'number')"
                        ></i> -->
                        <input class="form-control" :value="form.resolucion" disabled />
                    </div>

                    <div class="input-icons">
                        <!-- <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modal-edit"
                           @click="modalEditar(form.resolucion_medida, 'resolucion_medida', 'select', selectIP)"
                        ></i> -->
                        <input class="form-control" :value="form.resolucion_medida" disabled />
                    </div>
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


            <!-------------------------------- Cabecera ---------------------------------------------------------------------------------------------->

            <div class="row mt-12">
                <div class="col-md-5 offset-md-2 text-center">
                    <h4 class="mb-4">Indicación del Patrón (IP)</h4>

                    <div class="input-icons" v-if="form.ip_medida">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#modalUnidades"
                           @click="modalEditar(form.ip_medida, 'ip_medida', 'select', unidadMedidas)"
                        ></i>
                        <input class="form-control" :value="form.ip_medida" disabled />
                    </div>

                    <div class="d-flex" v-else>
                        <select class="form-control" v-model="formulario.ip_medida">
                            <option v-for="(unidad, index) in unidadMedidas" :key="index">{{ unidad }}</option>
                        </select>

                        <button
                            type="button"
                            class="btn btn-success px-2 ml-3"
                            :disabled="!formulario.ip_medida"
                            @click="updateCampo('ip_medida')">
                            <i class="pl-3 pr-2 la la-check icon"></i>
                        </button>
                    </div>


                </div>

                <div class="col-md-5 text-center">
                    <h4 class="mb-4">Indicación del Equipo Calibrado (IEC)</h4>
                    <input :value="form.unidad_medida" class="form-control" disabled>
                </div>
            </div>

            <!-------------------------------- Formulario Patron------------------------------------------------------------------------------------------->
            <div class="row mt-4" v-for="(valor, indice) in formulario.valores" :key="indice">
                <div class="col-md-2">

                    <div class="input-icons" v-if="valor.patron && valor.id">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.patron, 'patron', valor.id, 'select', indice, null, selectPatrones)"
                        ></i>
                        <input class="form-control" :value="valor.patron" disabled />
                    </div>
                    <select
                        v-else
                        class="form-control"
                        v-model="valor.patron"
                        :disabled="formulario.resultados.length != indice || valor.id > 0 || !form.ip_medida"
                        :id="`patron-${indice}`">
                        <option v-for="(patron, i) in selectPatrones" :key="i">{{ patron }}</option>
                    </select>

                </div>

                <!-------------------------------- Input IP --------------------------------------------------->
                <div class="col-md-5 d-flex">

                    <div class="input-icons" v-if="valor.ip_medida && valor.id">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.ip_medida, 'ip_medida', valor.id, 'select', indice, null, selectIP)"
                        ></i>
                        <input class="form-control" :value="valor.ip_medida" disabled />
                    </div>
                    <select
                        v-else
                        class="form-control mr-3"
                        v-model="valor.ip_medida"
                        @change="changeUMValor($event, indice, 'ip')"
                        :id="`ip-medida-${indice}`"
                        :disabled="!form.ip_medida || formulario.resultados.length != indice">
                        <option v-for="(ip, i) in selectIP" :key="i">{{ ip }}</option>
                    </select>

                <!-------------------------------- IP Valores --------------------------------------------------->

                    <div class="input-icons">
                        <i v-if="valor.ip_valor[0]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.ip_valor[0], 'ip_valor', valor.id, 'number', indice, 0)"
                        ></i>
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
                       <i v-if="valor.ip_valor[1]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.ip_valor[1], 'ip_valor', valor.id, 'number', indice, 1)"
                        ></i>
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
                        <i v-if="valor.ip_valor[2]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.ip_valor[2], 'ip_valor', valor.id, 'number', indice, 2)"
                        ></i>
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
                    <div class="input-icons" v-if="valor.iec_medida && valor.id">
                        <i  class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.iec_medida, 'iec_medida', valor.id, 'select', indice, null, selectIEC)"
                        ></i>
                        <input class="form-control" :value="valor.iec_medida" disabled />
                    </div>
                    <select v-else
                        class="form-control mr-3"
                        v-model="valor.iec_medida"
                        :id="`iec-medida-${indice}`"
                        :disabled="formulario.resultados.length != indice"
                        @change="changeUMValor($event, indice, 'iec')" >
                        <option v-for="(iec, i) in selectIEC" :key="i">{{ iec }}</option>
                    </select>

                <!-------------------------------- IEC Valores -------------------------------------------------->

                    <div class="input-icons">
                        <i v-if="valor.iec_valor[0]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.iec_valor[0], 'iec_valor', valor.id, 'number', indice, 0)"
                        ></i>
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
                        <i v-if="valor.iec_valor[1]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.iec_valor[1], 'iec_valor', valor.id, 'number', indice, 1)"
                        ></i>
                        <input
                            type="number"
                            step="0.01" class="form-control mr-3"
                            :id="`iec-valor-1-${indice}`"
                            @blur="bloquear(`#iec-valor-1-${indice}`, {fila:indice, columna: 1, valor: 'iec-valor'})"
                            v-model="valor.iec_valor[1]"
                            :disabled="valor.ip_valor[1] === '' || valor.iec_valor[0] === '' || valor.id > 0">
                    </div>

                    <div class="input-icons">
                        <i v-if="valor.iec_valor[2]"
                            class="la la-edit"
                            data-toggle="modal"
                            data-target="#valorModal"
                           @click="modalValor(valor.iec_valor[2], 'iec_valor', valor.id, 'number', indice, 2)"
                        ></i>
                        <input
                            type="number"
                            step="0.01"
                            class="form-control"
                            :id="`iec-valor-2-${indice}`"
                            @blur="insertValores(indice)"
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

        <!-- <ModalEdit :data="formEdit" @emitForm="emitForm" /> -->

    </fieldset>
</template>

<script>
import EditValor from "./EditValor";
import ModalEdit from './ModalEdit';
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
        components: { CertificadoTable, HistorialValores, EditValor, ModalValor, ModalEdit },
        props: ['form', 'medida', 'datos', 'incertidumbres'],
        data() {
            return {
                asset: window.asset,
                certificados: [],
                documentos: [],
                formulario: {
                    //valores_medidas: { ip_medida_general: '', iec_medida_general: this.form.unidad_medida },
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
                formEdit: {},
                formValor: { fila:0, columna: 0},
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
                //if(this.form.ip_medida) this.formulario.valores_medidas.ip_medida_general = this.form.ip_medida;

                this.getDocumentos(this.selectPatrones);

                const RESP = await axios.get(this.rutas.submultiplos);
                this.subMultiplos = await RESP.data;

                this.subMultiplos.forEach(multiplo =>{
                    let unidad = multiplo.simbolo === '-' ? this.medidaGlobal : multiplo.simbolo + this.medidaGlobal;
                    this.selectIEC.push(unidad);
                });

                if(this.form.ip_medida) this.changeUnidadMedida();
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
            async insertValores(indice)
            {
                try{
                    if( this.formulario.valores[indice].iec_valor[2] === '' ) throw new Error('No puedes dejar campos vacíos');

                    const valores = this.formulario.valores[indice];

                    const result = await this.calcularResult(valores);
                    if(!result) return;

                    const calculos = await this.calculosBD(result, valores);
                    if(!calculos) return;

                    const insertado = await this.insertarValors(calculos, indice);
                    if(insertado){
                        this.formulario.valores[indice] = insertado.valors;
                        this.formulario.resultados.push(insertado.valor_resultados);
                        this.certificados.push(insertado.valor_certificados);
                    }

                }catch(error){
                    console.error(error);
                    this.alertaError(error.message)
                }
            },

            async editarValor(form){
                try{
                    const valoresTemp = this.obtenerValores(form);

                    const result = await this.calcularResult(valoresTemp);
                    if(!result) return;

                    const calculos = await this.calculosBD(result, valoresTemp);
                    if(!calculos) return;

                    const actualizado = await this.updateValors(calculos);

                    if(actualizado) this.actualizado(form, valoresTemp, calculos);

                }catch(err){
                    console.error('errorEditar', err);
                }
            },

            async calcularResult(valores)
            {
                try{
                    //Errores en el CMC
                    if(!this.datos.cmcs) throw new Error('Por favor carga los CMC!');

                    const PATRON = valores.patron;
                    const ide = await this.getIde(PATRON);

                    if(!ide) throw new Error('no existe ide');

                    const existeCmc = this.datos.cmcs.some(cmc => cmc.patron_code == PATRON);
                    if(!existeCmc) throw new Error(`No existe cmc para ese Patron: ${PATRON}`);

                    const unidadIde = ide[0].unit_measurement;

                    //Caluculos IP -------------------------------------------
                    const arrayEnIde = this.getArrayUnIde(valores, unidadIde);

                    const promedio = (arrayEnIde.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                    const desviacion = calcularDes(arrayEnIde);

                    let errorIp = null;
                    const rangosDeriva = ide[0].rangos[0].rango_derivas;
                    const arrayDeriva = rangosDeriva.map( numero => numero.ip.valor);

                    const cercanos = encontrarCercanos(arrayDeriva, promedio);

                    if(cercanos[0] === undefined || cercanos[1] === undefined){
                        throw new Error('Datos no se encuentran en los rangos del IDE!');
                    }else{
                        errorIp = this.calcularInterpolacion(promedio, cercanos, rangosDeriva);
                    }

                    let ipCorregido = promedio;
                    if(errorIp !== null) ipCorregido += parseFloat(errorIp);


                    //Caluculos IEC -------------------------------------------
                    const arrayEnIdeIEC = this.getArrayUnIEC(valores, unidadIde);

                    const promedioIEC = (arrayEnIdeIEC.reduce((a, b) => a + b, 0)) / arrayEnIde.length;
                    const desviacionIEC = calcularDes(arrayEnIdeIEC);
                    const errorIec = promedioIEC - ipCorregido;

                    let uk = 0
                    if(cercanos[0] !== undefined && cercanos[1] !== undefined) uk = this.calcularInterpolacion(promedio, cercanos, rangosDeriva, false);

                    //return result -------------------------------------------
                    let result = {
                        valor_id: valores.id,
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

                    return result;
                }catch(err){
                    console.error('errorResult', err);
                    this.$swal.fire('Error', err.message, 'error');
                }
            },

            getArrayUnIde(valores, unidadIde){
                // const unidadIPgeneral = this.formulario.valores_medidas.ip_medida_general;
                const unidadIPgeneral = this.form.ip_medida;
                const unidadMedidaIP = valores.ip_medida;
                const arrayValores = this.convertirUnidadBase(valores.ip_valor, unidadMedidaIP, unidadIPgeneral);
                const arrayEnIde = this.convertirUnidadIde(arrayValores, unidadIPgeneral, unidadIde)
                return arrayEnIde;
            },

            getArrayUnIEC(valores, unidadIde){
                //const unidadIECgeneral = this.formulario.valores_medidas.iec_medida_general;
                const unidadIECgeneral = this.form.unidad_medida;
                const unidadMedidaIEC = valores.iec_medida;
                const arrayValoresIEC = this.convertirUnidadBase(valores.iec_valor, unidadMedidaIEC, unidadIECgeneral);
                const arrayEnIdeIEC = this.convertirUnidadIde(arrayValoresIEC, unidadIECgeneral, unidadIde)
                return arrayEnIdeIEC;
            },

            async calculosBD(resultados, valors){
                try{
                    //const valors = this.formulario.valores[indice];
                    const valor_resultados = resultados;
                    const valor_incertidumbres = await this.calcularIncertidumbre(valor_resultados);

                    const valor_incertidumbres_resultados = await this.incertidumbreResultado(valor_incertidumbres, valor_resultados, valors.patron);
                    if(!valor_incertidumbres_resultados) throw new Error('El punto de calibración no corresponde al CMC, por lo tanto, no está acreditado!');

                    const valor_certificados = await this.calcularCertificado(valor_resultados, valors, valor_incertidumbres_resultados);

                    const valores = {valors, valor_resultados, valor_incertidumbres, valor_incertidumbres_resultados, valor_certificados}

                    return valores;
                }catch(err){
                    console.error('ErrorCalculoBd', err);
                    this.alertaError('Error en los datos');
                }
            },

            async insertarValors(valores){
                let valor_id;

                try{
                    this.alertaCalculando();

                    //insertamos en valors y esperamos el id
                    const valors = await this.guardarValores(valores.valors);
                    valor_id = valors.id;

                    valores.valors = valors;
                    valores.valor_resultados.valor_id = valors.id;
                    valores.valor_incertidumbres_resultados.valor_id = valors.id;
                    valores.valor_certificados.valor_id = valors.id;

                    await this.guardarValoresResultados(valores.valor_resultados);
                    await this.guardarIncertidumbres(valores.valor_incertidumbres, valors.id);
                    await this.guardarIncertidumbreResultados(valores.valor_incertidumbres_resultados);
                    await this.guardarValorCertificados(valores.valor_certificados);

                    this.$swal.close();
                    return valores

                }catch(err){
                    this.eliminarValors(valor_id);
                    console.error('ErrorInsertBD', err);
                    this.alertaError('Error al insertar en la BD');
                }
            },

            async updateValors(valores){
                try{
                    //actulizar la tabla valors, resultados incer, certificado
                    this.alertaCalculando();

                    valores.valor_resultados.valor_id = valores.valors.id;
                    valores.valor_incertidumbres_resultados.valor_id = valores.valors.id;
                    valores.valor_certificados.valor_id = valores.valors.id;

                    await this.actualizarValors(valores.valors);
                    await this.actualizarValorsResultado(valores.valor_resultados);
                    await this.actualizarValorsIncerResult(valores.valor_incertidumbres_resultados);
                    await this.actualizarValorsCertificado(valores.valor_certificados);
                    await this.eliminarIncertidumbres(valores.valors.id);
                    await this.guardarIncertidumbres(valores.valor_incertidumbres, valores.valors.id);

                    this.$swal.close();
                    return true;
                }catch(err){
                    console.error('ErrorActualizandoBD', err);
                    this.alertaError(err.message);
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

                    let data = {u, u_du, g_libertad, potencia, incertidumbre_id};
                    incer.push(data);
                }

                return incer;
            },


            //Metdos front --------------------------------------------------------------------
            changeUnidadMedida(){
                const medida = this.form.ip_medida;
                this.selectIP = this.subMultiplos.map(unidad => {
                    return unidad.simbolo === '-' ? medida : unidad.simbolo+medida;
                });
            },

            changeUMValor(event, index, name){
                if(index === 0 && this.formulario.valores[index].id === 0){
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

                if(this.formulario.valores[index].id > 0) this.editarValor({fila: index});

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
                if( $(inputName).val() === '' ){
                    this.alertaError('No puedes dejar un campo vacío!!');
                    return;
                }

                $(inputName).attr('disabled', true);
            },

            modalEditar(anteriores, campo, type = 'text', select = []){
                this.formEdit = {
                    anteriores,
                    campo,
                    type,
                    select,
                    tabla: this.formulario.resultados.length,
                    calibracion_id: this.form.id
                };
            },

            modalValor(anteriores, campo, valor_id, type, fila, columna, select = []){
                this.formValor = {
                    anteriores,
                    campo,
                    type,
                    select,
                    fila,
                    columna,
                    valor_id,
                    calibracion_id: this.form.id
                }
            },

            limpiarResults(){
                this.formulario.resultados = [];
                this.certificados = [];
            },

            updateForm(data){
                this.$emit('update-form', data);
            },


            //Finales --------------------------------------------------------------------
            async updateCampo(campo){
                try{
                    let data  = {campo, valor: this.formulario[campo], id: this.form.id};

                    if(!data.valor) throw new Error('El campo es obligatorio');

                    const res = await axios.put(this.rutas.updateCampo, data);
                    const value = await res.data;

                    if(value) this.$emit('update-form', data);
                }catch(err){
                    console.error('ErrorUpdateCampo', err);
                    this.$swal.fire('Error', err.message, 'error');
                }
            },

            obtenerValores(editForm){
                const valores = Object.assign({}, this.formulario.valores[editForm.fila]);

                switch(editForm.campo){
                    case 'patron'    : valores.patron                      = editForm.nuevos; break;
                    case 'ip_medida' : valores.ip_medida                   = editForm.nuevos; break;
                    case 'iec_medida': valores.iec_medida                  = editForm.nuevos; break;
                    case 'ip_valor'  : valores.ip_valor[editForm.columna]  = editForm.nuevos; break;
                    case 'iec_valor' : valores.iec_valor[editForm.columna] = editForm.nuevos; break;
                }

                return valores;
            },

            siguiente() {
                this.$emit('click-next')
            },

            atras() {
                this.$emit('click-back')
            },

            emitForm(editado){
                this.$emit('update-form', editado);
            },

            actualizado(formEdit, valores, calculos){
                this.formulario.resultados.splice(formEdit.fila, 1, calculos.valor_resultados);
                this.certificados.splice(formEdit.fila, 1, calculos.valor_certificados);

                this.formulario.valores[formEdit.fila] = valores;

                let columna = formEdit.columna == null ? '' : `, ${formEdit.columna + 1}`;
                formEdit.campo =`${formEdit.campo} (${formEdit.fila + 1}${columna})`;

                axios.post(this.rutas.calibracionHistorialStore, formEdit)
                    .then(resp => console.log('historial guardado'));
            },


            //Axios --------------------------------------------------------------------
            getIde(patron){
                return axios.get(this.rutas.patronUmIde, {params: {'patron': patron}})
                    .then(response => response.data.ide)
                    .catch(err => 'No tiene ide cargado');
            },

            guardarValores(valors){
                return axios.post(this.rutas.valorStore, valors)
                    .then(response => response.data)
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

        },

        //Finales --------------------------------------------------------------------
        watch: {
            'form.ip_medida': function(){
                this.changeUnidadMedida();
            }
        }

    }
</script>


<style lang="scss" scoped>
    .input-icons { width: 100%; position: relative; margin-right: 6px;
        i { position: absolute; padding: 10px; color: #009BDD;  right: 0; cursor: pointer; }
    }
</style>
