import VueRouter from 'vue-router';
import router from './routes';
import axios from 'axios';

window.Vue = require('vue');
window.axios = axios;

Vue.use(VueRouter);

Vue.component('category-list', require('./components/CategoryList.vue').default);
Vue.component('category-codes', require('./components/CategoryCodes.vue').default);

new Vue({
    el: '#one',
    router,
});
