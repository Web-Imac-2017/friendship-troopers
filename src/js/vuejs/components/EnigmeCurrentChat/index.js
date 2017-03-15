'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js';
import EnigmeLayout from '../EnigmeLayout/index.js';


const EnigmeCurrentChat = Vue.extend({
  template,
  components : {
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight,
  	'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'deconnexion' : Deconnexion,
    'enigme-layout' : EnigmeLayout
  },
  data () {
  	return {
      chat : true
  	}
  }
});


export default EnigmeCurrentChat;