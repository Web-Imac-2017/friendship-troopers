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
	}
});


export default formLogin;
