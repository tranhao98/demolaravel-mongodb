require('./bootstrap');

window.Vue = require('vue').default;
Vue.config.productionTip = false
import routes from './routes';
import VueMapbox from "vue-mapbox";
import Mapbox from "mapbox-gl";

Vue.use(VueMapbox, { mapboxgl: Mapbox });
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});