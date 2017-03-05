'use strict';

import Vue       from 'vue/dist/vue';
import VueRouter from 'vue-router';
import VueRessource from 'vue-resource';

import App       from './components/app';
import Router    from './router';

Vue.use(VueRouter);
Vue.use(VueRessource);

const API_BASE_URL = "http://localhost/friendship-troopers/www/"
Vue.http.options.root = API_BASE_URL + 'api';


let initApp = function () {
  const app = new App({
    router: Router,
    el    : '#app',
  });
}

export default initApp;
