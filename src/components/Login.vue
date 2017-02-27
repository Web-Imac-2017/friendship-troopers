<template>
	<div class="container login">

	  	<div class="row">
	  		<div class="col-sm-4">
	  			<h1>Friendship troopers</h1>
	  			<div class="center">
	  				<p>
	  					Venez partager votre passion de la science-fiction à travers ce réseau social mélant énigmes et bonne humeur !
					</p> <p>
						A votre inscription, vous répondrez à une série de questions et une planète vous sera attribuée en fonction de vos réponses...
					</p> <p>
						Vous pourrez ensuite rencontrer d’autres passionnés en résolvant des énigmes avec eux !
	  				</p> 
	  			</div>
	  		</div>
	  		<div class="col-sm-8">
	  			<div class="row">
	  				<div class="col-sm-5" @click="inscription"><h1>Inscription</h1></div>
	  				<div class="col-sm-5" @click="connexion"><h1>Connexion</h1></div>
	  			</div>

				<form-user :user="user" :login="login" title="Request form">

					<div v-show='error1' slot="error1">{{user.username}} est déjà utilisé !</div>
					<div v-show='error2' slot="error2">L'adresse mail {{user.mail}} est déjà utilisée !</div>

				</form-user>

				<!-- <pre>{{user}}</pre> -->

			</div>

		</div>
	</div>

</template> 


<script>
let formUser = {
	props: ['login','user'],
	methods:{
		save(){
			this.$emit("input", this.user),
			this.error1=true,
        	this.error2=true	
		}
	},
	template: `
	<div>
		<form v-if="login" class="form" @submit.prevent="save">
			<div class="field">
				<label for="">Pseudo</label>
				<input type="text" v-model="user.username" name='username'>
			</div>
			<div class="field">
				<label for="">Adresse e-mail</label>
				<input type="email" v-model="user.mail" name='mail'>
			</div>
			<div class="field" >
				<label for="">Mot de passe</label>
				<input type="password" v-model="user.password" name='password'>
			</div>	
			<div class="field">
				<button v-on:click.stop="save">Se connecter<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
			</div>
	    </form>
	    <form v-else class="form" @submit.prevent="save">
			<div class="field">
				<label for="">Pseudo</label>
				<input type="text" v-model="user.username" name='username'>
			</div>
			<div class="field">
				<label for="">Adresse e-mail</label>
				<input type="email" v-model="user.mail" name='mail'>
			</div>
			<div class="field" >
				<label for="">Mot de passe</label>
				<input type="password" v-model="user.password" name='password'>
			</div>
			<div class="field">
				<label for="">Mot de passe<br>(répeter)</label>
				<input type="password" v-model="user.passwordChecked" name='password'>
			</div>
			<div class="field">
				<label for="">Date de naissance</label>
				<select name="day" id="day">
			       <option v-for="option in user.day">
			            {{ option }}
			        </option>
		       </select>
		       <select  name="month" id="month">
			       <option v-for="option in user.month">
			            {{ option }}
			        </option>
		       </select>
		       <select name="year" id="year">
			       <option v-for="option in user.year">
			            {{ option }}
			        </option>
		       </select>
			</div>
			<div class="field">
				<button v-on:click.stop="save">S''inscrire<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
			</div>
	    </form>
    	<p><slot name="error1"></slot></p>
		<p><slot name="error2"></slot></p>
	</div>
	
	  		
	`
}
export default {
	components: {formUser },
	methods: {
	    inscription: function(){
	      this.login = false
	    },
	    connexion: function(){
	      this.login = true
	    }
	  }, 
	data () {
      return {
        user:{
        	username: '',
	        mail: '',
	        password: '',
	        passwordChecked: '',
	        day : [ 1, 2, 3],
	        month : [ 'janvier', 'fevrier', 'mars'],
	        year : [ 1995, 1996, 2874]
        },
        error1:false,
        error2:false,
        login:false
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
