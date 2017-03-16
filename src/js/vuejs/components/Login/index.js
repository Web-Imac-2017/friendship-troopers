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
    // ces deux fonctions permettent de switcher entre les onglets inscriptions et connexion
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
        	username: '',
	        mail: '',
	        password: '',
	        passwordChecked: '',
	        day:'',
	        month:'',
	        year:'',
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

