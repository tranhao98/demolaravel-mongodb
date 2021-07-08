require('./bootstrap');


window.Vue = require('vue').default;


import VueRouter from 'vue-router';

import routess from './routess';

Vue.use(VueRouter);


const app = new Vue({
    el: '#app',
    router: new VueRouter(routess)
});