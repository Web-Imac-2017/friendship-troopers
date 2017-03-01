'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';

const App = Vue.extend({
  template,
  components: {
  	'navbar' : NavBar
  },
  data() {
    return {
      list: [
        { name: 'item 1', id: 'item1' },
        { name: 'item 2', id: 'item2' },
      ],
    };
  }
});

export default App;
