'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const CreatePost = Vue.extend({
  template,
  methods:{
    publish(){
      this.$emit("newPost", this.post) 

    },
    uploadPicture(){
      this.picture = true     
    }
  }, 
  data () {
      return {
        post : {
           user: 'Lucky',
            avatar : "/assets/images/avatars/Terre/miror.svg",
            date: '20 fev',
            hour: '12h04',
            content: '',
            likes: 0,
            comments: 0, 
            id : 7
        }
           
      }
  }
});


export default CreatePost;