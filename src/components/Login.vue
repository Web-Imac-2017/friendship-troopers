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

				<form-user v-model="userSignIn" v-if="signIn">

					<p slot="errorUsername">{{userSignIn.username}} est déjà utilisé !</p>
					<p slot="errorMail">L'adresse mail {{userSignIn.mail}} est déjà utilisée !</p>
					<p slot="errorMailValid">L'adresse mail n'est pas valide, veuillez vérifier svp !</p>
					<p slot="errorPassword">Les deux mots de passe ne correspondent pas !</p>
					<p slot="errorLowPassword">Le mot de passe n'est pas suffisament compliqué! Il doit comporter 1 chiffre, 1 lettre et au minimum 8 caractères.</p>
					<p slot="passwordMissing">Veuillez rentrer un mot de passe</p>
					<p slot="errorDate">La date de naissance est invalide !</p>
					<p slot="nullInputUsername">{{ nullMessage }}</p>
					<p slot="nullInputMail">{{ nullMessage }}</p>
					<p slot="nullInputPassword">{{ nullMessage }}</p>
					<p slot="nullInputPasswordChecked">{{ nullMessage }}</p>

				</form-user>

				<form-login v-model="userLogin" v-else>
		
					<p slot="errorLogin">
						L'adresse mail et/ou le mot de passe ne correspondent pas! <br>
						Veuillez reessayer ou réinitialiser votre mot de passe
					</p>

				</form-login>

				<pre>{{userLogin}}</pre>
				<pre>{{userSignIn}}</pre>

			</div>

		</div>
	</div>

</template> 


<script>

let formLogin = {
	props: {
		value:Object,
	},
	data(){
		return{
			userLogin: JSON.parse(JSON.stringify(this.value)),
			cantSubmit:false
		}
	},
	methods:{
		connect(){
			this.$emit('input', this.userLogin);
			if(this.userLogin.mail != "" | this.userLogin.password != ""){
				if(this.userLogin.mail == "admin@gmail.com" && this.userLogin.password == "admin"){
					this.cantSubmit=false;
					console.log("connexion en cours !!! Gerer ça quand liaison front/back done");
				}else
					this.cantSubmit=true;
			}else{
				this.cantSubmit=true;
			}
	      		
		}
	},
	template: `
	<form class="form" @submit.prevent.stop="connect">
		<div class="field">
			<label for="">Adresse e-mail</label>
			<input maxlength="255" type="email" v-model="userLogin.mail" name='mail' required>
		</div>
		<div class="field" >
			<label for="">Mot de passe</label>
			<input maxlength="255" type="password" v-model="userLogin.password" name='password' required>
		</div>	
		<div class="field">
			<div v-if="cantSubmit"><slot name="errorLogin"></slot></div>
			<a href="">J'ai oublié mon mot de passe</a>
			<button>Se connecter<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
		</div>
    </form>  		
	`
		
}

let formUser = {
	props: {
		value:Object,
	},
	data(){
		return{
			userSignIn: JSON.parse(JSON.stringify(this.value)),
			alreadyUsedUsername:false,
			alreadyUsedMail:false,
			falseMail:false,
			lowPassword:false,
			falsePassword:false,
			falseDate:false,
			nullUsername:false,
			nullMail:false,
			nullPassword:false,
			nullPasswordChecked:false
		}
	},
	methods:{
		checkMail(){
			var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
			this.falseMail = (!regex.test(this.userSignIn.mail)) ? true : false;
		},
		checkPassword(){
			var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-zA-Z]).*$/;
			
			this.falsePassword = (this.userSignIn.password != this.userSignIn.passwordChecked) ? true : false;
			if(!this.falsePassword)
				this.lowPassword = (!regex.test(this.userSignIn.password)) ? true : false;
		},
		checkInputs(){
			this.nullUsername = (this.userSignIn.username == '') ? true : false;
			this.nullMail = (this.userSignIn.mail == '') ? true : false;
			this.nullPassword = (this.userSignIn.password == '') ? true : false;
			this.nullPasswordChecked = (this.userSignIn.passwordChecked == '') ? true : false;

			this.alreadyUsedUsername = (this.userSignIn.username == this.$parent.usernameExisting) ? true : false;
			this.alreadyUsedMail = (this.userSignIn.mail == this.$parent.mailExisting) ? true : false;
			
			this.checkPassword();
	      	this.checkDate();
	      	this.checkMail();

	      	return ((!this.nullUsername)&&(!this.nullMail)&&(!this.lowPassword)&&(!this.nullPassword)&&(!this.nullPasswordChecked)&&(!this.alreadyUsedMail)&&(!this.alreadyUsedUsername)&&(!this.falsePassword)&&(!this.falseDate)&&(!this.falseMail)) ? true : false;
		},
		isBissextile(value){
			return ((value % 4 == 0 && value%100 != 0) || value%400 == 0) ? true : false;
		},
		checkDate(){
	    	if((this.userSignIn.day == 30 || this.userSignIn.day == 31) && this.userSignIn.month == 2)
	    		this.falseDate = true;
	    	else if(this.userSignIn.day == 29 && this.userSignIn.month == 2){
	    		this.falseDate = (this.isBissextile(this.userSignIn.year)) ? false : true;
	    	}
	    	else if(this.userSignIn.day == 31 && (this.userSignIn.month == 4 | this.userSignIn.month == 6 | this.userSignIn.month == 9 | this.userSignIn.month == 11 ))
	    		this.falseDate = true;
	    	else
	    		this.falseDate = false;
	    },
	    save(){
			this.$emit('input', this.userSignIn);
			if(this.checkInputs())
				console.log("Aller dans welcome on board !! gérer ça quand connexion front/back");
			
		}
	},
	template: `
    <form class="form" @submit.prevent.stop="save">
		<div class="field">
			<label for="">Pseudo</label>
			<input maxlength="255" type="text" v-model="userSignIn.username" name='username' required>
			<div v-if="alreadyUsedUsername"><slot name="errorUsername"></slot></div>
			<div v-if="nullUsername"><slot name="nullInputUsername"></slot></div>
		</div>
		<div class="field">
			<label for="">Adresse e-mail</label>
			<input maxlength="255" type="email" v-model="userSignIn.mail" name='mail' required>
			<div v-if="alreadyUsedMail"><slot name="errorMail"></slot></div>
			<div v-if="nullMail"><slot name="nullInputMail"></slot></div>
			<div v-if="falseMail"><slot name="errorMailValid"></slot></div>
		</div>
		<div class="field" >
			<label for="">Mot de passe</label>
			<input maxlength="255" type="password" v-model="userSignIn.password" name='password' required>
			<div v-if="nullPassword"><slot name="nullInputPassword"></slot></div>
			<div v-if="lowPassword"><slot name="errorLowPassword"></slot></div>
		</div>
		<div class="field">
			<label for="">Mot de passe<br>(répeter)</label>
			<input maxlength="255" type="password" v-model="userSignIn.passwordChecked" required>
			<div v-if="falsePassword"><slot name="errorPassword"></slot></div>
			<div v-if="nullPasswordChecked"><slot name="nullInputPasswordChecked"></slot></div>
		</div>
		<div class="field">
			<label for="">Date de naissance</label>
			<select v-model.number="userSignIn.day" name="day" id="day" required>
		       <option v-for="option in userSignIn.dayTab">
		            {{ option }}
		        </option>
	       </select>
	       <select v-model.number="userSignIn.month" name="month" id="month" required>
		       <option v-for="option in userSignIn.monthTab">
		            {{ option }}
		        </option>
	       </select>
	       <select v-model.number="userSignIn.year" name="year" id="year" required>
		       <option v-for="option in userSignIn.yearTab">
		            {{ option }}
		        </option>
	       </select>
		<div v-if="falseDate"><slot name="errorDate"></slot></div>
		</div>
		<div class="field">
			<button>S'inscrire<img class="img-rocket" src="static/FuseeFirstPage.svg"> </button>
		</div>
    </form>
	  		
	`
}
export default {
	components: {formLogin, formUser },
	methods: {
	    inscription: function(){
	      this.signIn = true;
	    },
	    connexion: function(){
	      this.signIn = false;
	    }

	  }, 
	data () {
      return {
        userSignIn:{
        	username: '',
	        mail: '',
	        password: '',
	        passwordChecked: '',
	        day:1,
	        month:1,
	        year:1975,
	        dayTab : [ 1,28, 29, 30, 31],
	        monthTab : [ 1, 2, 3,4,5,6,7,8,9,10,11,12],
	        yearTab : [ 1975, 1996, 2000, 2016]
        },
        userLogin:{
        	mail:'',
        	password:''
        },
        usernameExisting:'JeanLuc',
        mailExisting:'JeanLuc@gmail.com',
        signIn:true,
        nullMessage:"Veuillez remplir ce champs svp!"
      }
    }
}
</script>

<!-- 

L'année de naissance doit être MAX à 2016 

-->



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
