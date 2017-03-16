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
import PageNav from '../PageNav/index.js'
import Deconnexion from '../Deconnexion/index.js'


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
    'page-nav' : PageNav,
    'deconnexion' : Deconnexion
     },
     watch: {
      /*Watch if the route of an other profil is required and updates the data*/
      '$route': function() {
            this.getRouteParams();
       }  
      },
    mounted : function() {
    this.getRouteParams();
   },
   methods: { 
    /*gets all the user information*/
    getRouteParams : function(){
      this.$http.get(apiRoot() + 'users/me').then((response) => {
          this.profil = response.data;
          if (this.$route.params.username == response.data.username){
            this.myself = true
            this.getNbFriends(apiRoot() + 'users/' + this.profil.id + '/number_friends');
            this.getInterest(apiRoot() + 'users/' + this.profil.id + '/interest');
            this.getPosts(apiRoot() + 'planets/' + this.profil.planetId + '/posts', { 'user' : this.profil.id });
            this.planetPath = "/assets/images/planets/" + this.profil.name +".svg";
            this.imagePath = "/assets/images/avatars/" + this.profil.name + "/" + this.profil.imagePath;
          } else {
            this.getUser(apiRoot() + 'users/' + this.$route.params.userId);
            this.myself = false
          }
          
      }, (response) => {
      })
    },
    /*gets the user nbFriends, profil info and Post if it is not the connected*/
   getUser : function(route){
      this.$http.get(route).then((response) => {
          this.profil = response.data;
          this.getNbFriends(apiRoot() + 'users/' + this.profil.id + '/number_friends');
          this.getInterest(apiRoot() + 'users/' + this.profil.id + '/interest');
          this.getPosts(apiRoot() + 'planets/' + this.profil.planetId + '/posts', { 'user' : this.profil.id });
           this.planetPath = "/assets/images/planets/" + this.profil.name +".svg";
            this.imagePath = "/assets/images/avatars/" + this.profil.name + "/" + this.profil.imagePath;
      }, (response) => {
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
      });     
    }, 
    /*get the post from a specific user*/
    getPosts : function(route, option) {
      var data = { 'user' : this.profil.id }
      this.$http.get(apiRoot() + 'planets/' + this.profil.planetId + '/posts', {
          params : data
        },{
          emulateJSON: true 
        }).then((response) => {
          this.posts =  response.data;
      }, (response) => {
      });     

    },
    /*functions to manage interests*/
    showMore : function() {
      this.start = this.interests.length;
    },
    showLess : function() {
      this.start = 6;
    },
    /* send friend request to visited profil*/
    addFriend : function() {
      this.$http.post(apiRoot() + "users/" + this.profil.id + "/add_friend", {emulateJSON: true}).then(
        (response) => {
        },
        (response) => {
          switch(response.status) {
            case 401:
              this.$router.push('/erreur401')
            break;
            case 403:
              this.$router.push('/erreur403')
            break;
            default:
                this.$router.push('/erreur')
          }
        });
    }
  },
  data () {
      return {
        updated : false,
        profil : {},
        imagePath : '',
        planetPath : '',
        interests : [],
        nbRiddleSolved : 0,
        myself : false,
        nbFriends : '',
        start : 6,
        posts : {}
  }

  }
});


export default User;
