'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


Vue.component('friends', {
  props: ['friend'],
  template: 
    `<li> 
      <ul class = "sub-menu-item">
        <li>
          <img :src=friend.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=friend.planet class="pseudo">{{friend.pseudo}}</p>
          <div  class="friend-validation" > 
            <img src="/assets/images/validation.svg" alt="valider" title="Valider">
            <img src="/assets/images/Cross.svg" alt="refuser" title="Refuser">
          </div>
        </li>
      </ul>
    </li>
    `

})
Vue.component('messages', {
  props: ['message'],
  template:
      `<li> 
      <ul class = "sub-menu-item">
        <li>
          <img :src=message.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=message.planet class="pseudo">{{message.pseudo}}</p> 
          <p class="date"> {{message.date}}</p>
        </li>
      </ul>
      <p class="content message" v-if="message.content.length>30" >  {{message.content.slice(0,30)}}...  </p>
      <p class="content message" v-else>  {{message.content}}  </p>
    </li>`
})

Vue.component('notifications', {
  props: ['notification'],
  template:  
  `<li v-if = "notification.type==1"> 
      <p>Ça y est ! Votre post est devenu galactique !</p>
    </li>
    <li v-else-if = "notification.type==2"> 
      <ul class = "sub-menu-item">
        <li>
          <img :src=notification.avatar alt="avatar" class="avatar"> 
        </li>
        <li> 
          <p>Votre ami {{notification.pseudo}} a publié un message !</p>
        </li>
      </ul>
    </li>
    <li v-else-if = "notification.type==3"> 
      
       <ul class = "sub-menu-item">
        <li>
          <img src="/assets/images/Messages.svg"> 
        </li>
        <li> 
          <p>Votre dernier post fait réagir !</p>
        </li>
      </ul>
    </li>`

})


const NavBar = Vue.extend({
  template,
    methods: {
    showSearch: function(){
      if (this.search == 1) 
        this.search = 0
      else {
        this.search = 1
      }
    },
    showSubMenu: function(idMenu){
      if (this.subMenu == idMenu) 
        this.subMenu = 0
      else {
        this.subMenu = idMenu
      }
    }
  }, 
   data () {
      return {
        friends: [ {pseudo: 'luckypon', avatar:'/assets/images/avatars/Terre/astro.svg', planet :'Terre'},
                    {pseudo: 'luckyLuke', avatar:'/assets/images/avatars/Sautien/astro.svg', planet :'Sautien'},
                    {pseudo: 'titi', avatar:'/assets/images/avatars/Technome/landscape.svg', planet :'Technome'},
                    {pseudo: 'tot', avatar:'/assets/images/avatars/Multas/astro.svg', planet :'Multas'}
                 ],
        messages: [ {pseudo: 'luckypon',avatar:'/assets/images/avatars/Terre/astro.svg', planet :'earth', content:"Ok, comment ç va, t'as reçu un vélociratop à noel ? Oki doc !", date : '12/03/13'},
                    {pseudo: 'tintin', avatar:'/assets/images/avatars/Multas/landscape.svg', planet :'Multas', content:"Je t'envoie un message toto !", date : '11/02/12'},
                    {pseudo: 'kirikoukou', avatar:'/assets/images/avatars/Multas/landscape.svg', planet :'Multas', content:"Je t'envoie un message toto !", date : '01/03/13'}
                 ], 
        notifications: [
        /*  type 1 : post intergalactique / type 2 : ami news  /  type 3 : last post */
                    {type:'1', post:'4'},
                    {type:'2', post:'2', pseudo: 'hihi', avatar:'/assets/images/avatars/Terre/astro.svg', planet :'Terre'},     
                    {type:'3', post:'3'}     
        ], 
        subMenu : 0,
        pseudo : 'coulon',
        id : 1,
        avatar : '/assets/images/avatars/Terre/astro.svg',
        search : 0

        // subMenu : 0 /*1:friends / 2: messages / 3: notif*/
      }
    }
});


export default NavBar;