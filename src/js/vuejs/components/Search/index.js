'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import PageNav from '../Feed/pageNav/index.js'
import UserComponent from './UserComponent/index.js'


const Search = Vue.extend({
  template, 
  components: {
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'page-nav' : PageNav,
    'user-component' : UserComponent
  },
  data () {
    return {
      users : [{   
        username: 'LuckyPon',
        title: "Seigneur de l'enfer",
        avatar : "/assets/images/avatars/Paranose/astro.svg",
        planeteId : 2,
        planetPath : "/assets/images/planets/Paranose.svg",
        result:false
      },{
        username: 'LuckyPon',
        title: "Seigneur des abricots",
        avatar : "/assets/images/avatars/Technome/landscape.svg",
        planeteId : 3,
        planetPath : "/assets/images/planets/Technome.svg",
        result:false
      },{
        username: 'JulieCapucine',
        title: "Lady Jolie",
        avatar : "/assets/images/avatars/Sautien/dashboard.svg",
        planeteId : 4,
        planetPath : "/assets/images/planets/Sautien.svg",
        result:false
      },{
        username: 'LuckyPon',
        title: "Alien",
        avatar : "/assets/images/avatars/Terre/dashboard.svg",
        planeteId : 1,
        planetPath : "/assets/images/planets/Terre.svg",
        result:false
      }],
      usersResult : [],
      filtersTab : [{
        name:"Pseudo",
        value:false
      },{
        name:"Titre honorifique",
        value:false
      },{
        name:"Centre d'intérêts",
        value:false
      },{
        name:"Planète",
        value:false
      },{
        name:"Tous",
        value:true
      }],
      search : "LuckyPon"
    }
  },
  methods:{
    toggleActive(filter){
      for(var i = 0; i < this.filtersTab.length ; i++)
        this.filtersTab[i].value = false;
      filter.value = true;
    },
    requestUsersResult(){
      for(var i = 0; i < this.users.length ; i++){
        if(this.users[i].result == true){
          this.usersResult.push(this.users[i]);
        }
        
      }
    },
    reinitialize(){
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = false;
      }
      this.usersResult = [];
    },
    // FAIRE EN SORTE QU'UNE PARTIE DE LA CHAINE DE CARACTERE SOIT VRAI !
    searchUsername(){
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.search == this.users[i].username) ? true : false;
      }
    },
    searchTitle(){
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.search == this.users[i].title) ? true : false;
      }
    },
    searchPlanet(){ // A FAIRE
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.search == this.users[i].title) ? true : false;
      }
    },
    searchInterests(){ // A FAIRE
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.search == this.users[i].title) ? true : false;
      }
    },
    searchAll(){ // A FAIRE
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.search == this.users[i].username) ? true : false;
      }
    },
    searchBar(){
      this.reinitialize();
      if(this.filtersTab[0].value)
        this.searchUsername();
      else if(this.filtersTab[1].value)
        this.searchTitle();
      else if(this.filtersTab[2].value)
        this.searchInterests();
      else if(this.filtersTab[3].value)
        this.searchPlanet();
      else if(this.filtersTab[4].value)
        this.searchAll();
      
      
      this.requestUsersResult();
      
    }
  },
  created(){
    // TEST POUR VOIR SI ON EST LOGIN
    /*this.$http.post(apiRoot() + 'planets/1/posts', 
	   	{
	   		'content' : "contenttttttt", 
	   		'title': "titleeeeee" 
	   	},{
          emulateJSON: true
        }).then(
          (response) => {
            
            console.log("success !");
          },
          (response) => {
            console.log("fail !");
            console.log(response);
            if(response.status == 401){
            	console.log("connectez vous !!!");
            	this.$router.push({
                name: 'Login' 
            });
            }
            	
          }
        )*/

// FAIRE RIEN NE CORRESPOND A LA RECHERCHE
  }
});


export default Search;