<template>
  <div>
    
    <div id="app">
      <navbar></navbar>
      <router-view></router-view>

      
      <h1>Menu temporaire</h1>
      <ul>
        <li><router-link to="/"> Login/Accueil </router-link></li>
        <li><router-link to="/inscription"> Inscription </router-link></li>
        <li><router-link to="/inscription/welcome-on-board"> Welcome On Board </router-link></li>
        <li><router-link to="/univers/evenement"> Evenement </router-link></li>
        <li><router-link to="/recherche"> Recherche </router-link></li>
        <li><router-link to="/utilisateur"> Profil </router-link></li>
        <li><router-link to="/utilisateur/parametres"> Paramètre d'un profil </router-link></li>
        <li><router-link to="/utilisateur/amis"> Amis </router-link></li>
        <li><router-link to="/utilisateur/conversations/utilisateur"> Chat </router-link></li>
        
        <li><router-link to="/utilisateur/enigmes"> Enigme débuter </router-link></li>
        <li><router-link to="/utilisateur/enigmes/resolues"> Enigmes résolues </router-link></li>
        <li><router-link to="/utilisateur/enigmes/en-cours"> Enigmes en cours </router-link></li>
        <li><router-link to="/utilisateur/enigmes/en-cours/chatbox"> Chat de l'enigme </router-link></li>
        <li><router-link to="/actualites"> Fil d'actualité </router-link></li>
        <li><router-link to="/planete/post/2"> Post </router-link></li>
        <li><router-link to="/planete/wiki"> Wiki d'une planète </router-link></li>
        <li><router-link to="/marche-intergalactique"> Marché </router-link></li>
        <li><router-link to="/a-propos"> À propos </router-link></li>
        <li><router-link to="/FAQ"> FAQ </router-link></li>

        <li><router-link to="/admin/nouvel-administrateur"> Administrateur : Ajout compte admin </router-link></li>
        <li><router-link to="/admin/creer-post"> Administrateur : Créer post intergalactique </router-link></li>
        <li><router-link to="/admin/signalement"> Administrateur : Signalement </router-link></li>
        <li><router-link to="/admin/ajout-badge"> Administrateur : Ajout badge</router-link></li>
        <li><router-link to="/admin/ajout-avatar"> Administrateur : Ajout avatar</router-link></li>
        <li><router-link to="/admin/ajout-enigme"> Administrateur : Ajout énigme</router-link></li>

        <li><router-link to="/error404"> Erreur 404 </router-link></li>
      </ul>

    </div>
</template>


<script>
import Navbar from './components/Navbar'


export default {
  components: { Navbar}
}
</script>


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