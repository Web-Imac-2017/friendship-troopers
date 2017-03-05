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
		checkLogin(index){
			return ((this.userLogin.mail == this.$parent.loginTab[index].mail) && (this.userLogin.password == this.$parent.loginTab[index].password)) ? true : false;
		},
		connect(){
			this.$emit('input', this.userLogin);
			if(this.userLogin.mail != "" | this.userLogin.password != ""){
				var i = 0;
				for(var i; i < this.$parent.loginTab.length; i++){
					if(this.checkLogin(i)){
						this.cantSubmit=false;
						console.log("connexion faite !");
						this.$router.push("/actualites")
					}
				}
				this.cantSubmit=true;
			}else{
				this.cantSubmit=true;
			}
			
	      		
		}
	}
});


export default formLogin;
