require('./bootstrap');

import Vue from 'vue'

import Nomination from './vue/election/nomination'
import Election from './vue/election/election'
import Results from './vue/election/results'
import Draw from './vue/raffles/draw'

const app = new Vue({
    el: "#app",
    components: { Nomination, Election, Results, Draw }
})
