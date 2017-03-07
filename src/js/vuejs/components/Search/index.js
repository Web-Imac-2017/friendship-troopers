'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);
import NavBar from '../NavBar/index.js';


const Search = Vue.extend({
  template, 
  components : {
  	'navbar' : NavBar 
  },
  created(){
    // TEST POUR VOIR SI ON EST LOGIN
    this.$http.post(apiRoot() + 'planets/1/posts', 
	   	{
	   		'content' : "contenttttttt", 
	   		'title': "titleeeeee" 
	   	},{
          emulateJSON: true
        }).then(
          (response) => {
            
            console.log("success !");
          },
          (response) => {
            console.log("fail !");
            console.log(response);
            if(response.status == 401){
            	console.log("connectez vous !!!");
            	this.$router.push("/");
            }
            	
          }
        )
  }
});


export default Search;