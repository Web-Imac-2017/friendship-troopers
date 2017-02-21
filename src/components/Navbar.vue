<template>
  <nav class="navbar">
    <ul class="nav navbar-nav">
      <li class="navbar-left">
        <a class="navbar-brand" href="/"> <!-- {{$store.state.appTitle}} {{$store.state.appVersion}} -->Friendship<br/>Troopers</a>
        <menu-separator></menu-separator>
        <router-link to="/planete/actualites" class="nav-item nav-link"> Accueil </router-link>
        <router-link to="/utilisateur/enigmes" class="nav-item nav-link"> <b>Énigmes</b> </router-link>
      </li>

      <li class="navbar-right">
        <input type ="text" class="nav-item" placeholder="Recherche" value =""></input>
        <input type="submit" class="nav-item nav-search-icon" value=""></input>
        
        <menu-separator></menu-separator>
        <router-link to="/utilisateur/amis" class="nav-item nav-link"> <img src="../assets/Friends.svg"> </router-link>
        <router-link to="/utilisateur/conversations" class="nav-item nav-link"> <img src="../assets/Messages.svg"> </router-link>
        <div class="nav-item nav-link"> <img src="../assets/Notifications.svg"> </div>

        <menu-separator></menu-separator>
        <router-link to="/utilisateur" class="nav-item nav-link"> Mon profil </router-link>
        <div class="nav-responsive nav-item nav-link"> <img src="../assets/MenuResponsive.svg"> </div>
      </li>
    </ul>
  </nav>
</template>

<script>
  export default {
  }
</script>
