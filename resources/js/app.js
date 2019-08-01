import './bootstrap';
import axios from 'axios';

window.Vue = require('vue');
window.axios = axios;

Vue.component('category-codes', require('./components/CategoryCodes.vue').default);
Vue.component('create-code', require('./components/CreateCode.vue').default);

new Vue({
    el: '#one',
});

new Vue({
    el: '#two',
});
