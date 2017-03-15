'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);
import {apiRoot} from '../../../../../config.js';


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js';

const EnigmeResolved = Vue.extend({
  template,
  components : {
  'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight,
  	'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'deconnexion' : Deconnexion,
  },
  created : function(){
  	this.$http.get(apiRoot() + 'users/me').then((response) => {
          this.me = response.data[0];
      }, (response) => {
        console.log(response);
      })
  	this.username = this.$route.params.user;
  	console.log(this.username);
  }, 
  data () {
  	return {
  		me : {},
  		riddleSolved : [
  		{
  			name :'Le trésor caché aux confins du Connecticut ',
  			level :'debutant',
  			mode :'multijoueur',
  			date :'18 fev',
  			points : 30,
  			players : [ {
  				username : 'Marmitton',
  				imagePath : '/assets/images/avatars/aliens/aliens.svg',
  				planetId : 1
  			}]
  		}],
  		nbBadges : 2
  	}
  }
});


export default EnigmeResolved;
