<template>
  <section class="article">
    <p> tutututu </p>
    <form-article :user="user"></form-user>
    <pre>{{user}}</pre>

  </div>

  
    


  </section>
</template>

<script>
let formArticle = {
  props:{
    user:Object
  },
  template: {

  }
}
  export default {
  components: {formArticle },
  data () {
      return {
        user:{
          pseudo: 'Lucky',
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

