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

				<form-user v-model="user" :login="login" title="Request form">

					<p slot="errorUsername">{{user.username}} est déjà utilisé !</p>
					<p slot="errorMail">L'adresse mail {{user.mail}} est déjà utilisée !</p>
					<p slot="errorPassword">Les deux mots de passe ne correspondent pas !</p>
					<p slot="errorLogin">
						L'adresse mail et le mot de passe ne correspondent pas! <br>
						Veuillez reessayer ou réinitialiser votre mot de passe
					</p>
					<p slot="passwordMissing">Veuillez rentrer un mot de passe</p>
					<p slot="errorDate">La date de naissance est invalide !</p>

				</form-user>

				<pre>{{user}}</pre>

			</div>

		</div>
	</div>

</template> 


<script>
let formUser = {
	props: {
		login:Boolean,
		value:Object,
	},
	data(){
		return{
			user: JSON.parse(JSON.stringify(this.value)),
			alreadyUsedUsername:false,
			alreadyUsedMail:false,
			falsePassword:false,
			passwordNot:false,
			errorLogin:false,
			falseDate:false,
		}
	},
	methods:{
		save(){
			this.$emit('input', this.user);



        	if(!this.login & this.user.username == this.$parent.usernameExisting){
	      		this.alreadyUsedUsername=true;
	      		console.log("Pseudo deja utilisé :"+this.alreadyUsedUsername);
	      	}else
	      		this.alreadyUsedUsername=false;
	      	if(!this.login & this.user.mail == this.$parent.mailExisting){
	      		this.alreadyUsedMail=true;
	      		console.log("Mail deja utilisé :"+this.alreadyUsedMail);
	      	}else
	      		this.alreadyUsedMail=false;
	      	if(!this.login & this.user.password != this.user.passwordChecked){
	      		this.falsePassword=true;
	      		console.log("Les deux mots de passe sont différents :"+this.falsePassword);
	      	}else
	      		this.falsePassword=false;
	      	if(this.login & (this.user.mail != "admin@gmail.com" | this.user.password != "admin")){
	      		if(this.user.password == ""){
	      			this.passwordNot=true;
	      			this.errorLogin=false;
	      		}else{
	      			this.passwordNot=false;
		      		this.errorLogin=true;
		      		console.log("erreur login :"+this.errorLogin);
	      		}	
	      	}else
	      		this.errorLogin=false;

	      	this.checkDate();
		},
		isBissextile(value){
			if((value % 4 == 0 && value%100 != 0) || value%400 == 0) 
				return true;
			else
				return false;
		},
		checkDate(){
	    	if((this.user.day == 30 || this.user.day == 31) && this.user.month == 2)
	    		this.falseDate = true;
	    	else if(this.user.day == 29 && this.user.month == 2){
	    		if(this.isBissextile(this.user.year)){
	    			console.log("ok");
					this.falseDate = false;
	    		}else
	    			this.falseDate = true;
	    	}
	    	else if(this.user.day == 31 && (this.user.month == 4 | this.user.month == 6 | this.user.month == 9 | this.user.month == 11 ))
	    		this.falseDate = true;
	    	else
	    		this.falseDate = false;
	    }
	},
	template: `
	<div>
		<form v-if="login" class="form" @submit.prevent="save">
			<div class="field">
				<label for="">Adresse e-mail</label>
				<input maxlength="255" type="email" v-model="user.mail" name='mail' required>
			</div>
			<div class="field" >
				<label for="">Mot de passe</label>
				<input maxlength="255" type="password" v-model="user.password" name='password' required>
				<div v-if="passwordNot"><slot name="passwordMissing"></slot></div>
			</div>	
			<div class="field">
				<div v-if="errorLogin"><slot name="errorLogin"></slot></div>
				<a href="">J'ai oublié mon mot de passe</a>
				<button @click.prevent="save">Se connecter<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
			</div>
	    </form>
	    <form v-else class="form" @submit.prevent="save">
			<div class="field">
				<label for="">Pseudo</label>
				<input maxlength="255" type="text" v-model="user.username" name='username' required>
				<div v-if="alreadyUsedUsername"><slot name="errorUsername"></slot></div>
			</div>
			<div class="field">
				<label for="">Adresse e-mail</label>
				<input maxlength="255" type="email" v-model="user.mail" name='mail' required>
				<div v-show="alreadyUsedMail"><slot name="errorMail"></slot></div>
			</div>
			<div class="field" >
				<label for="">Mot de passe</label>
				<input maxlength="255" type="password" v-model="user.password" name='password' required>
			</div>
			<div class="field">
				<label for="">Mot de passe<br>(répeter)</label>
				<input maxlength="255" type="password" v-model="user.passwordChecked" required>
				<div v-if="falsePassword"><slot name="errorPassword"></slot></div>
			</div>
			<div class="field">
				<label for="">Date de naissance</label>
				<select v-model.number="user.day" name="day" id="day" required>
			       <option v-for="option in user.dayTab">
			            {{ option }}
			        </option>
		       </select>
		       <select v-model.number="user.month" name="month" id="month" required>
			       <option v-for="option in user.monthTab">
			            {{ option }}
			        </option>
		       </select>
		       <select v-model.number="user.year" name="year" id="year" required>
			       <option v-for="option in user.yearTab">
			            {{ option }}
			        </option>
		       </select>
			<div v-if="falseDate"><slot name="errorDate"></slot></div>
			</div>
			<div class="field">
				<button @click.prevent="save">S'inscrire<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
			</div>
	    </form>
		
		
	</div>
	
	  		
	`
}
export default {
	components: {formUser },
	methods: {
	    inscription: function(){
	      this.login = false;
	      this.reinitialize();
	    },
	    connexion: function(){
	      this.login = true;
	      this.reinitialize();
	    },
	    reinitialize: function(){
	    	this.user.username = '';
	        this.user.mail = '';
	        this.user.password = '';
	        this.user.passwordChecked = '';
	        this.alreadyUsedUsername = false;
			this.alreadyUsedMail = false;
			this.falsePassword = false;
			this.passwordNot = false;
			this.errorLogin = false;
	    }

	  }, 
	data () {
      return {
        user:{
        	username: '',
	        mail: '',
	        password: '',
	        passwordChecked: '',
	        day:28,
	        month:1,
	        year:1995,
	        dayTab : [ 28, 29, 30, 31],
	        monthTab : [ 1, 2, 3,4,5,6,7,8,9,10,11,12],
	        yearTab : [ 1995, 1996, 2000, 2017]
        },
        usernameExisting:'JeanLuc',
        mailExisting:'JeanLuc@gmail.com',
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
