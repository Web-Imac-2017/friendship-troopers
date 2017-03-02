'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'

const EnigmeCurrent = Vue.extend({
  template,
  components : {
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight,
  	'menu-tools' : MenuTools
  },
  data () {
      return {
       	friendsOnline : [
       		'aaaa', 'bbbb', 'cccc', 'dddd', 'eeee', 'ffff', 'gggg'
       	]
       }
   }
});


export default EnigmeCurrent;