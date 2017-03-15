'use strict';
import Vue from 'vue/dist/vue';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import topParameters from './topParameters/index.js'
import bottomParameters from './bottomParameters/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js';


let template = require('./template.html');
template     = eval(`\`${template}\``);


const Parameters = Vue.extend({
  template,
  components: { 
  	'lateral-menu-left' : LateralMenuLeft, 
  	'lateral-menu-right' : LateralMenuRight, 
  	'menu-tools' : MenuTools, 
  	'top-parameters' : topParameters,
    'bottom-parameters' : bottomParameters, 
    'navbar' : NavBar,
    'deconnexion' : Deconnexion
  }, 
  mounted : function() {
    console.log("In ref" + JSON.stringify(this.$refs.menu.user));
    this.user = this.$refs.menu.user;
    console.log("In user" + JSON.stringify(this.user));
  },
  data () {
    return {
      user:{
        /*mail: 'admin@gmail.com',
        password: 'admin1234',
        avatar : "http://placehold.it/150x150",
        title:'Super alien',
        
        avatarPathTab : [
          "http://placehold.it/150x150",
          "http://placehold.it/25x15",
          "http://placehold.it/10x15",
          "http://placehold.it/15x15",
          "http://placehold.it/15x10",
        ]*/
      }
    }
  }
});


export default  Parameters; 