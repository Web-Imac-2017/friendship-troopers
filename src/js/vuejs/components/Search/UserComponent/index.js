'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


const UserComponent = Vue.extend({
  props : {
    user:Object
  },
  template,
  data () {
    return {
       planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ]
    }
  },

});


export default UserComponent;