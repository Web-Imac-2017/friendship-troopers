'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import Deconnexion from '../Deconnexion/index.js'
import Post from '../Post/index.js'
import CreatePost from '../CreatePost/index.js'
import PageNav from './pageNav/index.js'
import NavBar from '../NavBar/index.js';

const Feed = Vue.extend({
  template,
  components: { 
  	'create-post' : CreatePost, 
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight, 
    'menu-tools' : MenuTools, 
    'deconnexion' : Deconnexion, 
  	'post' : Post ,
    'page-nav' : PageNav,
    'navbar' : NavBar
  },
  created : function(){
  },
  mounted : function() {
    // Récupérer les premiers posts de la planète de l'utilisateur
    this.planetId = this.$refs.menu.user.planetId;
    console.log(this.planetId);
    this.getPublications(apiRoot() + 'planets/'+ this.planetId + '/posts');
  },
  methods : {
    getPublications : function(route) {
      this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
          this.bddPosts = response.data;

          var linkNext = response.headers.get("Link").split(",")[0].split(";")[0];
          this.routeNextPost = apiRoot() + linkNext.substring(2, linkNext.length-1);

          var linkPrev = response.headers.get("Link").split(",")[1].split(";")[0];
          this.routePrevPost = apiRoot() + linkPrev.substring(2, linkPrev.length-1);

        },
        (response) => {
          console.log("Feed : getPublications " + response);
        });
    },
    showNextPage : function() {
      console.log("Feed : Next page");
      this.getPublications(this.routeNextPost);
    },
    showPrevPage : function() {
      console.log("Feed : Previous page");
      this.getPublications(this.routePrevPost);
    }
  },
  data () {
   	return {
      planetId: 0,
      bddPosts: {},
      routeNextPost: '',
      routePrevPost: '',
      totalPublications: 15
    }
  }
});


export default Feed;