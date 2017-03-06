'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


Vue.component('friend-item', {
  props: ['friend'],
  template: 
    `<li> 
      <ul class = "sub-menu-item">
        <li>
          <img :src=friend.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=friend.planet class="pseudo">{{friend.pseudo }}</p> 
          <p class="date"> {{friend.date}}</p>
        </li>
      </ul>
    </li>
    `

})
Vue.component('message-item', {
  props: ['message'],
  template:
      `<li> 
      <ul class = "sub-menu-item">
        <li>
          <img :src=message.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=message.planet class="pseudo">{{message.pseudo }}</p> 
          <p class="date"> {{message.date}}</p>
        </li>
      </ul>
      <p class="content"> {{message.begining}} </p>
    </li>`
})

Vue.component('notification-item', {
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
          <img src="../../assets/images/Messages.svg"> 
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
    showMenuResponsive: function(){
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
        friends: [ {pseudo: 'luckypon', avatar:'../../assets/images/avatars/earth/astro.svg', planet :'earth',date : '12/03/13'},
                    {pseudo: 'luckyLuke', avatar:'../../assets/images/avatars/aliens/astro.svg', planet :'alien', date : '12/03/13'},
                    {pseudo: 'titi', avatar:'../../assets/images/avatars/parallel/landscape.svg', planet :'parallel', date : '12/03/13'},
                    {pseudo: 'tot', avatar:'../../assets/images/avatars/space-opera/astro.svg', planet :'space-opera', date : '12/03/13'}
                 ],
        messages: [ {pseudo: 'luckypon',avatar:'../../assets/images/avatars/earth/astro.svg', planet :'earth', begining:"Je t'envoie un message toto !", date : '12/03/13'},
                    {pseudo: 'tintin', avatar:'../../assets/images/avatars/space-opera/landscape.svg', planet :'space-opera',begining:"Je t'envoie un message toto !", date : '11/02/12'},
                    {pseudo: 'kirikoukou', avatar:'../../assets/images/avatars/space-opera/landscape.svg', planet :'space-opera', begining:"Je t'envoie un message toto !", date : '01/03/13'}
                 ], 
        notifications: [
        /*  type 1 : post intergalactique / type 2 : ami news  /  type 3 : last post */
                    {type:'1', post:'4'},
                    {type:'2', post:'2', pseudo: 'hihi', avatar:'../../assets/images/avatars/earth/astro.svg', planet :'earth'},     
                    {type:'3', post:'3'}     
        ], 
        subMenu : 0

        // subMenu : 0 /*1:friends / 2: messages / 3: notif*/
      }
    }
});


export default NavBar;