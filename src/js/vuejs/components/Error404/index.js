'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
import MenuTools from '../MenuTools/index.js';
import Deconnexion from '../Deconnexion/index.js'

const Error404 = Vue.extend({
  template,
  components : {
    'menu-tools' : MenuTools, 
    'deconnexion' : Deconnexion, 
  	'navbar' : NavBar
  }
});


export default Error404;