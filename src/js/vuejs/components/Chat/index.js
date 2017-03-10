'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import Deconnexion from '../Deconnexion/index.js'
import MenuTools from '../MenuTools/index.js'

const Chat = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar,
  	'lateral-menu-left' : LateralMenuLeft,
  	'deconnexion' : Deconnexion,
  	'menu-tools' : MenuTools
  }, 
  methods : {
  	active : function(index){
  		this.friends[this.currentSelected].selected = false;
  		this.friends[index].selected = true;
  		this.currentSelected = index;
  	}
  },
  data () {
  	return {
  		date : '17 fevrier 1980',
  		currentSelected : 0,
  		friends : [
  		{
  			name : "George Micheal",
  			avatar : "/assets/images/avatars/Multas/aliens.svg",
  			planete : "Multas",
  			selected : false
  		}, {
  			name : "John Lennon",
  			avatar : "/assets/images/avatars/Paranose/astro.svg",
  			planete : "Paranose",
  			selected : false
   		},
  		{
  			name : "Patti Smith",
  			avatar : "/assets/images/avatars/Sautien/dashboard.svg",
  			planete : "Sautien",
  			selected : false

  		}, {
  			name : "Nina Hagen",
  			avatar : "/assets/images/avatars/Multas/aliens.svg",
  			planete : "Multas",
  			selected : false

  		}, {
  			name : "Genesis",
  			avatar : "/assets/images/avatars/Paranose/astro.svg",
  			planete : "Paranose",
  			selected : false

  		},
  		{
  			name : "Cindy Laupers",
  			avatar : "/assets/images/avatars/Sautien/dashboard.svg",
  			planete : "Sautien",
  			selected : false

  		}
  		], 
  		conversation : [
  		{
  			time : '12h50',
  			content : 'Unicorns are real, I swear',
  			sender : 1
  		}, {
  			time : '12h52',
  			content : 'Fuck Yeah',
  			sender : 0
  		},
  		{
  			time : '12h50',
  			content : 'Pffff',
  			sender : 1
  		},{
  			time : '12h50',
  			content : 'Non, en vrai t\'as raison, même que le sang de licorne ca fait survivre! #HarryPotter',
  			sender : 1
  		}
  		],
  		myself : {
  			avatar : '/assets/images/avatars/Sautien/dashboard.svg'
  		}

  	}
  }
});


export default Chat;