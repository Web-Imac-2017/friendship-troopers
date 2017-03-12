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
    post: Object,
    new : Boolean
  },
  template,
   methods : {
    like : function() {
      this.$http.post(apiRoot() + "/posts/" + this.post.id + "/stardust").then(
        (response) => {
          // On recupere le nouveau nombre de like
          //TODO
        },
        (response) => {
        });
    },
    publishNewComment : function() {
      this.$http.post(apiRoot() + "planets/1/posts/" + this.post.id + "/comments", { 'content' : this.newComment}, {emulateJSON : true}).then(
        (response) => {
          console.log("Comment created !");
          this.newComment = '';
        },(response) => {
          console.log("Echec");
        }
      );
      // TODO Actualiser les commentaires
    },
    loadMoreComment : function() {
      this.loadMore += this.loadMore;
      
      this.getComments(this.prevComments, true);
      //TODO
    },
    formateDate : function(date) {
      var object = new Date(date); 
      var months = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juill.", "août", "sept.", "oct.", "nov.", "déc."];
      return object.getDate() + " " + months[object.getMonth()] + " à " + object.getHours() + ":" + ('0'+object.getMinutes()).slice(-2);
    },
    getLikes : function() {
      this.$http.get(apiRoot() + 'posts/' + this.post.id + "/stardust", { emulateJSON: true}).then(
        (response) => {
          this.nbLikes = response.data.count;
        },
        (response) => {
          console.log(response)
        }
      );
    },
    getComments(route, concat) {
      this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
          if (concat) {
            this.comments = this.comments.concat(response.data);
          } else {
            this.comments = response.data;
          }
          console.log(this.comments);
          var tmp = response.headers.get("Link").split(",")[1].split(";")[0];
          this.prevComments = apiRoot() + tmp.substring(2, tmp.length-1);
        },
        (response) => {
          console.log(response);
        }
      );
    }
  },
  created : function() {
    console.log("Created with post id = " + this.post.id);
    // Savoir si l'utilisateur a déjà liké le post ?
    //TODO

    // Récupérer les 10 derniers commentaires du post
    this.getComments(apiRoot() + "planets/1/posts/" + this.post.id + "/comments?limit=" + this.loadMore, false);

    // Récupérer le nombre de likes
    this.getLikes();
  },
  updated: function() {
    if (this.new) {
      this.new = false;

      this.getComments(apiRoot() + "planets/1/posts/" + this.post.id + "/comments?limit=" + this.loadMore, false);
      this.getLikes();
    }
  },
  data () {
    return {
      comments : {},
      nbLikes : 0,
      newComment : '',
      prevComments: '',
      loadMore : 5,
      showFullPost : false,
      /* admin / earth / parallel / robots / aliens / space-opera*/
      planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  },
  computed: {
    reversedComments : function() {
      return this.comments;
    }
  }
});


export default Post;