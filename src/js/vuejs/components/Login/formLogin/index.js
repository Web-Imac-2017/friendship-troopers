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
	created(){
		// TEST POUR RECUPERER UN POST DE LA PLANETE 1
		/*this.$http.get(apiRoot() + 'planets/1/posts', 
		{
        	emulateJSON: true
        }).then(
          (response) => {
          	
            console.log("success");
            var postTab = response.data;
            console.log("Test content "+postTab[0].content);
          },
          (response) => {
            console.log("fail !"+response)
          }
        )*/


		// TEST POUR RECUPERER UN POST DE L UTILISATEUR COULON : NE MARCHE PAS ENCORE
		/*this.$http.get(apiRoot() + 'planets/1/posts',
       	{
       		'username' : 'coulon'
       	},{
        	emulateJSON: true
        }).then(
          (response) => {
          	
            console.log("success"+response.data);
            console.log(response.data);
            var postTab = response.data;
            console.log("Test content "+postTab[0].content);
          },
          (response) => {
            console.log("fail !")
            console.log(response)
          }
        )*/

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
		            this.$router.push("/actualites")
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
