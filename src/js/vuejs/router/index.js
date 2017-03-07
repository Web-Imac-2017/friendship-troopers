
import VueRouter from 'vue-router';

// ===================== Pages Components ======================
import Login from '../components/Login'
/*import Inscription from './components/Inscription'*/
import WelcomeOnBoard from '../components/WelcomeOnBoard'

import Event from '../components/Event'
import Search from '../components/Search'
import User from '../components/User'
import Parameters from '../components/Parameters'
import Friends from '../components/Friends'
import Chat from '../components/Chat'
import Messages from '../components/Messages'
import Enigme from '../components/Enigme'
import EnigmeResolved from '../components/EnigmeResolved'
import EnigmeCurrent from '../components/EnigmeCurrent'
import EnigmeCurrentChat from '../components/EnigmeCurrentChat'

import Feed from '../components/Feed'
import Post from '../components/Post'

import Wiki from '../components/Wiki'
import Market from '../components/Market'

import About from '../components/About'
import FAQ from '../components/FAQ'
import Legals from '../components/Legals'
/*
import AdminCreatePost from '../components/admin/CreatePost.vue'
import AdminCreateEvent from '../components/admin/CreateEvent.vue'
import AdminAddAdmin from '../components/admin/AddAdmin.vue'
import AdminReport from '../components/admin/Report.vue'
import AdminDelateAccount from '../components/admin/DelateAccount.vue'
import AddBadge from '../components/admin/AddBadge.vue'
import AddAvatar from '../components/admin/AddAvatar.vue'
import AddEmoji from '../components/admin/AddEmoji.vue'
import AddEnigme from '../components/admin/AddEnigme.vue'*/

import Error404 from '../components/Error404'


// ==================== Router registration ====================
const router = new VueRouter({
  mode: 'history',
  base  : '',
  routes: [
    { 
      name : 'Login',
    	path: '/', 
    	component: Login 
	},{
      name: 'WelcomeOnBoard',
      path: '/inscription/welcome-on-board', 
      component : WelcomeOnBoard
  },{ 
      name : 'Search',
      path: '/recherche', 
      component : Search
  },{ 
      name : 'User',
      path: '/utilisateur/:user', 
      component: User, 
      props: true
      // 
      // path: '/utilisateur', 
      // component : User
      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'Parameters',
      path: '/:user/parametres', 
      component : Parameters,
      props: true

      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'Friends',
      path: '/:user/amis', 
      component : Friends,
      props: true
  },{ 
      name : 'Chat',
      path: '/utilisateur/conversations/utilisateur', 
      component : Chat
      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'Messages',
      path: '/:user/conversations', 
      component : Messages
      // mettre $username : unique pour chaque utilisateur
  } ,{ 
      name : 'Enigme',
      path: '/:user/enigmes', 
      component: Enigme, 
      props: true
  },{ 
      name : 'EnigmeResolved',
      path: '/:user/enigmes/resolues', 
      component : EnigmeResolved,
      props: true

      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'EnigmeCurrent',
      path: '/:user/enigmes/en-cours', 
      component : EnigmeCurrent,
      props: true
      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'EnigmeCurrentChat',
      path: '/utilisateur/enigmes/en-cours/chatbox', 
      component : EnigmeCurrentChat
      // mettre $username : unique pour chaque utilisateur
  },{ 
      name : 'Feed',
      path: '/actualites', 
      component : Feed
      // mettre $planet : unique pour chaque planete
  },{ 
      name : 'Event',
      path: '/univers/evenement', 
      component : Event
  },{ 
      name : 'Post',
      path: '/univers/:planet/post/:id', 
      component : Post
      // mettre $planet : unique pour chaque planete
  },{ 
      name : 'Wiki',
      path: '/univers/:planet/wiki', 
      component : Wiki
      // mettre $planet : unique pour chaque planete
  },{ 
      name : 'Market',
      path: '/marche-intergalactique', 
      component : Market
  },{ 
      name : 'FAQ',
      path: '/faq', 
      component : FAQ
  },{
      name : 'About',
      path: '/a-propos', 
      component : About
  },{
      name : 'Legals',
      path: '/mentions-legales', 
      component : Legals
  },{ 
      name : 'Error404',
      path: '/erreur404', 
      component : Error404
  }/*,{ 
      name : 'AdminCreatePost',
      path: '/admin/creer-post', 
      component : AdminCreatePost
  },{ 
      name : 'AdminCreateEvent',
      path: '/admin/creer-evenement', 
      component : AdminCreateEvent
  },{  
      name : 'AdminAddAdmin',
      path: '/admin/nouvel-administrateur', 
      component : AdminAddAdmin
  },{  
      name : 'AdminReport',
      path: '/admin/signalement', 
      component : AdminReport
  },{ 
      name : 'AdminDelateAccount' ,
      path: '/admin/supprimer-compte', 
      component : AdminDelateAccount
  },{  
      name : 'AddBadge',
      path: '/admin/ajout-badge', 
      component : AddBadge
  },{   
      name : 'AddAvatar',
      path: '/admin/ajout-avatar', 
      component : AddAvatar
  },{   
      name : 'AddEmoji',
      path: '/admin/ajout-emoticone', 
      component : AddEmoji
  },{   
      name : 'AddEnigme',
      path: '/admin/ajout-enigme', 
      component : AddEnigme
  }*/,{ 
      path: '/index.html', 
      redirect: {name:'Feed'}
  },{ 
      path: '/*', 
      redirect: '/erreur404'
  }
  ]
})


export default router;