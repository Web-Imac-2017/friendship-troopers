'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const FriendTemplate = Vue.extend({
  template,
  props: {
  	friend: Object,
  	planet : String
  },
  created: function(){
  	console.log(this.planet)
  }
});


export default FriendTemplate;