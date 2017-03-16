'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const CreatePost = Vue.extend({
  template,
  created : function(){
    this.$http.get(apiRoot() + 'users/me').then((response) => {
      // gérer le succes, toutes les infos renvoyer sont dans response.data      
        this.me = response.data;
      }, (response) => {
      });
  },
  methods:{
    publish(){
      this.$emit("newpost", this.post) 
    },
    uploadPicture(){
      this.picture = true     
    }
  }, 
  computed : {
    imagePath : function() {
      return "/assets/images/avatars/" + this.me.name + "/" + this.me.imagePath;
    }
  },
  data () {
    return {
      me : {},
      post : {
        content: ''
      }
    }
  }
});

export default CreatePost;