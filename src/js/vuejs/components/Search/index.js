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
    // Si on atterit sur cette page en ayant fait une recherche dans la barre de navigation, une recherche selon pseudonyme est lancée
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
       // tableau contenant toutes les informations de chaque planète
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
      // TABLEAU D'INTERETS SELECTIONNES PAR L'UTLISATEUR
      interestsPrint : [],
      // TABLEAU D INTERETS COCHES A ENVOYER A LA BDD : ne contient que des id
      interestsDB : [],
      // TABLEAU DE TITRES SELECTIONNES PAR L'UTLISATEUR
      titlesPrint : [],
      // TABLEAU DE TITRES COCHES A ENVOYER A LA BDD : ne contient que des id
      titlesDB : [],
      // PLANETE A ENVOYER A LA BDD, "" SI AUCUNE SELECTIONNEE
      activePlanet:  "",
      // SI AUCUN UTILISATEURS NE CORRESPOND, METTRE A FALSE
      usersExist : false,
      searchUserInput : "",
      currentPage: 1,
      morePage: true,
      planetId: 0,
      // ROUTE POUR ACCEDER A LA PAGE SUIVANTE CONTENANT D'AUTRES UTILISATEURS
      routeNextUser: '',
      // ROUTE POUR ACCEDER A LA PAGE PRECEDANTE CONTENANT D'AUTRES UTILISATEURS
      routePrevUser: '',
      // NOMBRE TOTAL D'UTILISATEURS RENVOYES PAR LA RECHERCHE
      totalUsers: '', 
      // DATA A ENVOYER A LA BDD
      dataForDB : {},
      alreadyInThePage: false
    }
  },

  created : function(){
     // fonction qui récupère la liste de tous les intérêts
    this.$http.get(apiRoot() + 'interest/view',{emulateJSON: true }).then(
        (response) => {
          this.filtersInterests = response.data;      
        },
        (response) => {
        });
     // fonction qui récupère la liste de tous les titres
    this.$http.get(apiRoot() + 'titles',{emulateJSON: true }).then(
        (response) => {
          this.filtersTitles = response.data;       
        },
        (response) => {
        });
  },
  methods : {
    // fonction qui récupère la liste de tous les utilisateurs renvoyés par le back.
    getUsers : function(route, data) {
        this.$http.get(apiRoot() + route, {
          params : data
        },{
          emulateJSON: true 
        }).then(
        (response) => {
          this.totalUsers = response.data[0]['count'];
          this.usersExist = (this.totalUsers == 0) ? false : true
          this.usersResult = response.data.slice(1,this.totalUsers+1);
          this.assignPlanetPath();

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
    // si le nombre total d'utilisateur est supérieur à 10, il y aura plus d'une page
    showMoreLink : function() {
      if (this.currentPage*10 < this.totalUsers) { 
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    },
    // Permet d'aller sur la page suivante
    showNextPage : function() {
      if (this.currentPage*10 < this.totalUsers) {
        this.currentPage++;
        this.getUsers(this.routeNextUser, this.dataForDB);
        this.showMoreLink();
      }
      
    },
    // Permet d'aller sur la page précédente
    showPrevPage : function() {
      this.currentPage--;
      this.getUsers(this.routePrevUser, this.dataForDB); 
      this.showMoreLink();
    },
    // Permet de sélectionner la planète active dans les filtres
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
    // donne un chemin à l'utilisateur pour l'image de la planète correspondante
    assignPlanetPath(){
      for(var i = 0; i < this.usersResult.length ; i++){
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
    // Permet de créer un tableau pour la bdd : seulement les id doivent être envoyés
    assignIdToTab(newTab, oldTab){
      for(var i = 0; i < oldTab.length ; i++){
        newTab[i] = oldTab[i].id;
      }
    },
    // permet de faire une recherche par pseudonyme
    searchBarUsername(value){
      this.dataForDB = {};    
      this.dataForDB = {username: value};
      this.getUsers('users/search?limit=10', this.dataForDB);    
    },
    // permet de faire une recherche personnalisée par filtres
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