<template>
  <nav class="navbar">
    <ul class="nav navbar-nav">
      <li class="navbar-left">
        <a class="navbar-brand" href="/"> <!-- {{$store.state.appTitle}} {{$store.state.appVersion}} -->Friendship<br/>Troopers</a>
        <menu-separator></menu-separator>
        <router-link to="/actualites" class="nav-item nav-link"> Accueil </router-link>
        <router-link to="/utilisateur/enigmes" class="nav-item nav-link"> <b>Énigmes</b> </router-link>
      </li>

      <li class="navbar-right">
        <input type ="text" class="nav-item" placeholder="Recherche" value =""></input>
        <input type="submit" class="nav-item nav-search-icon" value=""></input>
        
        <menu-separator></menu-separator>
        <div class="nav-item nav-icon friends-icon"> 
          <p v-if="notif.friends > 99" class="notif">99+</p> 
          <p v-else-if="notif.friends > 0" class="notif"> {{ notif.friends }} </p> 
        </div>
        <div class="nav-item nav-icon messages-icon"> 
          <p v-if="notif.messages > 99" class="notif">99+</p>
          <p v-else-if="notif.messages > 0" class="notif"> {{ notif.messages }}</p> 
        </div>
        <div class="nav-item nav-icon notifications-icon">
          <p v-if="notif.notifications > 99" class="notif">99+</p> 
          <p v-else-if="notif.notifications > 0" class="notif"> {{ notif.notifications }}</p> 
        </div>

        <menu-separator></menu-separator>
        <router-link to="/utilisateur" class="nav-item nav-link"> Mon profil </router-link>
        <div class="nav-responsive nav-item nav-link"  @click="showMenuPesponsive()"> <img src="../assets/MenuResponsive.svg"> </div>
      </li>
    </ul>
  </nav>
</template>

<style src="../../www/assets/css/navBar.css"></style>


<script>

export default {
  methods: {
    showMenuPesponsive: function(){
      
    }, 
    showNotifications: function(){
      
    }, 
    showMessages: function(){
      
    }, 
    showFriends: function(){
      
    }
  }, 
   data () {
      return {
        notif:{
          friends : 1,
          messages : 16,
          notifications : 100
        }
      }
    }

    

}
</script>
