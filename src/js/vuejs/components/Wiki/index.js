'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Wiki = Vue.extend({
  template
});


export default Wiki;