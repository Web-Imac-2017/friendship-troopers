'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const PageNav = Vue.extend({
  template,
  props : {
    page : Number,
    more : Boolean
  },
   methods : {
    nextPage(){
      this.$emit('next');
    },
    previousPage(){
      if (this.page > 1) {
        this.$emit('prev');
      }
    }
  }
});

export default PageNav;
