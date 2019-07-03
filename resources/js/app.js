require('./bootstrap');

import Vue from 'vue';

import Routes from  '../js/routes.js';

import main from "./components/Main.vue";

const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(main),
});

export default app;
