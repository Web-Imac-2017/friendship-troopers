'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
import LateralMenuLeft from '../LateralMenuLeft/index.js'
import Deconnexion from '../Deconnexion/index.js'
import MenuTools from '../MenuTools/index.js'

const Chat = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar,
  	'lateral-menu-left' : LateralMenuLeft,
  	'deconnexion' : Deconnexion,
  	'menu-tools' : MenuTools
  }, 
  created : function(){
    this.$http.get(apiRoot() + 'users/me/friends').then((response) => {
      // gérer le succes, toutes les infos renvoyer sont dans response.data      
        this.allFriends = response.data;
        console.log(response.data["1"]);
        console.log(JSON.stringify(response.data["1"]));
      }, (response) => {
      });
    console.log(this.planetData.length)
     console.log(this.allFriends[1])

  },
  computed: {
    // a computed getter
    stringIndex: function () {
      var array = [];
      for (var i = 0; i < this.planetData.length; i++){
        array[i] = i.toString();
      }
      console.log(array)
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
    			name : "George Micheal",
    			avatar : "/assets/images/avatars/Multas/aliens.svg",
    			planete : "Multas",
    			selected : false
    		}, {
    			name : "John Lennon",
    			avatar : "/assets/images/avatars/Paranose/astro.svg",
    			planete : "Paranose",
    			selected : false
     		},
    		{
    			name : "Patti Smith",
    			avatar : "/assets/images/avatars/Sautien/dashboard.svg",
    			planete : "Sautien",
    			selected : false

    		}, {
    			name : "Nina Hagen",
    			avatar : "/assets/images/avatars/Multas/aliens.svg",
    			planete : "Multas",
    			selected : false

    		}, {
    			name : "Genesis",
    			avatar : "/assets/images/avatars/Paranose/astro.svg",
    			planete : "Paranose",
    			selected : false

    		},
    		{
    			name : "Cindy Laupers",
    			avatar : "/assets/images/avatars/Sautien/dashboard.svg",
    			planete : "Sautien",
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