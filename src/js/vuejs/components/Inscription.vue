
<template>
	


		

		<form-user v-model="user" title="Request form">

			<div v-show='error1' slot="error1">{{user.username}} est déjà utilisé !</div>
			<div v-show='error2' slot="error2">L'adresse mail {{user.mail}} est déjà utilisée !</div>

		</form-user>

	

				
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
			etape:'A'
		}
	},
	methods:{
		save(){
			this.$emit("input", this.user);
        	if(this.etape === 'A'){
        		this.etape='B';
        		console.log("B");
        	}else if(this.etape === 'B'){
        		this.etape='C';
        		console.log("C");
        	}else{
        		this.etape='A';
        		console.log("A");
        	}
		}
	},
	template: `
	<div class="container login"> 
		<div class="row">
			<div v-if="etape === 'A'" class="col-sm-4">
				<h1>Frienship troopers</h1>
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
				<form class="form" @submit.prevent="save">
					<h1>{{ title }}</h1>
					<div v-if="etape === 'A'">
						<div class="field">
							<label for="">Pseudo</label>
							<input type="text" v-model="user.username">
						</div>
						<div class="field">
							<label for="">Mail</label>
							<input type="email" v-model="user.mail">
						</div>
						<div class="field">
							<label for="">Mot de passe</label>
							<input type="password" v-model="user.password">
						</div>
					</div>
					<div v-else-if="etape === 'B'">
						<div class="field">
							<label for="">coucouB</label>
							<input type="password">
						</div>
					</div>
					<div v-else-if="etape === 'C'">
						<div class="field">
							<label for="">coucouC</label>
							<input type="password">
						</div>
					</div> 
					<div class="field">
						<a href="">J'ai déjà un compte</a>
						<button v-on:click.stop="save">S'inscrire<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
					</div>
					<p><slot name="error1"></slot></p>
					<p><slot name="error2"></slot></p>
			    </form>
			</div>
			
		</div>
		<pre>{{user}}</pre>
	</div>


	  		
	`
	/*mounted: function(){
		console.log(this)
	}*/
}
export default {
	components: {formUser },
	data () {
      return {
        user:{
        	username: '',
	        mail: '',
	        password: '',
        },
        error1:false,
        error2:false,
        etape:'A'

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


