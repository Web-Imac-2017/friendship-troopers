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
          mail: '',
          password: '',
          passwordChecked: '',
          imagePath : "http://placehold.it/150x150",
          title:'Super alien',
          titleTab : [ "Astronaute débutant","Super alien"],
          imagePathTab : [
            "http://placehold.it/150x150",
            "http://placehold.it/150x150",
            "http://placehold.it/150x150",
            "http://placehold.it/150x150",
            "http://placehold.it/150x150",
          ]
        }
      }
    }
});


export default  Parameters; 