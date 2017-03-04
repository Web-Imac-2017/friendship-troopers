<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
      </aside>
      <section class="article col-sm-10">
        <div class="row">
          <img src="http://placehold.it/150x150">
          <h1> Amis de la planète {{ user.planetSelected }}</h1>
          <p> {{ user.nbFriends }} au total</p>
        </div>
        <FriendTemplate :user="user"></FriendTemplate>


      </section>


    </div>
    
    
  </div>
</template>

<script>
import LateralMenuLeft from './LateralMenuLeft'
import MenuTools from './MenuTools'

let FriendTemplate = {
  props: ['user'], 
  template:
    `
    <div>
    <ul class="wrapper friend-list">
      <li class="item" v-for="friend in user.friends"> 
        <img :src="friend.path"> 
        <h1> {{ friend.name }} </h1>
        <p> {{ friend.badge }} </p>
        <p>Date de naissance :</p>
        <p> {{ friend.birthDate }} </p>
      </li>
    </ul>
    </div>
    `
}

export default {
  components: {FriendTemplate, LateralMenuLeft, MenuTools }, 
  data () {
      return {
       user: {
        nbFriends : 7,
        planetSelected : 'Eat-712', 
        friends : 
          [ { 
              path  : 'http://placehold.it/350x350',
              name : 'ILoveUfo',
              badge : 'Baroudeuse de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'JeanLuc',
              badge : 'Baroudeur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : 'http://placehold.it/350x350',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'}
          ]
       } 
    }

  }
}
</script>

