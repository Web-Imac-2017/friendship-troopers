'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import AdminMenu from '../AdminMenu/index.js'


const AdminAddAdmin = Vue.extend({
  template,
   components : {
  	'admin-menu' : AdminMenu
  }
});


export default AdminAddAdmin;