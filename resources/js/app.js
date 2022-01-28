/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue').default;

window.axios = require('axios');
window._token = $('meta[name="csrf-token"]').attr('content');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


Vue.component('asignar-tecnico',       require('./components/expedientes/AsignarTecnico.vue').default);
Vue.component('expediente-form',       require('./components/expedientes/ExpedienteForm.vue').default);
Vue.component('anular-expediente',     require('./components/expedientes/AnularExpediente.vue').default);
Vue.component('expediente-tecnicos',   require('./components/expedientes/ExpedienteTecnicos.vue').default);
Vue.component('ficha-incertidumbre',   require('./components/expedientes/FichaIncertidumbre.vue').default);
Vue.component('historial-calibracion', require('./components/expedientes/HistorialCalibracion.vue').default);

Vue.component('calibracion-form',      require('./components/calibracion/CalibracionForm.vue').default);
Vue.component('estado-calibracion',    require('./components/calibracion/EstadoCalibracion.vue').default);
Vue.component('anular-calibracion',    require('./components/calibracion/AnularCalibracion.vue').default);
Vue.component('calibracion-grafico',   require('./components/calibracion/CalibracionGrafico.vue').default);

Vue.component('patron-maintenance',    require('./components/patrones/PatronMaintenance.vue').default);
Vue.component('eliminar-historial',    require('./components/patrones/EliminarHistorial.vue').default);
Vue.component('patron-historial',      require('./components/patrones/PatronHistorial.vue').default);
Vue.component('patron-card',           require('./components/patrones/PatronCard.vue').default);
Vue.component('patron-doc',            require('./components/patrones/PatronDoc.vue').default);
Vue.component('patron-ide',            require('./components/patrones/PatronIde.vue').default);

Vue.component('eliminar-ensayo',       require('./components/patrones/ensayos/EliminarEnsayo.vue').default);
Vue.component('editar-ensayo',         require('./components/patrones/ensayos/EditarEnsayo.vue').default);
Vue.component('patron-ensayo',         require('./components/patrones/ensayos/PatronEnsayo.vue').default);

Vue.component('eliminar-magnitud',     require('./components/patrones/ide/EliminarMagnitud.vue').default);
Vue.component('magnitud-form',         require('./components/patrones/ide/MagnitudForm.vue').default);
Vue.component('table-deriva',          require('./components/patrones/ide/TableDeriva.vue').default);
Vue.component('deriva-form',           require('./components/patrones/ide/DerivaForm.vue').default);

Vue.component('equipo-maintenance',    require('./components/equipos/EquipoMaintenance.vue').default);
Vue.component('equipo-historial',      require('./components/equipos/EquipoHistorial.vue').default);
Vue.component('equipo-card',           require('./components/equipos/EquipoCard.vue').default);
Vue.component('equipo-doc',            require('./components/equipos/EquipoDoc.vue').default);

Vue.component('certificados-edit',     require('./components/entrada-instrumentos/CertificadosEdit.vue').default);
Vue.component('entrada-form',          require('./components/entrada-instrumentos/EntradaForm.vue').default);
Vue.component('entrada-edit',          require('./components/entrada-instrumentos/EntradaEdit.vue').default);

Vue.component('instrumento-form',      require('./components/instrumentos/InstrumentoForm.vue').default);
Vue.component('magnitud-abm',         require('./components/magnitudes/MagnitudAbm.vue').default);

Vue.component('procedimiento-card',    require('./components/procedimientos/ProcedimientoCard.vue').default);
Vue.component('editar-acreditado',     require('./components/procedimientos/EditarAcreditado.vue').default);
Vue.component('editar-ema',            require('./components/procedimientos/EditarEma.vue').default);

Vue.component('cmc-form',              require('./components/cmc/CmcForm.vue').default);
Vue.component('documentos',            require('./components/documentos/Documentos.vue').default);
Vue.component('cliente-card',          require('./components/clientes/ClienteCard.vue').default);

Vue.component('cabecera-print',        require('./components/CabeceraPrint.vue').default);
Vue.component('table-delete',          require('./components/TableDelete.vue').default);
Vue.component('hoja-vida',             require('./components/HojaVida.vue').default);
Vue.component('list-doc',              require('./components/ListDoc.vue').default);
Vue.component('active',                require('./components/Active.vue').default);
Vue.component('vue-select',            require('vue-select2').default);


const app = new Vue({
    el: '#app',
});


