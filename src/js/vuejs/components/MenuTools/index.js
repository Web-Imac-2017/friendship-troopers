'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const MenuTools = Vue.extend({
    template
});


export default MenuTools;