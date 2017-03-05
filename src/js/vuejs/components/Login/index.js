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
	        day:'',
	        month:'',
	        year:'',
	        dayTab : [ 1,28, 29, 30, 31],
	        monthTab : [ 1, 2, 3,4,5,6,7,8,9,10,11,12],
	        yearTab : [ 1975, 1996, 2000, 2016]
        },
        userLogin:{
        	mail:'',
        	password:''
        },
        loginTab : [{
          username:'Test1',
        	mail:'test1@gmail.com',
        	password:'123456789a'
        },{
          username:'Test2',
        	mail:'test2@gmail.com',
        	password:'password123'
        },{
          username:'Test3',
        	mail:'test3@gmail.com',
        	password:'password123'
        }],
        signIn:true,
        nullMessage:"Veuillez remplir ce champs svp!"
      }
    }
});


export default Login;

