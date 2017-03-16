'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../../config.js';
 
let template = require('./template.html');
template     = eval(`\`${template}\``);

const formUser = Vue.extend({
 	template,
 	props: {
		value:Object,
	},
	data(){
		return{
			userSignIn: JSON.parse(JSON.stringify(this.value)),
			alreadyUsedUsername:false,
			alreadyUsedMail:false,
			falseMail:false,
			longUsername:false,
			lowPassword:false,
			falsePassword:false,
			falseDate:false,
			nullUsername:false,
			nullMail:false,
			nullPassword:false,
			nullPasswordChecked:false,
			errorDB:false
		}
	},
	methods:{
		// vérifie si le mail ressemble à une vraie adresse mail
		checkMail(){
			var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
			this.falseMail = (!regex.test(this.userSignIn.mail)) ? true : false;
		},
		// vérifie si le mot de passe est suffisamment compliqué et si les deux mots de passe rentrés sont les mêmes
		checkPassword(){
			var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-zA-Z]).*$/;
			
			this.falsePassword = (this.userSignIn.password != this.userSignIn.passwordChecked) ? true : false;
			if(!this.falsePassword)
				this.lowPassword = (!regex.test(this.userSignIn.password)) ? true : false;
		},
		// vérifie si le pseudo n'est pas trop long et n'est pas nul
		checkUsername(){
			var username = this.userSignIn.username;
			this.longUsername = (username.length > 15) ? true : false;
			this.nullUsername = (username == '') ? true : false;
		},
		// envoie à la bdd
		checkDB(){
			// vérifie si le mail n'existe pas déjà
			this.$http.post(apiRoot() + 'auth/signin/mail', 
		   	{
		   		'mail' : this.userSignIn.mail
		   	},{
		    	emulateJSON: true
		    }).then(
		      (response) => {
		      	if(response.data == true){
		      		this.alreadyUsedMail = false;
		      		// vérifie si le pseudo n'existe pas déjà
		          	this.$http.post(apiRoot() + 'auth/signin/username', 
			       	{
			       		'username' : this.userSignIn.username
			       	},{
			        	emulateJSON: true
			        }).then(
			          (response) => {
			          	if(response.data == true){
			          		this.alreadyUsedUsername = false;
			          		var birthdate = this.userSignIn.year + '-' + this.userSignIn.month + '-' + this.userSignIn.day;
			          		// envoie les paramètres pour l'inscription à la bdd
			          		this.$http.post(apiRoot() + 'auth/signin', 
					       	{
					       		'username' : this.userSignIn.username,
					       		'mail' : this.userSignIn.mail, 
					       		'birthdate' : birthdate, 
					       		'password': this.userSignIn.password 
					       	},{
					        	emulateJSON: true
					        }).then(
					          (response) => {
								this.falseDate = false;
								this.errorDB = false;
					            this.$router.push({
								    name: 'WelcomeOnBoard' 
								});
					          },
					          (response) => {
					            if(response.data.error == "USER_EXISTING"){
					            	this.alreadyUsedUsername = true;
									this.alreadyUsedMail = true;
					            }
					            else if(response.data.error == "INVALID_DATE"){
					            	this.falseDate = true;
					            }
					            else{
					            	this.errorDB = true;
					            }
					          }
					        )
			          	}else{
			          		this.alreadyUsedUsername = true;
			          	}
			          	
			          },
			          (response) => {}
			        )
		      	}else{
		      		this.alreadyUsedMail = true;
		      	}
		      },
		      (response) => {}
		     )
	
		},
		// vérifie si les champs sont remplis
		checkInputs(){
			
			this.nullMail = (this.userSignIn.mail == '') ? true : false;
			this.nullPassword = (this.userSignIn.password == '') ? true : false;
			this.nullPasswordChecked = (this.userSignIn.passwordChecked == '') ? true : false;

			
			this.checkUsername();
			this.checkPassword();
	      	this.checkDate();
	      	this.checkMail();

	      	return ((!this.nullUsername)&&(!this.nullMail)&&(!this.longUsername)&&(!this.lowPassword)&&(!this.nullPassword)
	      		&&(!this.nullPasswordChecked)&&(!this.falsePassword)&&(!this.falseDate)&&(!this.falseMail)) ? true : false;
		},
		// vérifie si l'année est bissextile
		isBissextile(value){
			return ((value % 4 == 0 && value%100 != 0) || value%400 == 0) ? true : false;
		},
		// vérifie si la date de naissance rentrée est valide
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
	    // fonction appelée au clic sur le bouton s'inscrire. Si les champs sont bien remplis, on envoie les infos au back
		save(){ 
			this.$emit('input', this.userSignIn);
			if(this.checkInputs()){
				this.checkDB();
			}

		    

    	}
	}
});


export default formUser;