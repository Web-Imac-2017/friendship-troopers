<template>
  <nav class="navbar navbar-default">
    <a class="navbar-brand" href="/"> {{$store.state.appTitle}} {{$store.state.appVersion}}</a>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <router-link to="/" class="nav-item nav-link"> Home </router-link>
        <router-link to="/login" class="nav-item nav-link"> Login </router-link>
        <router-link to="/inscription" class="nav-item nav-link"> Inscription </router-link>
        <router-link to="/home" class="nav-item nav-link"> Home </router-link>
      </li>
      <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
    </ul>
  </nav>
</template>

<script>
  export default {
  }
</script>
