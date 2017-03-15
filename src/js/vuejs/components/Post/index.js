'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);

import Comment from '../Comment/index.js'

const Post = Vue.extend({
  components : {
    'comment' : Comment
  },
  props : {
    post: Object
  },
  template,
  watch: {
    post : function() {
      this.getPlanetPublications();
      this.isLiked();
      this.getLikes();
    }
  },
   methods : {
    like : function() {
      if (!this.liked) { // Si l'utilisateur n'a pas déjà liké, il like
        this.$http.post(apiRoot() + "/posts/" + this.post.id + "/stardust").then(
          (response) => {
            this.getLikes(); // On met à jour le nombre de likes affichés
            this.liked = true;
          },
          (response) => {
          });
      } else { // S'il a déjà liké, il délike
        this.$http.delete(apiRoot() + "/posts/" + this.post.id + "/stardust").then(
          (response) => {
            this.getLikes(); // On met à jour le nombre de likes affichés
            this.liked = false;
          },
          (response) => {
          });
      }
    },
    publishNewComment : function() {
      this.$http.post(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments", { 'content' : this.newComment}, {emulateJSON : true}).then(
        (response) => {
          this.newComment = '';
          this.getComments(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments?limit=" + this.loadMore, false);
          this.countComments();
        },(response) => {
        }
      );
    },
    loadMoreComment : function() {
      this.loadMore += this.loadMore;
      
      this.getComments(this.prevComments, true);
    },
    formateDate : function(date) {
      var object = new Date(date); 
      var months = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juill.", "août", "sept.", "oct.", "nov.", "déc."];
      return object.getDate() + " " + months[object.getMonth()] + " à " + object.getHours() + ":" + ('0'+object.getMinutes()).slice(-2);
    },
    countComments : function() {
      this.$http.get(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments/count", { emulateJSON: true }).then(
        (response) => {
          this.totalComments = response.data.count;
        },
        (response) => {
        });
    },
    getLikes : function() {
      this.$http.get(apiRoot() + 'posts/' + this.post.id + "/stardust", { emulateJSON: true}).then(
        (response) => {
          this.nbLikes = response.data.count;
        },
        (response) => {
        }
      );
    },
    getComments : function(route, concat) {
      this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
          if (concat) {
            this.comments = this.comments.concat(response.data);

          } else {
            this.comments = response.data;
          }
          this.reversedComments = this.comments.slice(0);
          this.reversedComments.reverse();
          var tmp = response.headers.get("Link").split(",")[1].split(";")[0];
          this.prevComments = apiRoot() + tmp.substring(2, tmp.length-1);
        },
        (response) => {
        }
      );
    },
    getTotalComments: function() {
      this.$http.get(apiRoot() + "/planets/" + this.planetId + "/posts/" + this.post.id + "/comments/count", {emulateJSON: true}).then(
        (response) => {
          this.totalComments = response.data.count;
        },
        (response) => {
        }
      );
    },
    isLiked : function() {
      ///posts/:publicationId/stardust/exist
      this.$http.get(apiRoot() + "/posts/" + this.post.id + "/stardust/exist", {emulateJSON: true}).then(
        (response) => {
          if (response.data == 1) {
            this.liked = true;
          } else {
            this.liked = false;
          }
        }, 
        (response) => {
        }
      );
    },
    getPlanetPublications : function() {
      this.$http.get(apiRoot() + "users/me", {emulateJSON: true}).then(
        (response) => {
          this.planetId = response.data.planetId;
          this.planetName = response.data.name;
          this.countComments();
          this.getComments(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments?limit=" + this.loadMore, false);
        }, 
        (response) => {
        }
      );
    }
  },
  created : function() {
    // Savoir si l'utilisateur a déjà liké le post ?
    this.getPlanetPublications();
    this.isLiked();
    this.getLikes();
  },
  data () {
    return {
      comments : {},
      reversedComments : {},
      nbLikes : 0,
      liked : false,
      newComment : '',
      prevComments: '',
      totalComments: 0,
      loadMore : 5,
      showFullPost : false,
      planetName: "Terre",
      planetId: 1
    }
  }/*,
  computed: {
    reversedComments : function() {
      return this.comments.reverse();
    }
  }*/
});


export default Post;