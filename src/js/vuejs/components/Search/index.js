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
        interest : "Dormir",
        planetPath : "/assets/images/planets/Paranose.svg",
        result:false
      },{
        username: 'LLittlePonyn',
        title: "Seigneur des abricots",
        avatar : "/assets/images/avatars/Technome/landscape.svg",
        planeteId : 3,
        interest : "Dormir",
        planetPath : "/assets/images/planets/Technome.svg",
        result:false
      },{
        username: 'JulieCapucine',
        title: "Lady Jolie",
        avatar : "/assets/images/avatars/Sautien/dashboard.svg",
        planeteId : 4,
        interest : "Dormir",
        planetPath : "/assets/images/planets/Sautien.svg",
        result:false
      },{
        username: 'LuckyPonnette',
        title: "Alien",
        avatar : "/assets/images/avatars/Terre/dashboard.svg",
        planeteId : 1,
        interest : "Dormir",
        planetPath : "/assets/images/planets/Terre.svg",
        result:false
      }],
      filtersPlanets: [{
        path:"/assets/images/planets/Terre.svg",
        id:1,
        name:"Terre",
        value:false
      },{
        path:"/assets/images/planets/Paranose.svg",
        id:2,
        name:"Paranose",
        value:false
      },{
        path:"/assets/images/planets/Technome.svg",
        id:3,
        name:"Technome",
        value:false
      },{
        path:"/assets/images/planets/Sautien.svg",
        id:4,
        name:"Sautien",
        value:false
      },{
        path:"/assets/images/planets/P1.svg",
        id:5,
        name:"Multas",
        value:false
      }],
      filtersTitles: [{
        id:1,
        name:"Alien"
      },{
        id:2,
        name:"Seigneur des abricots"
      },{
        id:3,
        name:"Seigneur de l'enfer"
      }],
      filtersInterests: [{
        id:1,
        name:"Jazz"
      },{
        id:2,
        name:"La piscine"
      },{
        id:3,
        name:"Dormir"
      }],
      searchUser : "LuckyPon",
      interestSelected : "Sélectionner",
      titleSelected : "Sélectionner",
      usersResult : [],
      interestsPrint : [],
      titlesPrint : [],
      activePlanet:  -1,
      usersExist : false
    }
  },
  methods:{
    toggleActive(filter){
      for(var i = 0; i < this.filtersPlanets.length ; i++){
        if(filter.id == this.filtersPlanets[i].id){
          if(filter.value){
            this.filtersPlanets[i].value = false;
            this.activePlanet = -1;
          }else{
            this.filtersPlanets[i].value = true;
            this.activePlanet = filter.id;
          }
        }else{
          this.filtersPlanets[i].value = false;
        }
        
      } 
    },
    requestUsersResult(){
      for(var i = 0; i < this.users.length ; i++){
        if(this.users[i].result == true){
          this.usersResult.push(this.users[i]);
        }
      }
    },
    tabFind(id, tab){
      for(var i = 0; i < tab.length ; i++){
        if(tab[i].id == id){
          return tab[i];
        }
      }
    },
    noDouble(id, tab){
      for(var i = 0; i < tab.length ; i++){
        if(tab[i].id == id){
          return false;
        }
      }
      return true;
    },
    tabAdd(id, tab, oldTab){
      if(this.noDouble(id, tab))
        tab.push(this.tabFind(id, oldTab));
      if(this.filtersTitles == oldTab){
        this.titleSelected = "Sélectionner";
      }else if(this.filtersInterests == oldTab){
        this.interestSelected = "Sélectionner";
      }
    },
    tabDelete(index, tab){
      tab.splice(index,1);
    },
    reinitialize(){
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = false;
      }
      this.usersResult = [];
    },
    searchUsername(){
      for(var i = 0; i < this.users.length ; i++){
        this.users[i].result = (this.searchUser == this.users[i].username) ? true : false;
      }
    },
    searchFilters(){
      for(var i = 0; i < this.users.length ; i++){
        if(this.titlesPrint.length > 0)
          this.users[i].result = (this.titlesPrint[0].name == this.users[i].title) ? true : false;
      }
      // REQUETE ICI, ENVOI DE interestsPrint, titlesPrint et activePlanet
      // RECUPERER LISTE USERS 

    },
    searchBarUsername(){
      this.reinitialize();
      this.searchUsername();
      this.requestUsersResult();
      if(this.usersResult.length > 0)
        this.usersExist = true;
      else
        this.usersExist = false;
      
    },
    searchBarFilters(){
      this.reinitialize();
      this.searchFilters();
      this.requestUsersResult();
      if(this.usersResult.length > 0)
        this.usersExist = true;
      else
        this.usersExist = false;
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

  }
});


export default Search;