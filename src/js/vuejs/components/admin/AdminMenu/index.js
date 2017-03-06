'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const AdminMenu = Vue.extend({
  template,
  data () {
      return {
       admin : {
          adminName : 'LuckyPon'
       }, 
       reports : {
          number : '4'
       }
      }
    }
});


export default AdminMenu;