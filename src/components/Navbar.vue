<template>
  <div class="navbar row">
    <ul class="nav navbar-nav">
      <li class="navbar-left">
        <a class="navbar-brand" href="/"> <!-- {{$store.state.appTitle}} {{$store.state.appVersion}} -->Friendship<br/>Troopers</a>
        <menu-separator></menu-separator>
        <router-link to="/actualites" class="nav-item nav-link nav-home"> Accueil </router-link>
        <router-link to="/utilisateur/enigmes" class="nav-item nav-link"> <b>Énigmes</b> </router-link>
      </li>

      <li class="navbar-right">
        <input type ="text" class="nav-item" placeholder="Recherche" value =""></input>
        <input type="submit" class="nav-item nav-search-icon" value=""></input>
        
        <menu-separator></menu-separator>
        
        <div class="nav-item nav-icon " @click="showSubMenu(1)">
          <div class="friends-icon">
          <p v-if="friends.length > 99" class="notif">99+</p> 
          <p v-else-if="friends.length > 0" class="notif"> {{ friends.length }} </p> 
        </div>
          <div v-if="subMenu == 1" class="sub-menu"> 
            <ul class="menu-friends">
            <p v-if = "friends.length > 0">
              Vous avez des demandes d'amis ! <br/>
            </p>
            <p v-else>
              Vous n'avez pas de nouvelles demandes d'ami... <br/>
            </p>

              <li v-if = "friends.length > 0">
                {{friends[0].pseudo}} vous a invité le {{friends[0].date}}
              </li>
              <li v-if = "friends.length > 1">
                {{friends[1].pseudo}} vous a invité le {{friends[1].date}}
              </li>

            </ul>
          </div>

        </div>


        <div class="nav-item nav-icon" @click="showSubMenu(2)"> 
          <div class="messages-icon">
            <p v-if="messages.length > 99" class="notif">99+</p>
            <p v-else-if="messages.length > 0" class="notif"> {{ messages.length }}</p>
          </div>

          <div v-if="subMenu == 2" class="sub-menu"> 
            <ul class="menu-messages">

              <p v-if = "messages.length > 0">
               Vous avez des nouveaux messages ! <br/>
              </p>
              <p v-else>
                Vous n'avez pas de nouveaux messages... <br/>
              </p>

              <li v-if = "messages.length > 0">
                {{messages[0].pseudo}}, le {{messages[0].date}}
              </li>
              <li v-if = "messages.length > 1">
                {{messages[1].pseudo}}, le {{messages[1].date}}
              </li>
            </ul>
          </div> 

        </div>
        

        <div class="nav-item nav-icon" @click="showSubMenu(3)">
          <div class="notifications-icon">
              <p v-if="notifications.length > 99" class="notif">99+</p> 
              <p v-else-if="notifications.length > 0" class="notif"> {{ notifications.length }}</p> 
         </div>

          <div v-if="subMenu == 3" class="sub-menu"> 
            <ul class="menu-notifications">

              <p v-if = "notifications.length == 0">
               Vous n'avez pas nouvelles notifications... <br/>
              </p>

              <li v-if = "notifications.length > 0">
                {{notifications[0].pseudo}} a {{notifications[0].type}} votre post {{notifications[0].post}}
              </li>
              <li v-if = "notifications.length > 1">
                {{notifications[1].pseudo}} a {{notifications[1].type}} votre post {{notifications[1].post}}
              </li>
            </ul>
          </div>
     
        </div>


        <menu-separator></menu-separator>
        <router-link to="/utilisateur" class="nav-item nav-link nav-profil"> Mon profil </router-link>

      </li>
    </ul>
  </div>
</template>

<style src="../../www/assets/css/navbar.css"></style>


<script>

export default {
  methods: {
    showMenuPesponsive: function(){
    }, 
    showSubMenu: function(idMenu){
      if (this.subMenu == idMenu) 
        this.subMenu = 0
      else {
        this.subMenu = idMenu
      }
    }, 
    showNotifications: function(){
      for (var i = 0; i < this.friends.length; i++) {
       // alert(this.friends[i].pseudo);
     }
    }, 
    showMessages: function(){
      if (this.subMenu == 2) 
        this.subMenu = 0
      else 
        this.subMenu = 2
    }, 
    showFriends: function(){
      if (this.subMenu == 1) 
        this.subMenu = 0
      else 
        this.subMenu = 1
    }
  }, 
   data () {
      return {
        friends: [ {pseudo: 'luckypon',date : '12/03/13'},
                    {pseudo: 'luckyLuke',date : '12/03/13'}
                 ],
        messages: [ {pseudo: 'luckypon',date : '12/03/13'},
                    {pseudo: 'tintin',date : '11/02/12'},
                    {pseudo: 'kirikoukou',date : '01/03/13'}
                 ], 
        notifications: [
                    {type:'like', post:'4', pseudo:'luckypon'},
                    {type:'comment', post:'2', pseudo: 'hihi'}     
        ], 
        subMenu : 0

        // notifs:[{
        //   friends : 1,
        //   messages : 16,
        //   notifications : 100
        // }], 
        // subMenu : 0 /*1:friends / 2: messages / 3: notif*/
      }
    }

    

}
</script>
