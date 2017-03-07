'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';


const Chat = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar
  }
});


export default Chat;