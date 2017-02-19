<template>
  <div id="app" class="container text-center">
    <br />
    <navbar></navbar>
    <br />
    <router-view></router-view>
    <br /><br />
    <h4> Welcome to your Vue.js app </h4>
    <hr />
  </div>
</template>

<script>
import Navbar from './components/Navbar'

export default {
  components: { Navbar }
}
</script>

<style src="./scss/style.less"></style>

