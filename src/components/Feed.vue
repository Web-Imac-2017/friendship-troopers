<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
      </aside>
      <section class="article col-sm-8">

<<<<<<< HEAD
        <create-post :post="post"></create-post>
        <Post></Post>

      </section>
      <div class="col-sm-2">
         <lateralMenuRight></lateralMenuRight>
=======
   <div class="container post">
      <div class="row">
        <div class="col-sm-1 avatar">
            <img src="../assets/Avatar1.svg" alt="default avatar" class="avatar">
        </div>
        <div class="col-sm-11">
          <!-- <form class="form-post" @submit.prevent="save">
          <textarea rows="3" type="text" placeholder="Publier quelque chose .."></textarea>
          <div class="field">
            <button v-on:click="uploadPicture" class="left"> Upload picture </button>
            <button v-on:click="publish">Publier</button>
          </div> -->
          </form>
          <form class="form-post" @submit.prevent="save">
            <textarea rows="3" type="text" placeholder="Publier quelque chose"></textarea>
            <div class="field">
              <button class="left"> Upload picture </button>
              <button>Publier</button>
          </div> 
          </form>
        </div>
      </div>
    </div>
   
    <div class="container post">
      <div class="row"> 
        <div class="col-sm-1">
            <div class="avatar">
            <img src="../assets/Avatar1.svg" alt="default avatar" class="avatar">
            </div>
        </div>
        <div class="col-sm-11">
          <div class="row"> 
            <div class="col-sm-11 left">
              <h1 class="pseudo">{{ post.user }}</h1>
              <small class="date"> {{ post.date + " à " + post.hour }}</small>
            </div>
            <div class="col-sm-1 right contain-img">
              <img src="../assets/Options.svg" alt="Options">
            </div>
          </div>
          <div class="row"> 
            <div class="col-sm-12">
              <p class="content-block"> {{ post.content }} </p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-10 left">
              <button>Voir plus</button>
            </div>
            <div class="col-sm-1 connect-buttons contain-img">
              <img class="like-icon" src="../assets/Like.svg" alt="likes">
              <span> {{ post.likes }} </span>
            </div>
            <div class="col-sm-1 connect-buttons contain-img">
              <img src="../assets/Comment.svg" alt="comments"> 
              <span> {{ post.comments }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row comment"> 
        <div class="col-sm-1">
            <div class="avatar">
              <img src="../assets/Avatar1.svg" alt="default avatar" class="avatar">
            </div>
        </div>
        <div class="col-sm-11">
          <form class="form-post" @submit.prevent="save">
            <textarea rows="3" type="text" placeholder="Votre commentaire"></textarea>
            <button>Publier</button>
          </form>
        </div>
>>>>>>> welcomeOnBoard
      </div>
      <pre>{{post}}</pre>


    </div>
  </div>
  
</template>

<script>


let createPost = {
  props:{
    post:Object
  }, 
  methods:{
    publish(){
      this.$emit("post", this.user)  
    },
    uploadPicture(){
      this.picture = true     
    }
  },
  template:
    `
    <div class="post">
      <div class="row">
        <div class="col-md-1 col-lg-1 avatar">
            <img src="http://placehold.it/150x150" alt="default avatar" class="avatar">
        </div>
        <div class="col-md-11 col-lg-11">
          <form class="form-post" @submit.prevent="save">
            <textarea rows="3" type="text" placeholder="Publier quelque chose"></textarea>
          </form>
        </div>
      </div>
      <div class="row button-field">
        <div class="col-md-1 col-lg-1"></div>
        <div class="col-sm-5 text-left">
          <button v-on:click="uploadPicture"> <img src="http://placehold.it/55x15" alt="Upload Picture" class="avatar"> </button>
        </div>
        <div class="col-sm-6 text-right">
          <button v-on:click="publish">Publier</button>
        </div> 
      </div>
    </div>
    `
}

import LateralMenuLeft from './LateralMenuLeft'
import LateralMenuRight from './LateralMenuRight'
import MenuTools from './MenuTools'
import Post from './Post.vue'

export default {
  components: { createPost, LateralMenuLeft, LateralMenuRight, MenuTools, Post  },

}
</script>

<style>
</style>