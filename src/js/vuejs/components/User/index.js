'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import FriendTemplate from '../FriendTemplate/index.js'
import Post from '../Post/index.js'
import optionBar from './optionBar/index.js'
import statistics from './Statistics/index.js'

const User = Vue.extend({
  template,
   components: {
    'option-bar' : optionBar, 
    'statistics' : statistics, 
    'lateral-menu-left' : LateralMenuLeft,
    'lateral-menu-right' : LateralMenuRight, 
    'menu-tools' : MenuTools, 
    'post' : Post },
   methods: {
    profil: function(){
      if (this.myself)
        this.myself = false
      else 
        this.myself = true
      console.log(this.myself)
    }
  }, 
  data () {
      return {
       user: {
        userAvatar : '../assets/logo.png',
        username : 'LuckyPon', 
        userBadge : 'Baroudeuse de l\'espace', 
        birthDate : '29 avril',
        userPlanet : {
          path : '../assets/Avatar1.svg',
          name : 'Planete X785-E'
        }, 
        nbFriends : 53, 
        nbRiddleSolved : 2,
        points : 745,
        lastBadges : 
          [ { path  : '../assets/logo.png',
            name : 'Resoudre une énigme'},
            { path : '../assets/logo.png',
            name : 'Ajouter un ami'},
            { path : '../assets/logo.png',
            name : 'Inscription'}
          ]
       }, 
       myself : false
    }

  }
});


export default User;
