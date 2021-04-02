require('./bootstrap');

import Vue from 'vue'

import Nomination from './vue/election/nomination'

const app = new Vue({
    el: "#app",
    components: { Nomination }
})
