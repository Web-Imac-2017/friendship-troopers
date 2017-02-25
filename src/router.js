import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router) 

// ===================== Pages Components ======================
import Login from './components/Login'
/*import Inscription from './components/Inscription'*/
import WelcomeOnBoard from './components/WelcomeOnBoard'

import Event from './components/Event'
import Search from './components/Search'
import User from './components/User'
import Parameters from './components/Parameters'
import Friends from './components/Friends'
import Chat from './components/Chat'
import Enigme from './components/Enigme'
import EnigmeResolved from './components/EnigmeResolved'
import EnigmeCurrent from './components/EnigmeCurrent'
import EnigmeCurrentChat from './components/EnigmeCurrentChat'

import Feed from './components/Feed'
import Post from './components/Post'

import Wiki from './components/Wiki'
import Market from './components/Market'
import About from './components/About'
import FAQ from './components/FAQ'
import Legals from './components/Legals'
import Error404 from './components/Error404'

// ==================== Router registration ====================
export default new Router({
  mode: 'history',
  routes: [
    { 
    	path: '/', 
    	component: Login 
	},{
      path: '/inscription/welcome-on-board', 
      component : WelcomeOnBoard
  },{ 
      path: '/recherche', 
      component : Search
  },{ 
      path: '/utilisateur', 
      component : User
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/parametres', 
      component : Parameters
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/amis', 
      component : Friends
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/conversations/utilisateur', 
      component : Chat
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/enigmes', 
      component : Enigme
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/enigmes/resolues', 
      component : EnigmeResolved
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/enigmes/en-cours', 
      component : EnigmeCurrent
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/utilisateur/enigmes/en-cours/chatbox', 
      component : EnigmeCurrentChat
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/actualites', 
      component : Feed
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/univers/evenement', 
      component : Event
  },{ 
      path: '/univers/planete/post/:id', 
      component : Post
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/univers/planete/wiki', 
      component : Wiki
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/marche-intergalactique', 
      component : Market
  },{ 
      path: '/faq', 
      component : FAQ
  },{
      path: '/a-propos', 
      component : About
  },{
      path: '/mentions-legales', 
      component : Legals
  },{ 
      path: '/erreur404', 
      component : Error404
  },{ 
    	path: '*', 
    	redirect: '/erreur404'
	}
  ]
})

