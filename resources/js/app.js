window.Vue = require('vue');

Vue.component('category-list', require('./components/CategoryList.vue').default);

new Vue({
    el: '#one',
});
