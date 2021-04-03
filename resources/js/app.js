require('./bootstrap');

import Vue from 'vue'

import Nomination from './vue/election/nomination'
import Election from './vue/election/election'

const app = new Vue({
    el: "#app",
    components: { Nomination, Election }
})
