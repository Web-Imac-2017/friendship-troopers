'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js';
import NotDone from '../NotDone/index.js';


const EnigmeCurrent = Vue.extend({
  template,
  components : {
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight,
  	'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'deconnexion' : Deconnexion,
    'not-done' : NotDone
  },
 
  methods : {
    selectedLevel : function(index) { 
      this.levelSelected = index;
    },
    selectedMode : function(index) {
      this.modeSelected = index;
    },
    findMe:function(){
      this.me = this.$refs.menu.user;
    }
  },
  data () {
      return {
       	levelSelected : 0,
        modeSelected : 0,
        me:{},
        levels: [ {
          image : '/assets/images/enigmes/debutant.svg',
          imageSelected : '/assets/images/enigmes/debutant-selected.svg',
          text : 'Debutant'
        }, {
          image : '/assets/images/enigmes/amateur.svg',
          imageSelected : '/assets/images/enigmes/amateur-selected.svg',
          text : 'Amateur'
        },
        {
          image : '/assets/images/enigmes/expert.svg',
          imageSelected : '/assets/images/enigmes/expert-selected.svg',
          text : 'Expert'
        }, {
          image : '/assets/images/enigmes/tous-niveaux.svg',
          imageSelected : '/assets/images/enigmes/tous-niveaux-selected.svg',
          text : 'Tous niveaux'
        }
        ],
        modes : [
        {
          image : '/assets/images/enigmes/solo.svg',
          imageSelected : '/assets/images/enigmes/solo-selected.svg',
          text : 'Solo'
        }, {
          image : '/assets/images/enigmes/multijoueur.svg',
          imageSelected : '/assets/images/enigmes/multijoueur-selected.svg',
          text : 'Multijoueurs'
        }
        ]
       }
   }
});


export default EnigmeCurrent;