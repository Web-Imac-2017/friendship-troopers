'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';


const Enigme = Vue.extend({
  template,
  components : {
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight,
  	'menu-tools' : MenuTools,
    'navbar' : NavBar
  },
  data () {
  	return {
  		riddle : {
  			content : 'Je plonge d\'une falaise de 10 mètre de haut. <br\> Je nage sous l\'eau pendant plus d\'une heure. <br\> Je chasse le requin avec les dents. <br\> Chaque matin je traverse la Méditarranée à la brasse ...',
  			players : [{
  				name : 'Marmitton',
  				imagePath : '/assets/images/avatars/aliens/aliens.svg',
  				planetId : 1
  			}
  			],
  			points : 125
  		},
  		planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ],
  		response : ''
  	}
  }
});


export default Enigme;