'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const DashboardSubMenu = Vue.extend({
  template,
  props : {
    notification: Object
  },
 computed : {
    imagePath : function() { 
      return "/assets/images/avatars/" + this.notification.planet + "/" + this.notification.avatar;
    }
  }
});

export default DashboardSubMenu;