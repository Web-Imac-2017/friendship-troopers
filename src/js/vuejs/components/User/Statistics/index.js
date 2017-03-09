'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const Statistics = Vue.extend({
  template,
  props: ['user'],
  methods : {
  	showMore : function() {
  		this.start = this.user.interests.length;
  	},
  	showLess : function() {
  		this.start = 5;
  	}
  },
  user: {
        nbFriends : 7,
        planetSelected : 'Eat-712',
       
  },
  data () {
  	return {
  	 start : 5
 	}
  }
  
});


export default Statistics;