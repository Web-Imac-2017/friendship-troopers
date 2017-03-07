'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Comment = Vue.extend({
  props : {
    comment:Object
  },
  template,
  data () {
    return {
      newComment : '',
      showFullComment : false,
      /* admin / earth / parallel / robots / aliens / space-opera*/
      planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  },

});


export default Comment;