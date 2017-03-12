'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import FriendTemplate from './FriendTemplate/index.js'
import NavBar from '../NavBar/index.js';

const Friends = Vue.extend({
  template,
  created :  function() {
      this.$http.get(apiRoot() + 'users/me/friends').then((response) => {
      // gérer le succes, toutes les infos renvoyer sont dans response.data      
        this.allFriends = response.data;
        this.selectPlanet(0);
      }, (response) => {
      // gérer les erreurs avec response.status pour les code d'erreurs
        console.log(response);
      });
  },
  components: {
    'FriendTemplate' : FriendTemplate, 
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar }, 
  methods : {
    isKey : function(index) {
      return (index) in this.allFriends;
    },
    selectPlanet : function(index) {
      this.planets[this.currentPlanetIndex].selected = false;
      this.currentPlanetIndex = index;
      this.planets[index].selected = true;

      if (this.isKey(this.currentPlanetIndex+1)) {
        this.displayedFriends  = this.allFriends[this.currentPlanetIndex + 1]; // +1 because the planet id starts at 1
      } else {
        this.displayedFriends = {};
      }
    }    
  },
  data () {
      return {
        allFriends : {},
        displayedFriends : {},
        currentPlanetIndex : 0,
        planets :
          [{
            type : "earth",
            name : "Terre",
            number : "#AA001",
            path : "../assets/images/planets/Terre.svg",
            selected : true,
            nbFriends : 2
          },
          {
            type : "parallel",
            name : "Paranose",
            number : "#312LL",
            path : "../assets/images/planets/Paranose.svg",
            selected : false,
            nbFriends : 1
          },
          {
            type : "robots",
            name : "Technome",
            number : "#8T077",
            path : "../assets/images/planets/Technome.svg",
            selected : false,
            nbFriends : 1
          },
          {
            type : "alien",
            name : "Sautien",
            number : "#SS013",
            path : "../assets/images/planets/Sautien.svg",
            selected : false,
            nbFriends : 1
          },
          {
            type : "space-opera",
            name : "Multas",
            number : "#781ST",
            path : "../assets/images/planets/Terre.svg",
            selected : false,
            nbFriends : 1
          }]
    }

  }
});


export default Friends;