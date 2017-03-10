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
   methods : {
    like : function() {
      this.$http.post(apiRoot() + "/posts/" + this.post.id + "/stardust").then(
        (response) => {
          console.log("LIKE !");
          // On recupere le nouveau nombre de like
          //TODO
        },
        (response) => {
        });
    },
    publishNewComment : function() {
      console.log(this.newComment);
      //TODO
    },
    loadMoreComment : function() {
      this.loadMore += loadMore;
      //TODO
    },
    formateDate : function(date) {
      var object = new Date(date); 
      var months = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juill.", "août", "sept.", "oct.", "nov.", "déc."];
      return object.getDate() + " " + months[object.getMonth()] + " à " + object.getHours() + ":" + object.getMinutes();
    }
  },
  created : function() {
    // Savoir si l'utilisateur a déjà liké le post ?
    //TODO

    // Récupérer les 10 derniers commentaires du post
    var loop  = true;
    var route = apiRoot() + 'planets/1/posts/' + this.post.id + "/comments?limit=" + this.loadMore;
    this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
          this.comments = response.data;
        },
        (response) => {
          console.log(response);
        }
      );

    // Pour récupèrer les commentaires suivants, une petite idée de ce qu'il va falloir faire
    //while (loop) {
      /*this.$http.get(route, { emulateJSON: true }).then(
        (response) => {
            this.comments = response.data;
            console.log("id " + response.data[0].id);
            var link = response.headers.get("Link").split(",")[1].split(";")[0];
            route = apiRoot() + link.substring(2, link.length-1);
            console.log("New route 1 : " + route);
          }
        },
        (response) => {
          console.log(response);
        }
        );*/

    // Récupérer le nombre de likes
    this.$http.get(apiRoot() + 'posts/' + this.post.id + "/stardust", { emulateJSON: true}).then(
      (response) => {
        this.nbLikes = response.data.count;
      },
      (response) => {
        console.log(response)
      });
    },
  data () {
    return {
      comments : {},
      nbLikes : 0,
      newComment : '',
      loadMore : 5,
      showFullPost : false,
      /* admin / earth / parallel / robots / aliens / space-opera*/
      planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  }
});


export default Post;