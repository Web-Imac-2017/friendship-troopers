'use strict';
import Vue from 'vue/dist/vue';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import topParameters from './topParameters/index.js'
import bottomParameters from './bottomParameters/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js';
import NotDone from '../NotDone/index.js';

import {apiRoot} from '../../../../../config.js';

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
    'deconnexion' : Deconnexion,
    'not-done' : NotDone
  }, 
  created : function() {
    this.$http.get(apiRoot() + 'users/me').then((response) => {
          this.user = response.data;
      }, (response) => {
      })
  },
  data () {
    return {
      user:{ }
    }
  }
});


export default  Parameters; 