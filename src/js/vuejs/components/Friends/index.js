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
    // Get all the user friends
      this.$http.get(apiRoot() + 'users/me/friends').then((response) => { 
        this.allFriends = response.data;
      }, (response) => {
      });

      // Get all the planets and select the first planet
      this.$http.get(apiRoot() + 'planets/').then(
        (response) => {
          this.planets = response.data;
          for (var i = 0; i < this.planets.length; i++) {
            this.planets[i].selected = false;
          }
          this.assignPlanetPath();
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
    // Return true if index is a key in allFriends
    isKey : function(index) {
      return (index) in this.allFriends;
    },
    // Display the friends of the planet with id = index + 1
    selectPlanet : function(index) {
      this.planets[this.currentPlanetIndex].selected = false;
      this.currentPlanetIndex = index;
      this.planets[index].selected = true;

      if (this.isKey(this.currentPlanetIndex+1)) {
        this.displayedFriends  = this.allFriends[this.currentPlanetIndex + 1]; // +1 because the planet id starts at 1
      } else {
        this.displayedFriends = {};
      }
      
    },
    // Set the good avatar path according to the selected planet
     assignPlanetPath: function(index){
      for(var i = 0; i < this.planets.length ; i++){

        switch (this.planets[i].name) {
          case "Terre":
              this.planets[i].imagePath = "../assets/images/planets/Terre.svg";
              break;
          case "Paranose":
              this.planets[i].imagePath = "../assets/images/planets/Paranose.svg";
              break;
          case "Technome":
              this.planets[i].imagePath = "../assets/images/planets/Technome.svg";
              break;
          case "Sautien":
              this.planets[i].imagePath = "../assets/images/planets/Sautien.svg";
              break;
          case "Multas":
              this.planets[i].imagePath = "../assets/images/planets/Multas.svg";
              break;
          default:
              this.planets[i].imagePath = "../assets/images/planets/Terre.svg";
        } 
      }
    },    
  },
  data () {
      return {
        allFriends : {}, // All the user friends, ordered by planet
        displayedFriends : {}, // Friends displayed in the page
        currentPlanetIndex : 0,
        planets : {}
    }
  }
});


export default Friends;