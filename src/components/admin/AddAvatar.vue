<template>
  <div class="row">

    <div class="admin-menu col-sm-2">
        <menuAdmin></menuAdmin>
    </div>
    
    <div class="col-sm-8"> 
    <h1>Ajouter un avatar</h1>
    </div>
  
  </div>

</template>

<style src="../../../www/assets/css/admin.css"></style>

<script>

import menuAdmin from './NavbarAdmin'

export default {
  components: { menuAdmin } 

}
</script>