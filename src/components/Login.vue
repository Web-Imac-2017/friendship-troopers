<template>
  <section class="login">
    <h1>Inscription</h1>


    <form-user :user="user"></form-user>
    <pre>{{user}}</pre>

  </div>

  
    


  </section>
</template>


<script>

let formUser = {
	props:{
		user:Object
	},
	/*data(){
		userLocal:(....this.user)
	},*/
	template: `
	<div class="form">
		<div class="field">
			<label for="">Pseudo</label>
			<input type="text" v-model="user.pseudo">
		</div>
		<div class="field">
			<label for="">Mail</label>
			<input type="text" v-model="user.mail">
		</div>
		<div class="field">
			<label for="">Mot de passe</label>
			<input type="text" v-model="user.password">
		</div>
		<button class="button" type="submit">Envoyer</button>		
    </div>
	`	
}
export default {
	components: {formUser },
	data () {
      return {
        user:{
        	pseudo: 'Lucky',
	        mail: 'coucoffu@toi.fr',
	        password: 'hellopassword'
        }
      }
    }

}
</script>
