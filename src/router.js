import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// ===================== Pages Components ======================
import Hello from './components/Hello'
import PageA from './components/PageA'
import Login from './components/Login'
import Home from './components/Home'
import Inscription from './components/Inscription'

// ==================== Router registration ====================
export default new Router({
  mode: 'history',
  routes: [
    { 
    	path: '/', 
    	component: Hello 
	},{ 
    	path: '/login', 
    	component : Login
	},{ 
      path: '/inscription', 
      component : Inscription
  },{ 
    	path: '/article/:id', 
    	component : PageA
	},{ 
      path: '/home', 
      component : Home
  },{ 
    	path: '*', 
    	redirect: '/'
	}
  ]
})
