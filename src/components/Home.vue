<template>
  <section class="article">
    <post-template :post="post"></post-template>
    <pre>{{post}}</pre>
    <create-post :post="post"></create-post>
  </section>
</template>

<script>
let postTemplate = {
  props:{
    post:Object
  },
  template:
    `
    <div class="post row"> 
      <div class="col-sm-9">
          <img src="../../www/assets/images/Avatar1.svg" alt="default avatar" class="col-sm-3">
          <h1 class="pseudo">{{ post.user }}</h1>
          <small> {{ post.date + post.hour }}</small>
          <p> {{ post.content }} </p>
      <div class="inter">
        <img src="/assets/images/Like.svg">
        <span> {{ post.likes }} </span>
        <img src="/assets/images/Comments.svg"> 
        <span> {{ post.comments }}</span>
      </div>
    </div>
  </div>
    `
}

let createPost = {
  props:{
    post:Object
  },
  template:
    `
    <form class="form" @submit.prevent="save">
    <img src="../../www/assets/images/Avatar1.svg" alt="Default avatar">
    <input type="text" placeholder="Publier quelque chose ..">
    <img src="../../www/assets/images/picture.svg" alt="Default avatar">
    <button class="button" type="submit">Publier</button> 
    <p><slot name="footer"></slot></p>
    </form>
    `
}
  export default {
  components: { postTemplate, createPost },
  data () {
      return {
        post:{
          user: 'Lucky',
          avatar : 'AVATAR',
          date: '20 fev',
          hour: '12h04',
          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
          likes: '50',
          comments: '2'
        }
      }
    }

}
</script>

<style>
</style>