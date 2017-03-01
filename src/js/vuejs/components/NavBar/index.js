'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const NavBar = Vue.extend({
  template,
  methods: {
    showMenuPesponsive: function(){
      
    }, 
    showNotifications: function(){
      
    }, 
    showMessages: function(){
      
    }, 
    showFriends: function(){
      
    }
  }, 
   data () {
      return {
        notif:{
          friends : 1,
          messages : 16,
          notifications : 100
        }
      }
    }
});


export default NavBar;