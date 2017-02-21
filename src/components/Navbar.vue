<template>
  <nav class="navbar">
    <ul class="nav navbar-nav">
      <li class="navbar-left">
        <a class="navbar-brand" href="/"> <!-- {{$store.state.appTitle}} {{$store.state.appVersion}} -->Friendship<br/>Troopers</a>
        <router-link to="/planete/actualites" class="nav-item nav-link"> Accueil </router-link>
        <router-link to="/utilisateur/enigmes" class="nav-item nav-link"> Énigmes </router-link>
      </li>

      <li class="navbar-right">
        <input type ="text" class="nav-item" placeholder="Recherche" value =""></input>
        <input type="submit" class="nav-search-icon" value=""></input>
        
        <router-link to="/utilisateur/amis" class="nav-item nav-link"> <img src="../assets/Friends.svg"> </router-link>
        <router-link to="/utilisateur/conversations" class="nav-item nav-link"> <img src="../assets/Messages.svg"> </router-link>
        <div class="nav-item nav-link"> <img src="../assets/Notifications.svg"> </div>
        <router-link to="/utilisateur" class="nav-item nav-link"> Mon profil </router-link>
      </li>
      <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
    </ul>
  </nav>
</template>

<script>
  export default {
  }
</script>
