<template>
  <section class="article">
    <!-- <create-post :post="post"></create-post> -->
   <!--  <post-template :post="post"></post-template> -->
   <div class="row">
    <div class="col-sm-1">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
    </div>
    <div class="col-sm-8"> 
       <div class="container post">
          <div class="row">
            <div class="col-sm-1 avatar">
                <img src="../assets/Avatar1.svg" alt="default avatar" class="avatar">
            </div>
            <div class="col-sm-11">
              <form class="form-post" @submit.prevent="save">
              <!-- <textarea rows="3" type="text" placeholder="Publier quelque chose .."></textarea>
              <div class="field">
                <button v-on:click="uploadPicture" class="left"> Upload picture </button>
                <button v-on:click="publish">Publier</button>
              </div> -->
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
          </div>
        </div>
    </div>
    <div class="col-sm-2">
       <lateralMenuRight></lateralMenuRight>
    </div>
  </div>
          
          

    <pre>{{post}}</pre>
  </section>
</template>

<script>

let postTemplate = {
  props:{
    post:Object
  },
  template:
    `
    <div class="container post">
      <div class="row"> 
        <div class="col-sm-10">
          <div class="col-sm-1">
            <div class="avatar">
            <!-- <img src="../../www/assets/images/Avatar1.svg" alt="default avatar" class="avatar">-->
            </div>
          </div>
          <div class="col-sm-2 left">
            <h1 class="pseudo">{{ post.user }}</h1>
            <small class="date"> {{ post.date + " à " + post.hour }}</small>
          </div>
          <div class="col-sm-9 right">
            <img src="../../www/assets/images/Options.svg" alt="Options">
          </div>
        </div>  
      </div>
      <div class="row"> 
        <div class="col-sm-12">
          <p class="content-block"> {{ post.content }} </p>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-12 connect-buttons">
          <img src="/assets/images/Like.svg" alt="likes">
          <span> {{ post.likes }} </span>
          <img src="/assets/images/Comments.svg" alt="comments"> 
          <span> {{ post.comments }}</span>
        </div>
      </div>
    </div>
    </div>
  </div>
    `
}

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
                <!-- <img src="../../www/assets/images/Avatar1.svg" alt="default avatar" class="avatar">-->
        </div>
        <div class="col-sm-11">
          <form class="form-post" @submit.prevent="save">
          <textarea rows="3" type="text" placeholder="Publier quelque chose .."></textarea>
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

export default {
  components: { postTemplate, createPost, LateralMenuLeft, LateralMenuRight, MenuTools  },
  data () {
      return {
        post:{
          user: 'Lucky',
          avatar : "addresse de l'avatar",
          date: '20 fev',
          hour: '12h04',
          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
          likes: '50',
          comments: '2'
        }, 
        picture:false
      }
    }

}
</script>

<style>
</style>