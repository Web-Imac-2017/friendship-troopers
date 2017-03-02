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
          title:'title1',
          titleTab : [ "title1","title2"],
        }
      }
    }
});


export default  Parameters; 