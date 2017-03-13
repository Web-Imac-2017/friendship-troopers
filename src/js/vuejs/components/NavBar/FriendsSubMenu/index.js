'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const FriendsSubMenu = Vue.extend({
  template,
  props : {
    friend: Object
  }
});

export default FriendsSubMenu;