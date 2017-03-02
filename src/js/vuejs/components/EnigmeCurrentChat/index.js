'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const EnigmeCurrentChat = Vue.extend({
  template,
});


export default EnigmeCurrentChat;