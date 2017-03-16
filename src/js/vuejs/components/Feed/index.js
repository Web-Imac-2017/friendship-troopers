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
import NavBar from '../NavBar/index.js'

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
  methods : {
    initialize : function() {
      this.planetId = this.$refs.menu.user.planetId;
      // Get the 10 first post of the user planet
      this.getPublications(apiRoot() + 'planets/'+ this.planetId + '/posts');
      this.countPublications();
      this.showMoreLink();
    },
    // Create a post in database
    createPost : function(post) {
      this.$http.post(apiRoot() + "planets/" + this.planetId + "/posts", { 'content' : post.content}, {emulateJSON : true}).then(
        (response) => {
          post.content = '';
          this.getPublications(apiRoot() + 'planets/'+ this.planetId + '/posts');
          // Feedback visuel
          this.countPublications();
          this.currentPage = 1;
          this.showMoreLink();
        },(response) => {
        }
      );
    },
    // Get the total number of publications in the planet
    countPublications : function() {
      this.$http.get(apiRoot() + "planets/" + this.planetId + "/posts/count", { emulateJSON: true }).then(
        (response) => {
          this.totalPublications = response.data.nbPost;
        },
        (response) => {

        });
    },
    getPublications : function(route) {
      this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
          this.bddPosts = response.data;

          var linkNext = response.headers.get("Link").split(",")[0].split(";")[0];
          this.routeNextPost = apiRoot() + linkNext.substring(2, linkNext.length-1);

          var linkPrev = response.headers.get("Link").split(",")[1].split(";")[0];
          this.routePrevPost = apiRoot() + linkPrev.substring(3, linkPrev.length-1);
        },
        (response) => {
        });
    },
    // Hide or show the next page link 
    showMoreLink : function() {
      if (this.currentPage*10 < this.totalPublications) {
        this.morePage = true;
      } else {
        this.morePage = false;
      }
    },
    // Click on next page : show the 10 previous publications
    showNextPage : function() {
      if (this.currentPage*10 < this.totalPublications) {
        this.currentPage++;
        this.getPublications(this.routeNextPost);
        this.showMoreLink();
      }
    },
    // Click on prev page : show the 10 next publications
    showPrevPage : function() {
      this.currentPage--;
      this.getPublications(this.routePrevPost);
      this.showMoreLink();
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
      totalPublications: 0
    }
  }
});


export default Feed;