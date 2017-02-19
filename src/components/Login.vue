
<template>
	<div class="container">

	  	<div class="row">
	  		<div class="col-sm-6">
	  			<h1>Frienship troopers</h1>
	  			<div>
	  				<p>
	  					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est dolorem dolores quidem nihil asperiores, voluptates voluptate alias impedit perferendis!
	  				</p> 
	  				<p>
	  					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est dolorem dolores quidem nihil asperiores, voluptates voluptate alias impedit perferendis!
	  				</p> 
	  			</div>
	  		</div>
	  		<div class="col-sm-6">

	<form-user v-model="user" title="Request form">
		<div slot="header">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis, minus.</div>
		<div slot="footer">Footer ipsum dolor sit amet, consectetur adipisicing elit. Debitis, minus.</div>

		<div slot="error">{{user.pseudo}} est déjà utilisé !</div>

	</form-user>

	<pre>{{user}}</pre>

	</div>

	</div>
</div>





</template> 


<script>

let formUser = {
	props:{
		value:Object
	},
	data(){
		return{
			user:JSON.parse(JSON.stringify(this.value)),
			title: 'Inscription',
			seen:false
		}
	},
	methods:{
		save(){
			this.$emit("input", this.user)
		}
	},
	template: `
	<form class="form" @submit.prevent="save">
		<h1>{{ title }}</h1>
		<p><slot name="header"></slot></p>
		<div class="field">
			<label for="">Pseudo</label>
			<input type="text" v-model="user.pseudo" placeholder="edit me">
			<p><slot name="error" v-if="seen"></slot></p>
		</div>
		<div class="field">
			<label for="">Mail</label>
			<input type="text" v-model="user.mail" placeholder="edit me">
		</div>
		<div class="field">
			<label for="">Mot de passe</label>
			<input type="text" v-model="user.password" placeholder="edit me">
		</div>
		<a href="">Jai déjà un compte</a>
		<button class="button" type="submit">Envoyer</button>	
		<p><slot name="footer"></slot></p>
    </form>
	  		
	`
	,/*mounted: function(){
		console.log(this)
	}*/
}
export default {
	components: {formUser },
	data () {
      return {
        user:{
        	pseudo: '',
	        mail: '',
	        password: ''
        },

      }
    }

}
</script>





<style>
/*  html, body, .container-table {
 height: 100%;
 background-color: #282B30 !important;
}
.container-table {
   display: table;
   color: white;
}
.vertical-center-row {
   display: table-cell;
   vertical-align: middle;
}
.vertical-20p {
 padding-top: 20%;
}
.vertical-10p {
 padding-top: 10%;
}
.logo {
 width: 15em;
 padding: 3em;
}
.loginForm .input-group {
 padding-bottom: 1em;
 height: 4em;
}
.input-group input {
 height: 4em;
}  */
</style>


