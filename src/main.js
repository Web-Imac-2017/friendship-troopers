
// =============== Base libraries integration ==================
import Vue from 'vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

import store from './store'
import router from './router'


// ======================= Base Component ======================
import App from './App'


// ======================== Vue Instance =======================
/* eslint-disable no-new */
new Vue({
  router,
  store,
  el: '#app',
  render: h => h(App)
})
