'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const formLogin = Vue.extend({
  template,
  props: {
		value:Object,
	},
	data(){
		return{
			userLogin: JSON.parse(JSON.stringify(this.value)),
			passwordNot:false,
			errorLogin:false
		}
	},
	methods:{
		connect(){
			this.$emit('input', this.userLogin);
			if(this.userLogin.mail != "admin@gmail.com" | this.userLogin.password != "admin"){
	      		if(this.userLogin.password == ""){
	      			this.passwordNot=true;
	      			this.errorLogin=false;
	      			console.log("connexion en cours !!! Gerer ça");
	      		}else{
	      			this.passwordNot=false;
		      		this.errorLogin=true;
	      		}	
	      	}else
	      		this.errorLogin=false;
		}
	}
});


export default formLogin;
