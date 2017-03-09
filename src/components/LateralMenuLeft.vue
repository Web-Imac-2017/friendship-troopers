<template>

  <div class="container col-sm-10 lateralMenuLeft">
    <div class="lateralMenuAvatar">
    
 <!-- 
      <img :src="user.userAvatar" alt="your avatar" class="avatar">
      <img :src="user.userPlanet.path" alt="your planet" class="planet">
 -->  
      <img class="avatarMenu" src="../assets/Avatar1.svg" alt="your planet">
      <img class="planet" src="../assets/P1.svg" alt="your planet">

    </div>

      <div>
        <h1> <font size="14">{{ user.username }} </h1></font>
        <center><font size="10">{{ user.userBadge }}</center></font>

      </div>

      <div>
      <br><p class="enigmes"><font color="#c33a78"> <b>Enigmes </b> </p>
      <router-link to=""> Résoudre l'énigme en cours </router-link> <br>
      <router-link to=""> Voir la liste des enigmes </router-link> 
      </div>

      <br><div>
      <p class="amis"><font color="#17d4b2"><font size="11"><b>Amis</font></b></p>
      <router-link to=""> Voir tous mes amis </router-link> <br/>
      <router-link to=""> Accéder à la messagerie </router-link>
      <div class="lastFriends">
        <p> <u>Derniers compagnons:</u></p>
        </div>
        <div align="center">
          <img src="../assets/Avatar1.svg" width="30%" height="30%" alt="" align="right" style="float:right"/>
          <img src="../assets/Avatar1.svg" width="30%" height="30%" alt="" align="left" style="float:left" />
            <div id="content" align="center"> 
            <img src="../assets/Avatar1.svg" width="30%" height="30%" alt="" align="center" />
            </div>
        </div>

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
          userBadge : 'Astronaute Débutant', 
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