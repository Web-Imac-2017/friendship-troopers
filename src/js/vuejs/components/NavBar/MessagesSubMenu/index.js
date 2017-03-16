'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``); 


const MessagesSubMenu = Vue.extend({
	template,
	props : {
		message: Object
	},
	computed : {
		imagePath : function() { 
			return "/assets/images/avatars/" + this.message.planet + "/" + this.message.avatar;
    	}
	}
});

export default MessagesSubMenu;