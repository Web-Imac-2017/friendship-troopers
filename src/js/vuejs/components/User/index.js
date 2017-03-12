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
          this.getNbFriends(apiRoot() + 'users/' + this.profil.id + '/number_friends');
          this.getInterest(apiRoot() + 'users/' + this.profil.id + '/interest');
          this.getPosts(apiRoot() + 'planets/' + this.profil.planetId + '/posts', { 'user' : 2});
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
    getPosts : function(route, option) {
      this.$http.get(route, option, {emulateJSON : true}).then((response) => {
          console.log(response);
          this.posts =  response.data;
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
 
    console.log(this.$route.params);
 /*   if (this.myself){
      if (this.$route.params.user != 'me') {
        this.updated = true;
        this.myself = false;
      }
    } else {
      if (this.$route.params.user != this.profil.username) {
          this.updated = true;
       }
    }

    console.log("updates" + this.updated);
    if (this.updated) {
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
        posts : {}
  }

  }
});


export default User;
