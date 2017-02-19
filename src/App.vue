<template>
  <div>
    
    <div id="app">
      <navbar></navbar>
      <router-view></router-view>
      

    </div>
</template>


<script>
import Navbar from './components/Navbar'

export default {
  components: { Navbar }
}
</script>

<style src="../www/assets/css/reset.css"></style>

 <style lang="sass">
  // Bootstrap
  $icon-font-path: '../node_modules/bootstrap-sass/assets/fonts/bootstrap/';
  $link-color: #42b983;
  $brand-success: #42b983;
  @import 'node_modules/bootstrap-sass/assets/stylesheets/bootstrap';
  //some styling adaptations
  h1
    color: #42b983
  p
    text-align: justify
</style>


<style src="../www/assets/css/style.css"></style>