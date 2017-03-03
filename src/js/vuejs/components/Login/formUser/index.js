'use strict';

import Vue from 'vue/dist/vue';
 
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
	}
});


export default formUser;