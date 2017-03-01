'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const CreatePost = Vue.extend({
  template,
 props:{
    post:Object
  }, 
  methods:{
    publish(){
      this.$emit("post", this.user)  
    },
    uploadPicture(){
      this.picture = true     
    }
  },
});


export default CreatePost;