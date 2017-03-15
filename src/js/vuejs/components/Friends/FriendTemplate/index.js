'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const FriendTemplate = Vue.extend({
  template,
  props: ['friend']
});


export default FriendTemplate;