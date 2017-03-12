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
import NavBar from '../NavBar/index.js'
import PageNav from "../Feed/PageNav/index.js"


const User = Vue.extend({
  template,
  props : {
    userId : Number
  }
  ,
   components: {
    'option-bar' : optionBar, 
    'lateral-menu-left' : LateralMenuLeft,
    'lateral-menu-right' : LateralMenuRight, 
    'menu-tools' : MenuTools, 
    'post' : Post,
    'navbar' : NavBar,
    'page-nav' : PageNav },
  created : function() {
    this.getRouteParams();
   },
   methods: { 
    getRouteParams : function(){
        if (this.$route.params.user == 'me'){
        this.getUser(apiRoot() + 'users/me');
        this.myself = true;
      } else {
        this.getUser(apiRoot() + 'users/' + this.$route.params.userId);
        this.myself = false;
      }
    },
   getUser : function(route){
      this.$http.get(route).then((response) => {
          this.profil = response.data[0];
          console.log(response);
          this.getNbFriends(apiRoot() + 'users/' + this.profil.id + '/number_friends');
          this.getInterest(apiRoot() + 'users/' + this.profil.id + '/interest');
          this.getPosts(apiRoot() + '/planets/' + this.profil.planetId + '/posts', { 'user' : this.profil.id});
      }, (response) => {
        console.log(response);
      })
   },    
    getInterest : function(route){
      this.$http.get(route).then((response) => {
        this.interests = response.data;
      }, (response) => {
        console.log(response);
      });

    }, getNbFriends : function(route){
      this.$http.get(route).then((response) => {
        this.nbFriends =  response.data.count;
      }, (response) => {
        console.log(response);
      });     
    }, 
    getPosts : function(route) {
      this.$http.get(route).then((response) => {
          console.log(response);
        // this.pos =  response.data.count;
      }, (response) => {
        console.log(response);
      });     
    },
    showMore : function() {
      this.start = this.user.interests.length;
    },
    showLess : function() {
      this.start = 5;
    }
  },
  updated : function() {
 
    if (this.myself){
      if (this.$route.params.user != 'me') {
        this.updated = true;
      }
    } else {
      if (this.$route.params.user != this.profil.username) {
          this.updated = true;
       }
    }

    console.log(this.updated);
    /*if (this.updated) {
      this.getRouteParams();
      this.updated = false;
    }*/
  },
  computed : {
    planetName : function() {
      return this.planetPath = "/assets/images/planets/" + this.profil.name +".svg";
    } 
  },
  data () {
      return {
        updated : false,
        profil : {},
        planetPath : '',
        interests : [],
        nbRiddleSolved : 0,
        myself : false,
        nbFriends : '',
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
        points : 745,
        interests : [ "natation", "tigrous", "francois fillion", "caniches", "cachalots",
        "nadine morano", "trumpette"],
        
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
