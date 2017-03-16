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
    userId : Object
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
      /*Get all the user informations */
    this.getRouteParams();
   },
   methods: { 
    getRouteParams : function(){
      this.$http.get(apiRoot() + 'users/me').then((response) => {
          this.profil = response.data;
          console.log(JSON.stringify(response.data.username))
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
        console.log(response);
      });     
    }, 
    getPosts : function(route, option) {
      var data = { 'user' : this.profil.id }
      this.$http.get(apiRoot() + 'planets/' + this.profil.planetId + '/posts', {
          params : data
        },{
          emulateJSON: true 
        }).then((response) => {
          console.log(response);
          this.posts =  response.data;
      }, (response) => {
        console.log(response);
      });     

    },
    /*functions to manage interests*/
    showMore : function() {
      this.start = this.interests.length;
    },
    showLess : function() {
      this.start = 6;
    },
    addFriend : function() {
      //Router::post('/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend'); //ok
      this.$http.post(apiRoot() + "users/" + this.profil.id + "/add_friend", {emulateJSON: true}).then(
        (response) => {
          console.log("Demande envoyée");
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
      console.log("User : Adding friend");
    }
  },
  computed : {
    
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
