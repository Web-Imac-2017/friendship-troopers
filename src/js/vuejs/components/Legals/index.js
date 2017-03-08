'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);
import NavBar from '../NavBar/index.js';
  
const Legals = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar
  }
});


export default Legals;