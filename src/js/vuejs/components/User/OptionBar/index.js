'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const optionBar = Vue.extend({
  template,
  props: ['myself']
});


export default optionBar;