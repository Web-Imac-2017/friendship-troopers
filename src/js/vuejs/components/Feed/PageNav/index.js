'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const PageNav = Vue.extend({
  template,
   methods : {
    nextPage(){
      this.currentPage ++;
      this.$emit('next');
      //console.log("prev");
      //TODO charger les 10 posts suivants
    },
    previousPage(){
      if (this.currentPage > 1) {
        this.currentPage --;
        this.$emit('prev');
      }
      //TODO charger les 10 posts précédents
    },
    goToPage(index){
      this.currentPage = index;
      //TODO charger les 10 posts suivants
    }
  },
  data() {
    return {
      currentPage : 1,
      routeNextPage: '',
      routePrevPage: ''
    }
  }
});


export default PageNav;
