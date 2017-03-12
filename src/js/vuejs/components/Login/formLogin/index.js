'use strict';
 
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../../config.js';

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
		       	this.$http.post(apiRoot() + 'auth/login', 
		       	{
		       		'mail' : this.userLogin.mail, 
		       		'password': this.userLogin.password 
		       	},{
		        	emulateJSON: true
		        }).then(
		          (response) => {
		            console.log("success !");
		            this.cantSubmit=false;
		            this.$router.push({
					    name: 'Feed' 
					});
		          },
		          (response) => {
		            console.log("fail !")
		            this.cantSubmit=true;
		          }
		        )
		    }

    	}
	      		
		
	}
});


export default formLogin;
