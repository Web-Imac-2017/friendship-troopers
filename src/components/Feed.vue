<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
      </aside>
      <section class="article col-sm-8">

        <create-post :post="post"></create-post>
        <Post></Post>

      </section>
      <div class="col-sm-2">
         <lateralMenuRight></lateralMenuRight>
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