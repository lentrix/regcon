require('./bootstrap');

import Vue from 'vue'

import MainApp from './vues/main-app'

const app = new Vue({
    el: "#main-app",
    components: {MainApp}
});
