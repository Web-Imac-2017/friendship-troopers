'use strict';
 
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import formLogin from './formLogin/index.js'
import formUser from './formUser/index.js'


const Login = Vue.extend({ 
  template,
  components: {
  	'form-login' : formLogin, 
  	'form-user' : formUser },
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
        	username: 'coulon',
	        mail: 'test@live.fr',
	        password: 'password123',
	        passwordChecked: 'password123',
	        day:'1',
	        month:'1',
	        year:'1993',
        },
        userLogin:{
        	mail:'',
        	password:''
        },
        signIn:true,
        nullMessage:"Veuillez remplir ce champs svp!"
      }
    }
});


export default Login;

