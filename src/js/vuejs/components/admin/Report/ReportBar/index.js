'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const ReportBar = Vue.extend({
  template,
  	methods: {
		ignore() {
			
		},
		deleteMessage() {

		},
		deleteUser() {

		}
	}
});


export default ReportBar;