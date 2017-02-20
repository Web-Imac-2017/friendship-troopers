<template>
  <nav class="navbar">
    <ul class="nav navbar-nav navbar-right">
      <li>
        <a class="navbar-brand" href="/"> <!-- {{$store.state.appTitle}} {{$store.state.appVersion}} -->Friendship Troopers</a>
        <router-link to="/home" class="nav-item nav-link"> Accueil </router-link>
        <router-link to="/enigma" class="nav-item nav-link"> Énigmes </router-link>
        <input type ="text" class="nav-item" placeholder="Recherche" value =""></input>
        <router-link to="/login" class="nav-item nav-link"> Login </router-link>
        <router-link to="/inscription" class="nav-item nav-link"> Inscription </router-link>
      </li>
      <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
    </ul>
  </nav>
</template>

<script>
  export default {
  }
</script>
