'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const PostAdmin = Vue.extend({
 props : {
    post:Object
  },
  template,
});


export default PostAdmin;