'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const CreatePost = Vue.extend({
  template,
  created : function(){
    // Get the current user and his avatar
    this.$http.get(apiRoot() + 'users/me').then((response) => {   
        this.me = response.data;
        this.imagePath = "/assets/images/avatars/" + this.me.name + "/" + this.me.imagePath;
      }, (response) => {
      });
  },
  methods:{
    // Publish a new post in the database
    publish(){
      this.$emit("newpost", this.post) 
    },
    uploadPicture(){
      this.picture = true     
    }
  }, 
  data () {
    return {
      me : {},
      post : {
        content: ''
      },
      imagePath:''
    }
  }
});

export default CreatePost;