'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import PageNav from '../PageNav/index.js'
import UserComponent from './UserComponent/index.js'
import Deconnexion from '../Deconnexion/index.js'


const Search = Vue.extend({
  template, 
  components: {
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'page-nav' : PageNav,
    'user-component' : UserComponent,
    'deconnexion' : Deconnexion
  },
  computed: {
    searchUser:function(){
      if((this.$route.params.searchInput != "") && !(this.alreadyInThePage)){
        this.alreadyInThePage = true;
        this.searchBarUsername(this.$route.params.searchInput);
      }        
      return this.$route.params.searchInput;
    } 
  },
  data () {
    return {
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
        path:"/assets/images/planets/Multas.svg",
        id:5,
        name:"Multas",
        value:false
      }],
      // Liste des intérêts 
      filtersInterests : {},
      // Liste des titres
      filtersTitles : {},
      
      interestSelected : "Sélectionner",
      titleSelected : "Sélectionner",
      // LISTE DES UTILISATEURS RENVOYES
      usersResult : {},
      // TABLEAU D INTERETS COCHES A ENVOYER A LA BDD
      interestsPrint : [],
      interestsDB : [],
      // TABLEAU DE TITRES COCHES A ENVOYER A LA BDD
      titlesPrint : [],
      titlesDB : [],
      // PLANETE A ENVOYER A LA BDD, "" SI AUCUNE SELECTIONNEE
      activePlanet:  "",
      // SI AUCUN UTILISATEURS NE CORRESPOND, METTRE A FALSE
      usersExist : false,
      searchUserInput : "",


      currentPage: 1,
      morePage: true,
      planetId: 0,
      routeNextUser: '',
      routePrevUser: '',
      totalUsers: '', 
      dataForDB : {},
      alreadyInThePage: false
    }
  },
  created : function(){
    this.$http.get(apiRoot() + 'interest/view',{emulateJSON: true }).then(
        (response) => {
          this.filtersInterests = response.data;      
        },
        (response) => {
        });
    this.$http.get(apiRoot() + 'titles',{emulateJSON: true }).then(
        (response) => {
          this.filtersTitles = response.data;       
        },
        (response) => {
        });
  },
  methods : {
    getUsers : function(route, data) {
        this.$http.get(apiRoot() + route, {
          params : data
        },{
          emulateJSON: true 
        }).then(
        (response) => {
          console.log("coucou 2");
          console.log(JSON.stringify(response.data));
          this.totalUsers = response.data[0]['count'];
          console.log("coucou");
          console.log(this.totalUsers);
          this.usersResult = response.data.slice(1,this.totalUsers);
          
          this.assignPlanetPath();
          this.usersExist = true;

          var linkNext = response.headers.get("Link").split(",")[0].split(";")[0];
          this.routeNextUser = linkNext.substring(2, linkNext.length-1);

          var linkPrev = response.headers.get("Link").split(",")[1].split(";")[0];
          this.routePrevUser = linkPrev.substring(2, linkPrev.length-1);
        },
        (response) => {
          this.usersExist = false;
          this.usersResult = {};
        });
         
    },
    showMoreLink : function() {
      if (this.currentPage*10 < this.totalUsers) { //10 à changer
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    },
    // A TESTER
    showNextPage : function() {
      if (this.currentPage*10 < this.totalUsers) {//10 à changer
        this.currentPage++;
        this.getUsers(this.routeNextUser, this.dataForDB);
        this.showMoreLink();
      }
      
    },
    // A TESTER
    showPrevPage : function() {
      this.currentPage--;
      this.getUsers(this.routePrevUser, this.dataForDB); 
      this.showMoreLink();
    },


    // Permet de sélectionner la planète active
    toggleActive(filter){
      for(var i = 0; i < this.filtersPlanets.length ; i++){
        if(filter.id == this.filtersPlanets[i].id){
          if(filter.value){
            this.filtersPlanets[i].value = false;
            this.activePlanet = -"";
          }else{
            this.filtersPlanets[i].value = true;
            this.activePlanet = filter.id;
          }
        }else{
          this.filtersPlanets[i].value = false;
        }
        
      } 
    },
    // donne un chemin pour l'image de la planète correspondante
    assignPlanetPath(){
      for(var i = 0; i < this.usersResult.length ; i++){
        // a enlever quand fonction updater
        var planet = this.tabFind(this.usersResult[i].planetId, this.filtersPlanets);
        this.usersResult[i].planetPath = planet.path;
      }

    },
    // Trouve un objet dans un tableau en fonction de l'id envoyé
    tabFind(id, tab){
      for(var i = 0; i < tab.length ; i++){
        if(tab[i].id == id){
          return tab[i];
        }
      }
    },
    // Vérifie que l'id n'existe pas déjà dans le tableau
    noDouble(id, tab){
      for(var i = 0; i < tab.length ; i++){
        if(tab[i].id == id){
          return false;
        }
      }
      return true;
    },
     // Rajoute un objet dans le tableau
    tabAdd(id, tab, oldTab){
      if(this.noDouble(id, tab))
        tab.push(this.tabFind(id, oldTab));
      if(this.filtersTitles == oldTab){
        this.titleSelected = "Sélectionner";
      }else if(this.filtersInterests == oldTab){
        this.interestSelected = "Sélectionner";
      }
    },
    // Enlève un objet dans le tableau
    tabDelete(index, tab){
      tab.splice(index,1);
    },
    assignIdToTab(newTab, oldTab){
      for(var i = 0; i < oldTab.length ; i++){
        newTab[i] = oldTab[i].id;
      }
    },
    searchBarUsername(value){
      this.dataForDB = {};    
      this.dataForDB = {username: value};
      this.getUsers('users/search?limit=10', this.dataForDB);    
    },
    searchBarFilters(){
      this.titlesDB = [];
      this.interestsDB = [];

      this.assignIdToTab(this.titlesDB, this.titlesPrint);
      this.assignIdToTab(this.interestsDB, this.interestsPrint);

      this.dataForDB = {};
      if ( this.titlesDB.length > 0 ) {
          this.dataForDB.title = this.titlesDB;
      }
      if ( this.interestsDB.length > 0 ) {
          this.dataForDB.interest = this.interestsDB ;
      }
      if(this.activePlanet != ""){
        this.dataForDB.planet = this.activePlanet ;
      }


      this.getUsers('users/search?limit=10', this.dataForDB);
      
    }

    
  }
    

});


export default Search;