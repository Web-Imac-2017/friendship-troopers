<template>
   <div class="container">
    <div class="row center post">
      <div class="col-sm-8">
        <img :src="user.userAvatar">
        <p v-if="myself"> Mon profil </p>
        <p v-else> Profil de {{ user.username }} </p>
        <small> {{ user.userBadge }} </small>
        <p> Né le {{ user.birthDate }} </p>
      </div>
      <div class="col-sm-4"> 
        <img :src="user.userPlanet.path"> 
        <p> {{ user.userPlanet.name }} </p>
      </div>
    </div>
    <optionBar :myself="myself"></optionBar>
    <statistics  :user="user"></statistics>
    <button @click="profil"> (debug) Profil change from public to private</button>
</div>
</template>


<script>

let optionBar = {
  props: ['myself'],

  template: `
    <div class="row">
      <div class="col-sm-12" v-if="myself">
        <div class="col-sm-3 post">
          <img src="../assets/Friends.svg">
          <p> Debloquer des récompenses </p>
        </div>
         <div class="col-sm-3 post">
          <img src="../assets/Messages.svg">
          <p> Modifier mes informations </p>
        </div>
         <div class="col-sm-3 post">
          <p> Autres actions </p>
        </div>
      </div>
      <div class="col-sm-12" v-else>
        <div class="col-sm-3 post">
          <img src="../assets/Friends.svg">
          <p> Ajouter à mes amis </p>
        </div>
         <div class="col-sm-3 post">
          <img src="../assets/Messages.svg">
          <p> Envoyer un message </p>
        </div>
         <div class="col-sm-3 post">
          <p> Autres actions </p>
        </div>
      </div>
    </div>
  `
}

let statistics = {
  props: ['user'],
  template : `
  <div class="container post">
    <div class="row">
       <div class="col-sm-12">
         <h1> Statistics </h1>
         <p> Nombre d'amis : {{ user.nbFriends}} </p>
          <p> Nombre d'enigmes résolues : {{ user.nbRiddleSolved}} </p>
          <p> Nombre de points : {{ user.points }} </p>
        <div>
      </div>
    <div class="row">
      <div class="col-sm-12">
        <h1> Derniers badges débloqués </h1>
        <ul> 
          <li class="col-sm-2" v-for="badge in user.lastBadges"> 
            <img :src="badge.path"> 
            <p> {{ badge.name }} </p>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h1> Dernier titre débloqué </h1>
        <p> {{ user.userBadge}} </p>
      </div>
      <div class="col-sm-3 right">
        <p> Voir toutes les autres récompenses obtenues </p>
      </div>
    </div>
  </div>
  `
}

export default {
  components: {optionBar, statistics },
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