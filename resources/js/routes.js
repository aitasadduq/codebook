import VueRouter from 'vue-router';
import CategoryCodes from './components/CategoryCodes.vue';

let routes = [{
    path: '/categorycodes/:id',
    component: CategoryCodes,
    props: true
}];

export default new VueRouter({ routes });
