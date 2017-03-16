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
  created: function() {
  	console.log(this.imagePath)
  	this.imagePath = "/assets/images/avatars/" + this.planet + "/" + this.friend.imagePath;
  },
  data () {
  	return {
  		imagePath: ''
  	}
  }
});


export default FriendTemplate;