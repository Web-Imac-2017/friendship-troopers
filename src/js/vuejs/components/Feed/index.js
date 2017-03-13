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
import PageNav from '../PageNav/index.js'
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
    this.getPublications(apiRoot() + 'planets/'+ this.planetId + '/posts');
  },
  methods : {
    createPost : function(post) {
      //Router::post('/planets/:planet/posts', 'publication#create', 'planets.posts.create');
      this.$http.post(apiRoot() + "planets/" + this.planetId + "/posts", { 'content' : post.content}, {emulateJSON : true}).then(
        (response) => {
          post.content = '';
        },(response) => {
        }
      );
    },
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
        });
    },
    showNextPage : function() {
      if (this.currentPage*10 < this.totalPublications) {
        this.currentPage++;
        this.getPublications(this.routeNextPost);
      }
      if (this.totalPublications-(this.currentPage*10) > 10) {
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    },
    showPrevPage : function() {
      this.currentPage--;
      this.getPublications(this.routePrevPost);
      if (this.totalPublications-(this.currentPage*10) < 10) {
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    }
  },
  data () {
   	return {
      currentPage: 1,
      morePage: true,
      planetId: 0,
      bddPosts: {},
      routeNextPost: '',
      routePrevPost: '',
      totalPublications: 15
    }
  }
});


export default Feed;