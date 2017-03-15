'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';
import MessagesSubMenu from './MessagesSubMenu/index.js';
import FriendsSubMenu from './FriendsSubMenu/index.js';
import DashboardSubMenu from './DashboardSubMenu/index.js';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const NavBar = Vue.extend({
  template,
  components : {
    'friends' : FriendsSubMenu,
    'messages' : MessagesSubMenu,
    'dashboard' : DashboardSubMenu
  },
  created : function() {
    this.getUser();
    this.actualizeFriendsRequest();
  },
  methods: {
    getUser : function() {
      this.$http.get(apiRoot() + "users/me", {emulateJSON: true}).then(
        (response) => {
          this.user = response.data;
        },
        (response) => {

        }
        );
    },
    actualizeFriendsRequest : function() {
      this.$http.get(apiRoot() + "/users/me/waiting_list_friend", { emulateJSON: true }).then(
      (response) => {
        this.friendsRequest = response.data;
      },
      (response) => {
      });
    },
    showSearch: function(){
      if (this.search == 1) 
        this.search = 0
      else {
        this.search = 1
      }
    },
    showSubMenu: function(idMenu){
      if (this.subMenu == idMenu) 
        this.subMenu = 0
      else {
        this.subMenu = idMenu
      }
    },
    searchUsername: function(){
      if(this.searchByUser != ""){
        this.$router.push({
            name: 'Search',
            params: { searchInput : this.searchByUser }
        });
      }
      
    }
  }, 
   data () {
      return {
        searchByUser : "",
        friendsRequest : [],
        messages: [ {pseudo: 'luckypon',avatar:'/assets/images/avatars/Terre/astro.svg', planet :'earth', content:"Ok, comment ç va, t'as reçu un vélociratop à noel ? Oki doc !", date : '12/03/13'},
                    {pseudo: 'tintin', avatar:'/assets/images/avatars/Multas/landscape.svg', planet :'Multas', content:"Je t'envoie un message toto !", date : '11/02/12'},
                    {pseudo: 'kirikoukou', avatar:'/assets/images/avatars/Multas/landscape.svg', planet :'Multas', content:"Je t'envoie un message toto !", date : '01/03/13'}
                 ], 
        notifications: [
        /*  type 1 : post intergalactique / type 2 : ami news  /  type 3 : last post */
                    {type:'1', post:'4'},
                    {type:'2', post:'2', pseudo: 'hihi', avatar:'/assets/images/avatars/Terre/astro.svg', planet :'Terre'},     
                    {type:'3', post:'3'}     
        ], 
        subMenu : 0,
        pseudo : 'luckypon',
        avatar : '/assets/images/avatars/Terre/astro.svg',
        search : 0,
        user: {}

        // subMenu : 0 /*1:friends / 2: messages / 3: notif*/
      }
    }
});


export default NavBar;