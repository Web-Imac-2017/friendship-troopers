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
      // RECUPERER LISTE TITLES DANS BDD : enlever apres
      filtersTitles: [{
        id:4,
        name:"Alien"
      },{
        id:2,
        name:"Seigneur des abricots"
      },{
        id:3,
        name:"Lord de l'enfer"
      }],
      // RECUPERER LISTE INTERESTS DANS BDD : enlever apres
      /*filtersInterests: [{
        id:4,
        name:"Jazz"
      },{
        id:7,
        name:"La piscine"
      },{
        id:3,
        name:"Dormir"
      },{
        id:1,
        name:"Les champignons"
      },{
        id:5,
        name:"Les pieds"
      },{
        id:6,
        name:"Sherlock Holmes"
      }],*/
      filtersInterests : {},
      searchUser : "",
      interestSelected : "Sélectionner",
      titleSelected : "Sélectionner",
      // ENLEVER QUAND LIEN AVEC BDD
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


      currentPage: 1,
      morePage: true,
      planetId: 0,
      routeNextUser: '',
      routePrevUser: '',
      totalUsers: 7,

    }
  },
  created : function(){
    this.$http.get(apiRoot() + 'interest/view',{emulateJSON: true }).then(
        (response) => {
          this.filtersInterests = response.data;
          console.log("liste d'interets");
          console.log(JSON.stringify(response.data));
          (this.filtersInterests.length > 0) ? console.log(this.filtersInterests[0].id) : console.log("vide");
            
        },
        (response) => {
          console.log("Error liste interests");
          console.log(response);
        });
  },
  methods : {
    getUsers : function(route, data) {
        this.$http.get(apiRoot() + 'users/search?limit=2', {
          params : data
        },{
          emulateJSON: true 
        }).then(
        (response) => {

           console.log("Bonne reponse de users/search ");
          this.usersResult = response.data;
          this.totalUsers = this.usersResult.length;
          this.assignPlanetPath();
         // console.log(this.usersResult[0]);

          this.usersExist = (this.usersResult.length > 0) ? true : false;

          var linkNext = response.headers.get("Link").split(",")[0].split(";")[0];
          this.routeNextUser = apiRoot() + linkNext.substring(2, linkNext.length-1);

          var linkPrev = response.headers.get("Link").split(",")[1].split(";")[0];
          this.routePrevUser = apiRoot() + linkPrev.substring(2, linkPrev.length-1);
        },
        (response) => {
          console.log("Erreur getUsers ");
          this.usersExist = false;
          this.usersResult = {};
          console.log(response);
        });
         
    },
    // A TESTER
    showNextPage : function() {
      if (this.currentPage*2 < this.totalUsers) {
        this.currentPage++;
        this.getUsers(this.routeNextUser);
      }
      if (this.totalUsers-(this.currentPage*2) > 2) {
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    },
    // A TESTER
    showPrevPage : function() {
      this.currentPage--;
      this.getUsers(this.routePrevUser);
      if (this.totalUsers-(this.currentPage*2) < 2) {
        this.morePage = true;
      } else {
        this.morePage = false;
      }
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
    searchBarUsername(){
      var data = {username: this.searchUser};
      this.getUsers(apiRoot() + 'users/search', data);    
    },
    searchBarFilters(){
      this.titlesDB = [];
      this.interestsDB = [];

      this.assignIdToTab(this.titlesDB, this.titlesPrint);
      this.assignIdToTab(this.interestsDB, this.interestsPrint);

      var data = {};
      if ( this.titlesDB.length > 0 ) {
          data.title = this.titlesDB;
      }
      if ( this.interestsDB.length > 0 ) {
          data.interest = this.interestsDB ;
      }
      if(this.activePlanet != ""){
        data.planet = this.activePlanet ;
      }

      console.log(data);
      this.getUsers(apiRoot() + 'users/search', data);
      
    }

    
  }
    

});


export default Search;