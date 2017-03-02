'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const Error404 = Vue.extend({
  template
});


export default Error404 ;