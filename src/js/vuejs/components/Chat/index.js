'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import Deconnexion from '../Deconnexion/index.js'
import MenuTools from '../MenuTools/index.js'
import NotDone from '../NotDone/index.js'

const Chat = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar,
  	'lateral-menu-left' : LateralMenuLeft,
  	'deconnexion' : Deconnexion,
  	'menu-tools' : MenuTools,
    'not-done' : NotDone
  }, 
  created : function(){
    this.$http.get(apiRoot() + 'users/me/friends').then((response) => {
      // gérer le succes, toutes les infos renvoyer sont dans response.data      
        this.allFriends = response.data;
      }, (response) => {
      });
  },
  computed: {
    // a computed getter
    stringIndex: function () {
      var array = [];
      for (var i = 0; i < this.planetData.length; i++){
        array[i] = i.toString();
      }
      return array;
    }
  },
  methods : {
    showFriends : function(){
      if (this.showAllFriends == true)
        this.showAllFriends = false
      else
        this.showAllFriends = true
    },
    showLastsFriendsResponsive : function(){
      if (this.showLastsResponsiveFriends == true)
        this.showLastsResponsiveFriends = false
      else 
        this.showLastsResponsiveFriends = true

      this.showAllResponsiveFriends = false

    },
    showAllFriendsResponsive : function(){
      if (this.showAllResponsiveFriends == true)
        this.showAllResponsiveFriends = false
      else
        this.showAllResponsiveFriends = true

      this.showLastsResponsiveFriends = false

    },
  	active : function(index){
  		this.friends[this.currentSelected].selected = false;
  		this.friends[index].selected = true;
  		this.currentSelected = index;
  	},
    postNewMessage : function(){
      console.log(this.newMessage);
      this.newMessage = '';
    },
    createNewConv : function(friend){
      friend["selected"] = false;
      this.friends.unshift(friend);
      this.showFriends();
      console.log(JSON.stringify(this.friends))
    },
    createNewConvResponsive : function(friend){
      friend["selected"] = false;
      this.friends.unshift(friend);
      this.showAllFriendsResponsive();
      console.log(JSON.stringify(this.friends))
    }
  },
  data () {
  	return {
      allFriends : [
      ],
      newMessage: '',
  		date : '17 fevrier 1980',
  		currentSelected : 0,
  		friends : [
    		{
    			username : "George Micheal",
    			imagePath : "/assets/images/avatars/Multas/aliens.svg",
    			planet : 5,
    			selected : false
    		}, {
    			username : "John Lennon",
    			imagePath : "/assets/images/avatars/Paranose/astro.svg",
    			planet : 2,
    			selected : false
     		},
    		{
    			username : "Patti Smith",
    			imagePath : "/assets/images/avatars/Sautien/dashboard.svg",
    			planet : 4,
    			selected : false

    		}, {
    			username : "Nina Hagen",
    			imagePath : "/assets/images/avatars/Multas/aliens.svg",
    			planet : 5,
    			selected : false

    		}, {
    			username : "Genesis",
    			imagePath : "/assets/images/avatars/Paranose/astro.svg",
    			planet : 2,
    			selected : false

    		},
    		{
    			username : "Cindy Laupers",
    			imagePath : "/assets/images/avatars/Sautien/dashboard.svg",
    			planet : 4,
    			selected : false

    		}
      ], 
      conversation : [
        {
          time : '12h50',
          content : 'Unicorns are real, I swear',
          sender : 1
        }, {
          time : '12h52',
          content : 'Fuck Yeah',
          sender : 0
        },
        {
          time : '12h50',
          content : 'Pffff',
          sender : 1
        },{
          time : '12h50',
          content : 'Non, en vrai t\'as raison, même que le sang de licorne ca fait survivre! #HarryPotter',
          sender : 1
        }
      ],
  		myself : {
  			avatar : '/assets/images/avatars/Sautien/dashboard.svg'
  		}, 
      showAllFriends : false,
      showLastsResponsiveFriends : false,
      showAllResponsiveFriends : false,
      planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
  	}
  }
});


export default Chat;