<template>
  <div>
    
    <div id="app">
      <navbar></navbar>
      <router-view></router-view>

      
      <h1>Menu temporaire</h1>
      <router-link to="/"> Login/Accueil </router-link>
      <router-link to="/inscription"> Inscription </router-link>
      <router-link to="/univers"> Univers </router-link>
      <router-link to="/recherche"> Recherche </router-link>
      <router-link to="/utilisateur"> Profil </router-link>
      <router-link to="/utilisateur/enigmes"> Enigme </router-link>
      <router-link to="/planete"> Planete </router-link>
      <router-link to="/planete/actualites"> Fil d'actualité </router-link>
      <router-link to="/planete/post/2"> Post </router-link>
      <router-link to="/planete/wiki"> Wiki d'une planète </router-link>
      <router-link to="/marche-intergalactique"> Marché </router-link>
      <router-link to="/FAQ"> FAQ </router-link>
      <router-link to="/error404"> Erreur 404 </router-link>

    </div>
</template>


<script>
import Navbar from './components/Navbar'

export default {
  components: { Navbar }
}
</script>

<style src="../www/assets/css/reset.css"></style>

 <style lang="sass">
  // Bootstrap
  $icon-font-path: '../node_modules/bootstrap-sass/assets/fonts/bootstrap/';
  $link-color: #42b983;
  $brand-success: #42b983;
  @import 'node_modules/bootstrap-sass/assets/stylesheets/bootstrap';
  //some styling adaptations
  h1
    color: #42b983
  p
    text-align: justify
</style>


<style src="../www/assets/css/style.css"></style>