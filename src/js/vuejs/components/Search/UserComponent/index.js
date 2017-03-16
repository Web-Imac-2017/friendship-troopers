'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


const UserComponent = Vue.extend({
  props : {
    user:Object
  },
  template,
  data () {
    return {
    	//cette info sert à mettre la bonne couleur au pseudonyme en fonction de la planète de l'utilisateur
       planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  },

});


export default UserComponent;