'use strict';
import Vue from 'vue/dist/vue';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import formParameters from './formParameters/index.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Parameters = Vue.extend({
  template,
  components: { 
  	'lateral-menu-left' : LateralMenuLeft, 
  	'lateral-menu-right' : LateralMenuRight, 
  	'menu-tools' : MenuTools, 
  	'form-parameters' : formParameters 
  }, 
  data () {
    return {
      user:{
        mail: 'admin@gmail.com',
        password: 'admin1234',
        passwordChecked: 'admin1234',
        avatar : "http://placehold.it/150x150",
        title:'Super alien',
        titleTab : [ "Astronaute débutant","Super alien", "Cacahuete planétaire"],
        avatarPathTab : [
          "http://placehold.it/150x150",
          "http://placehold.it/25x15",
          "http://placehold.it/10x15",
          "http://placehold.it/15x15",
          "http://placehold.it/15x10",
        ]
      }
    }
  }
});


export default  Parameters; 