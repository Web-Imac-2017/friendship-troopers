'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const DashboardSubMenu = Vue.extend({
  template,
  props : {
    notification: Object
  }
});

export default DashboardSubMenu;