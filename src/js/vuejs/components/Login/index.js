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
        	username: '',
	        mail: '',
	        password: '',
	        passwordChecked: '',
	        day:1,
	        month:1,
	        year:1975,
	        dayTab : [ 1,28, 29, 30, 31],
	        monthTab : [ 1, 2, 3,4,5,6,7,8,9,10,11,12],
	        yearTab : [ 1975, 1996, 2000, 2016]
        },
        userLogin:{
        	mail:'',
        	password:''
        },
        usernameExisting:'JeanLuc',
        mailExisting:'JeanLuc@gmail.com',
        signIn:true,
        nullMessage:"Veuillez remplir ce champs svp!"
      }
    }
});


export default Login;

