import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// ===================== Pages Components ======================
import Login from './components/Login'
import Feed from './components/Feed'
import Inscription from './components/Inscription'
import Universe from './components/Universe'
import Search from './components/Search'
import User from './components/User'
import Enigme from './components/Enigme'
import Planet from './components/Planet'
import Post from './components/Post'
import Wiki from './components/Wiki'
import Market from './components/Market'
import FAQ from './components/FAQ'
import Error404 from './components/Error404'

// ==================== Router registration ====================
export default new Router({
  mode: 'history',
  routes: [
    { 
    	path: '/', 
    	component: Login 
	},{ 
      path: '/inscription', 
      component : Inscription
      // mixer avec la page login sur la page d'accueil !
  },{ 
      path: '/univers', 
      component : Universe
  },{ 
      path: '/recherche', 
      component : Search
  },{ 
      path: '/utilisateur', 
      component : User
      // mettre $username : unique pour chaque utilisateur
  },
  /* mettre routes suivantes :
      /utilisateur/param   (onglet préférences / profil /….)
      /utilisateur/profil
      /utilisateur/amis
      /utilisateur/conversations
          /utilisateur/conversations/username

          /utilisateur/enigmes/resolues
          /utilisateur/enigmes/en-cours
          /utilisateur/enigmes/en-cours/chatbox
          /utilisateur/enigmes/start
  */
  { 
      path: '/utilisateur/enigmes', 
      component : Enigme
      // mettre $username : unique pour chaque utilisateur
  },{ 
      path: '/planete', 
      component : Planet
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/planete/actualites', 
      component : Feed
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/planete/post/:id', 
      component : Post
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/planete/wiki', 
      component : Wiki
      // mettre $planet : unique pour chaque planete
  },{ 
      path: '/marche-intergalactique', 
      component : Market
  },{ 
      path: '/faq', 
      component : FAQ
  },{ 
      path: '/erreur404', 
      component : Error404
  },{ 
    	path: '*', 
    	redirect: '/erreur404'
	}
  ]
})

