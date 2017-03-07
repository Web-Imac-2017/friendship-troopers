'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
  

const Error404 = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar
  }
});


export default Error404 ;