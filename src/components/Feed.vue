<template>
  <section class="article">
   <div class="row">
    <div class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools> 
    </div>
    <div class="col-sm-8"> 
        <create-post :post="post"></create-post>
        <Post></Post>
  
    </div>
    <div class="col-sm-2">
       <lateralMenuRight></lateralMenuRight>
    </div>
  </div>
  <pre>{{post}}</pre>
  </section>
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
    <div class="container post">
      <div class="row">
        <div class="col-sm-1 avatar">
            <img src="../assets/Avatar1.svg" alt="default avatar" class="avatar">
        </div>
        <div class="col-sm-11">
          <form class="form-post" @submit.prevent="save">
            <textarea rows="3" type="text" placeholder="Publier quelque chose"></textarea>
            <div class="field">
              <button v-on:click="uploadPicture" class="left"> Upload picture </button>
              <button v-on:click="publish">Publier</button>
            </div> 
          </form>
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