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

Vue.component('active', require('./components/Active.vue').default);
Vue.component('table-delete', require('./components/TableDelete.vue').default);
Vue.component('patron-card', require('./components/patrones/PatronCard.vue').default);
Vue.component('patron-doc', require('./components/patrones/PatronDoc.vue').default);
Vue.component('cliente-card', require('./components/clientes/ClienteCard.vue').default);
Vue.component('equipo-card', require('./components/equipos/EquipoCard.vue').default);
Vue.component('equipo-doc', require('./components/equipos/EquipoDoc.vue').default);
Vue.component('procedimiento-card', require('./components/procedimientos/ProcedimientoCard.vue').default);
Vue.component('procedimiento-doc', require('./components/procedimientos/ProcedimientoDoc.vue').default);
Vue.component('hoja-vida', require('./components/HojaVida.vue').default);
Vue.component('vue-select', require('vue-select2').default);


const app = new Vue({
    el: '#app',
});


