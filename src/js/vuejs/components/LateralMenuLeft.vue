<template>

<div class="container col-sm-12 post">
    <div class="lateralMenuAvatar">

      <img :src="user.userAvatar" alt="your avatar" class="avatar">
      <img :src="user.userPlanet.path" alt="your planet" class="planet">
      <h1> {{ user.username }} </h1> <br>
      <p> {{ user.userBadge}} </p>

   </div>
  <div class="enigmes">
    <h1> Enigmes </h1>
    <a href="#"> Résoudre l'énigme en cours </a> <br>
    <a href="#"> Voir la liste des enigmes </a> 
  </div>
  <div class="amis">
    <h1> Amis </h1>
    <a href="#"> Voir tous mes amis </a> <br>
    <a href="#"> Accéder à la messagerie </a>
    <div class="lastFriends">
      <p> Derniers compagnons </p>
      <ul>
        <li v-for="friend in lastFriends">
          <img :src="friend.avatar" :alt="friend.name">
        </li>
      </ul>
    </div> 
  </div>
  </div>
</template>

<style src="../../www/assets/css/lateralMenu.css"></style>

<script>
  export default {
    data () {
      return {
        user : {
          userAvatar : '../assets/logo.png',
          username : 'LuckyPon', 
          userBadge : 'Baroudeuse de l\'espace', 
          userPlanet : {
            path : '../assets/Avatar1.svg',
            name : 'Planete X785-E'
          }, 
          lastFriends : [ {
            avatar : '../assets/Avatar1.svg',
            name : 'Spockdu77'
          }, {
            avatar : '../assets/Avatar1.svg',
            name : 'MartyDuPassé'
          }, {
            avatar : '../assets/Avatar1.svg',
            name : 'JulieDuFutur'
          }
          ]
        }
      }
    }
  }
</script>
