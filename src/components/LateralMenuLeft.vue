<template>

<<<<<<< HEAD
      <img src="../assets/logo.png" alt="your avatar" class="avatar">
      <img src="../assets/logo.png" alt="your planet" class="planet">
      
    </div>

    Je suis un super menu latéral !! <br/>
    Youpipipouharra !! <br/><br/>

    Je suis un super menu latéral !! <br/>
    Youpipipouharra !! <br/><br/>

    Je suis un super menu latéral !! <br/>
    Youpipipouharra !! <br/><br/>
=======
  <div class="container col-sm-12 lateralMenuLeft">
    <div class="lateralMenuAvatar">
    
 <!-- 
      <img :src="user.userAvatar" alt="your avatar" class="avatar">
      <img :src="user.userPlanet.path" alt="your planet" class="planet">
 -->
      <img src="../assets/logo.png" alt="your avatar" class="avatar">
      <img src="../assets/logo.png" alt="your planet" class="planet">

      <h1> {{ user.username }} </h1> <br>
      <p> {{ user.userBadge}} </p>

    </div>
>>>>>>> f890838ed731acbf4deab97c8ed3c77b5aafc24f

      <p class="enigmes"> Enigmes </p>
      <router-link to=""> Résoudre l'énigme en cours </router-link> <br>
      <router-link to=""> Voir la liste des enigmes </router-link> 

      <p class="amis">Amis</p>
      <router-link to=""> Voir tous mes amis </router-link> <br/>
      <router-link to=""> Accéder à la messagerie </router-link>
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
