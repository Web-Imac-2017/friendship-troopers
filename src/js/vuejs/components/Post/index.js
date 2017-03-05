'use strict';

import Vue from 'vue/dist/vue';
// import {apiRoot} from '../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Post = Vue.extend({
  props : {
    post:Object
  },
  template,
   methods : {
    like : function(){
      this.post.likes += 1;
      //TODO dans requete ajax, post like, id post + user name (get from session)
    },
    publishNewComment : function() {
      console.log(this.newComment);
    }
  },

  data () {
    return {
      newComment : '',
      planetData: ["#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]

       

    }
  }
  // created () {
   /* this.$http.get(apiRoot() +'/univers/Terre/actualites').then(
        (response) => {
          console.log("ok "+response.body);
          //il faudra transformer le retour JSON de l'API en objet JS avec JSON.parse
        },
        (response) => {
          console.log("fail " + JSON.stringify(response.data));
        }
      )*/
  // }
});


export default Post;