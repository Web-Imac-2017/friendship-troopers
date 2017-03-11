'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import Post from '../Post/index.js'
import optionBar from './OptionBar/index.js'
import statistics from './Statistics/index.js'
import NavBar from '../NavBar/index.js'
import PageNav from "../Feed/PageNav/index.js"


const User = Vue.extend({
  template,
   components: {
    'option-bar' : optionBar, 
    'statistics' : statistics, 
    'lateral-menu-left' : LateralMenuLeft,
    'lateral-menu-right' : LateralMenuRight, 
    'menu-tools' : MenuTools, 
    'post' : Post,
    'navbar' : NavBar,
    'page-nav' : PageNav },
  created : function() {
       this.getProfil(apiRoot() + 'users/me'); 

  },
   methods: {
    profilType: function(){
      if (this.myself) {
        this.myself = false;
        this.user.myself = false;
      } else {
         this.myself = true;
        this.user.myself = true;
      }
       
    }, 
    getProfil : function(route) {
       this.$http.get(route,{ emulateJSON: true }).then((response) => {
          this.profil = response.data;
          console.log(JSON.stringify(this.profil));
      }, (response) => {
        console.log(response);
      })
     
    this.$http.get(apiRoot() + 'users/1/interest').then((response) => {
      console.log(response);
    }, (response) => {
      console.log(response);
    });
    }
  }, 
  data () {
      return {
        profil : {},
        start : 5,
       user: {
        userAvatar : '/assets/images/avatars/Multas/aliens.svg',
        username : 'LuckyPon', 
        userBadge : 'Baroudeuse de l\'espace', 
        birthDate : '29 avril',
        userPlanet : {
          path : '/assets/images/planets/Paranose.svg',
          name : 'Planete X785-E'
        }, 
        nbFriends : 53, 
        nbRiddleSolved : 2,
        points : 745,
        interests : [ "natation", "tigrous", "francois fillion", "caniches", "cachalots",
        "nadine morano", "trumpette"],
        myself : false
      }, post :
        {
            user: 'Lucky',
            avatar : "/assets/images/avatars/Technome/landscape.svg",
            planeteId : 3,
            date: '20 fev',
            hour: '12h04',
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque. BLJozeuoaugoeugo',
            likes: 50,
            comments: [
            {
              user : "Moi",
               planeteId : 2,
              avatar : "/assets/images/avatars/Paranose/astro.svg",
              content : "la vie c'est du kiri",
              date: '20 fev',
              hour: '12h04'
            }, {
              user : "Toi",
               planeteId : 2,
              avatar : "/assets/images/avatars/Paranose/astro.svg",
              content : "Non, la vie c'est du kiwi",
              date: '20 fev',
              hour: '12h04'
            }
            ],
            id : 2
          },
      myself : false
  }

  }
});


export default User;
