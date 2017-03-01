<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
      </aside>
      <section class="article col-sm-8">
        <div class="row container-colored">
          <div class="col-sm-2">
            <img :src="user.userAvatar">
          </div>
          <div class="col-sm-8">
            <p v-if="myself"> Mon profil </p>
            <p v-else> Profil de {{ user.username }} </p>
            <small> {{ user.userBadge }} </small>
            <p> Né le {{ user.birthDate }} </p>
          </div>
          <div class="col-sm-2">
            <img :src="user.userPlanet.path"> 
            <p> {{ user.userPlanet.name }} </p>
          </div>
        </div>
        
        <optionBar :myself="myself"></optionBar>

        <statistics  :user="user"></statistics>

        <button @click="profil"> (debug) Profil change from public to private</button>  

        <Post></Post>
      </section>
      <div class="col-sm-2">
         <lateralMenuRight></lateralMenuRight>
      </div>
    </div>
  </div>
</template> 






<script>

import LateralMenuLeft from './LateralMenuLeft.vue'
import LateralMenuRight from './LateralMenuRight.vue'
import MenuTools from './MenuTools.vue'
import Post from './Post.vue'

let optionBar = {
  props: ['myself'],

  template: `
  <div>
    <ul class="wrapper" v-if="myself">
      <li class="item container-colored">
        <img src="../assets/Friends.svg">
        <p> Debloquer des récompenses </p>
      </li>
      <li class="item container-colored">
        <img src="../assets/Messages.svg">
        <p> Modifier mes informations </p>
      </li>
      <li class="item container-colored">
        <p> Autres actions </p>
      </li>
    </ul>
    <ul class="wrapper" v-else>
      <li class="item container-colored">
        <img src="../assets/Friends.svg">
        <p> Ajouter à mes amis </p>
      </li>
      <li class="item container-colored">
        <img src="../assets/Messages.svg">
        <p> Envoyer un message </p>
      </li>
      <li class="item container-colored">
        <p> Autres actions </p>
      </li>
    </ul>
  </div>
  `
}

let statistics = {
  props: ['user'],
  template : `
  <div class="container-colored relative">
    
    <div class="row">
      <div class="col-sm-12">
        <h1 class="text-left">Statistiques</h1>
        <p> Nombre d'amis : {{ user.nbFriends}} </p>
        <p> Nombre d'enigmes résolues : {{ user.nbRiddleSolved}} </p>
        <p> Nombre de points : {{ user.points }} </p>
      </div>
    </div>
     <div class="row">
      <div class="col-sm-12">
        <h1 class="text-left">Derniers badges débloqués</h1>
         <ul class="wrapper">
          <li class="item" v-for="badge in user.lastBadges"> 
            <img :src="badge.path"> 
            <p> {{ badge.name }} </p>
          </li>
        </ul>
      </div>
    </div>
     <div class="row">
      <div class="col-sm-12">
        <h1 class="text-left">Dernier titre débloqué</h1>
        <p> {{ user.userBadge}} </p>
      </div>
    </div>
    <a href="" class="top-right">Masquer</a>
    <a href="" class="bottom-right">Voir toutes les récompenses obtenues</a>  
  </div>
  `
}

export default {
  components: {optionBar, statistics, LateralMenuLeft, LateralMenuRight, MenuTools, Post },
   methods: {
    profil: function(){
      if (this.myself)
        this.myself = false
      else 
        this.myself = true
      console.log(this.myself)

    }
  }, 
  data () {
      return {
       user: {
        userAvatar : '../assets/logo.png',
        username : 'LuckyPon', 
        userBadge : 'Baroudeuse de l\'espace', 
        birthDate : '29 avril',
        userPlanet : {
          path : '../assets/Avatar1.svg',
          name : 'Planete X785-E'
        }, 
        nbFriends : 53, 
        nbRiddleSolved : 2,
        points : 745,
        lastBadges : 
          [ { path  : '../assets/logo.png',
            name : 'Resoudre une énigme'},
            { path : '../assets/logo.png',
            name : 'Ajouter un ami'},
            { path : '../assets/logo.png',
            name : 'Inscription'}
          ]
       }, 
       myself : false
    }

  }
}
</script>