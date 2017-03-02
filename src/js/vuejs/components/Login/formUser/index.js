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
			falsePassword:false,
			falseDate:false,
			nullUsername:false,
			nullMail:false,
			nullPassword:false,
			nullPasswordChecked:false
		}
	},
	methods:{
		checkInputs(){
			if(this.userSignIn.username == ''){
	      		this.nullUsername=true;
	      	}else
	      		this.nullUsername=false;
	      	if(this.userSignIn.mail == ''){
	      		this.nullMail=true;
	      	}else
	      		this.nullMail=false;
	      	if(this.userSignIn.password == ''){
	      		this.nullPassword=true;
	      	}else
	      		this.nullPassword=false;
	      	if(this.userSignIn.passwordChecked == ''){
	      		this.nullPasswordChecked=true;
	      	}else
	      		this.nullPasswordChecked=false;

        	if(this.userSignIn.username == this.$parent.usernameExisting){
	      		this.alreadyUsedUsername=true;
	      	}else
	      		this.alreadyUsedUsername=false;
	      	if(this.userSignIn.mail == this.$parent.mailExisting){
	      		this.alreadyUsedMail=true;
	      	}else
	      		this.alreadyUsedMail=false;
	      	if(this.userSignIn.password != this.userSignIn.passwordChecked){
	      		this.falsePassword=true;
	      	}else
	      		this.falsePassword=false;
	      	this.checkDate();
		},
		save(){
			this.$emit('input', this.userSignIn);
			this.checkInputs();
			console.log("Aller dans welcome on board !! gérer ça");
			
		},
		isBissextile(value){
			if((value % 4 == 0 && value%100 != 0) || value%400 == 0) 
				return true;
			else
				return false;
		},
		checkDate(){
	    	if((this.userSignIn.day == 30 || this.userSignIn.day == 31) && this.userSignIn.month == 2)
	    		this.falseDate = true;
	    	else if(this.userSignIn.day == 29 && this.userSignIn.month == 2){
	    		if(this.isBissextile(this.userSignIn.year)){
	    			console.log("ok");
					this.falseDate = false;
	    		}else
	    			this.falseDate = true;
	    	}
	    	else if(this.userSignIn.day == 31 && (this.userSignIn.month == 4 | this.userSignIn.month == 6 | this.userSignIn.month == 9 | this.userSignIn.month == 11 ))
	    		this.falseDate = true;
	    	else
	    		this.falseDate = false;
	    }
	},
});


export default formUser;