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
      this.loadMore = 5;
    }
  },
   methods : {
    like : function() {
      if (!this.liked) { // If the user doesn't like the publication yet, he likes
        this.$http.post(apiRoot() + "posts/" + this.post.id + "/stardust").then(
          (response) => {
            this.getLikes();
            this.liked = true;
          },
          (response) => {
          });
      } else { // If he likes the publication, he dislikes it
        this.$http.delete(apiRoot() + "posts/" + this.post.id + "/stardust").then(
          (response) => {
            this.getLikes();
            this.liked = false;
          },
          (response) => {
          });
      }
    },
    // Publish a new comment on the post
    publishNewComment : function() {
      this.$http.post(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments", { 'content' : this.newComment}, {emulateJSON : true}).then(
        (response) => {
          this.newComment = '';
          // Visual feedback
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
          this.reversedComments.reverse(); // Reverse so the comments will be displayed in chronological order (more recent printed last)
          var tmp = response.headers.get("Link").split(",")[1].split(";")[0];
          this.prevComments = apiRoot() + tmp.substring(2, tmp.length-1);
        },
        (response) => {
        }
      );
    },
    isLiked : function() {
      this.$http.get(apiRoot() + "posts/" + this.post.id + "/stardust/exist", {emulateJSON: true}).then(
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
    // Get the publication info according to the planet id
    getPlanetPublications : function() {
      this.$http.get(apiRoot() + "users/me", {emulateJSON: true}).then(
        (response) => {
          this.planetId = response.data.planetId;
          this.planetName = response.data.name;
          this.avatar = response.data.imagePath;
          this.countComments();
          this.getComments(apiRoot() + "planets/" + this.planetId + "/posts/" + this.post.id + "/comments?limit=" + this.loadMore, false);
        }, 
        (response) => {
        }
      );
    }
  },
  computed : {
    imagePath : function() { 
      return "/assets/images/avatars/" + this.planetName + "/" + this.avatar;
    }
  },   
  created : function() {
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
      planetName: 'Terre',
      planetId: 1,
      avatar :'astro.svg'
    }
  }
});


export default Post;