'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import FriendTemplate from './FriendTemplate/index.js'
import NavBar from '../NavBar/index.js';
import Deconnexion from '../Deconnexion/index.js'

const Friends = Vue.extend({
  template,
  created :  function() {
      this.$http.get(apiRoot() + 'users/me/friends').then((response) => {
      // gérer le succes, toutes les infos renvoyer sont dans response.data      
        this.allFriends = response.data;
      }, (response) => {
      });

      this.$http.get(apiRoot() + 'planets/').then(
        (response) => {
          this.planets = response.data;
          for (var i = 0; i < this.planets.length; i++) {
            this.planets[i].selected = false;
          }
          this.selectPlanet(0);
        },(response) => {
        });
  },
  components: {
    'FriendTemplate' : FriendTemplate, 
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'deconnexion' : Deconnexion }, 
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
        planets : {}
    }

  }
});


export default Friends;