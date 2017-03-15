'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const MessagesSubMenu = Vue.extend({
  template,
  props : {
    message: Object
  }
});

export default MessagesSubMenu;