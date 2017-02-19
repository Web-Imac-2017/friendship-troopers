<template>
  <div>
    
    <div id="app">
      <navbar></navbar>
      <h4> Welcome to friendship troopers</h4>

      <router-view></router-view>
      

    </div>
</template>


<script>
import Navbar from './components/Navbar'

export default {
  components: { Navbar }
}
</script>

<style src="./scss/style.less"></style>

