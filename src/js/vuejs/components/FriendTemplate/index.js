'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const FriendTemplate = Vue.extend({
  template,
  props: ['user'] ,
  user: {
        nbFriends : 7,
        planetSelected : 'Eat-712'
  }
});


export default FriendTemplate;