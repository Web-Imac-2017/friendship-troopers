'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import FriendTemplate from './FriendTemplate/index.js'
import NavBar from '../NavBar/index.js';

const Friends = Vue.extend({
  template,
  components: {
    'FriendTemplate' : FriendTemplate, 
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar }, 
  methods : {
    selectPlanet : function(index) {
      this.planets[this.currentPlanetIndex].selected = false;
      this.currentPlanetIndex = index;
      this.planets[index].selected = true;
    }
  },
  data () {
      return {
        planets : 
          [ {
            type : "earth",
            name : "Terre",
            number : "#AA001",
            path : "../assets/images/planets/Terre.svg",
            selected : true,
            nbFriends : 2
          },{
            type : "parallel",
            name : "Paranose",
            number : "#312LL",
            path : "../assets/images/planets/Paranose.svg",
            selected : false,
            nbFriends : 1
          },{
            type : "robots",
            name : "Technome",
            number : "#8T077",
            path : "../assets/images/planets/Technome.svg",
            selected : false,
            nbFriends : 1
          },{
            type : "alien",
            name : "Sautien",
            number : "#SS013",
            path : "../assets/images/planets/Sautien.svg",
            selected : false,
            nbFriends : 1
          },{
            type : "space-opera",
            name : "Multas",
            number : "#781ST",
            path : "../assets/images/planets/Terre.svg",
            selected : false,
            nbFriends : 1
          } ],
       currentPlanetIndex : 0,
       user: {
        nbFriends : 7, 
        friends : 
          [ { 
              path  : '../assets/images/Avatar1.svg',
              name : 'ILoveUfo',
              badge : 'Baroudeuse de l\'espace',
              birthDate : '29 avril',
              planet : 'Terre'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'JeanLuc',
              badge : 'Baroudeur de l\'espace',
              birthDate : '29 avril',
              planet : 'Multas'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril',
              planet : 'Sautien'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril',
              planet : 'Technome'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril',
              planet : 'Paranose'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril',
              planet : 'Terre'
            },{ 
              path : '../assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril',
              planet : 'Terre'}
          ]
       } 
    }

  }
});


export default Friends;