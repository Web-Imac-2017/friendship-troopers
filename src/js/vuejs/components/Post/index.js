'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js'

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
      /* admin / earth / parallel / robots / aliens / space-opera*/
      planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  },

});


export default Post;