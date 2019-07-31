import axios from 'axios';

window.Vue = require('vue');
window.axios = axios;

Vue.component('category-codes', require('./components/CategoryCodes.vue').default);

new Vue({
    el: '#one',
});
