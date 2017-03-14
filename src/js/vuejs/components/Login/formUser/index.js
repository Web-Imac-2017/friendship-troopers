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
		checkUsername(){
			var username = this.userSignIn.username;
			this.longUsername = (username.length > 20) ? true : false;
			this.nullUsername = (username == '') ? true : false;
			
		},
		checkDB(){
			console.log(this.userSignIn.mail);
			/*this.$http.post(apiRoot() + 'auth/signin/mail', 
		       	{
		       		'mail' : this.userSignIn.mail
		       	},{
		        	emulateJSON: true
		        }).then(
		          (response) => {
		          	this.alreadyUsedMail = false;
		          	this.$http.post(apiRoot() + 'auth/signin/username', 
			       	{
			       		'username' : this.userSignIn.username
			       	},{
			        	emulateJSON: true
			        }).then(
			          (response) => {
			          	this.alreadyUsedUsername = false;
			          	console.log(response.data);
			          	var birthdate = this.userSignIn.year + '-' + this.userSignIn.month + '-' + this.userSignIn.day;

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
				          	this.alreadyUsedUsername = false;
							this.alreadyUsedMail = false;
							this.falseDate = false;
							this.errorDB = false;
				          	console.log("inscription faite !");
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
			          },
			          (response) => {
			            this.alreadyUsedUsername = true;
			            console.log("pas ok username");
			          }
			        )
		          },
		          (response) => {
		            this.alreadyUsedMail = true;
		            console.log("pas ok mail");
		          }
		        )*/
				
	          	this.$http.post(apiRoot() + 'auth/signin/username', 
		       	{
		       		'username' : this.userSignIn.username
		       	},{
		        	emulateJSON: true
		        }).then(
		          (response) => {
		          	this.alreadyUsedUsername = false;
		          	console.log(response.data);
		          	var birthdate = this.userSignIn.year + '-' + this.userSignIn.month + '-' + this.userSignIn.day;

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
			          	this.alreadyUsedUsername = false;
						this.alreadyUsedMail = false;
						this.falseDate = false;
						this.errorDB = false;
			          	console.log("inscription faite !");
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
		          },
		          (response) => {
		            this.alreadyUsedUsername = true;
		            console.log("pas ok username");
		          }
		        )

			
		},
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
			if(this.checkInputs()){
				this.checkDB();
			}

		    

    	}
	}
});


export default formUser;