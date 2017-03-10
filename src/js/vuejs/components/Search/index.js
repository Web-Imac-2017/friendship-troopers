'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import NavBar from '../NavBar/index.js';
import PageNav from '../Feed/pageNav/index.js'


const Search = Vue.extend({
  template, 
  components: {
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools,
    'navbar' : NavBar,
    'page-nav' : PageNav
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
            	this.$router.push({
                name: 'Login' 
            });
            }
            	
          }
        )
  }
});


export default Search;