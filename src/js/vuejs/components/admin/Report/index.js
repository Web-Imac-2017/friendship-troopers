'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import AdminMenu from '../AdminMenu/index.js'
import ReportBar from './ReportBar/index.js'

const AdminReport = Vue.extend({
  template,
  components: { 
  	'menu-admin' : AdminMenu,
  	'report-bar' : ReportBar} ,
  data () {
      return { 
       reports : {
          number : '2',
          reportedPosts : [ {
          		type : 'Contenu indésirable',
          		date :'25 fev',
          		hour : '15h20',
          		post:{
		          user: 'Lucky',
		          avatar : "addresse de l'avatar",
		          date: '20 fev',
		          hour: '12h04',
		          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
		          likes: '50',
		          comments: '2'
        		},
        		nbTimesReported : '3',
        		inscriptionDate : '3 fev. 2017'

          	}, {
          		type : 'Insulte',
          		date : '28 fev',
          		hour : '18h20',
          		post:{
		          user: 'Le fifou du 13',
		          avatar : "addresse de l'avatar",
		          date: '20 fev',
		          hour: '12h04',
		          content: 'On en a rien a foutre de ce que tu nous dis mec!',
		          likes: '500',
		          comments: '12'
        		},
        		nbTimesReported : '20',
        		inscriptionDate : '13 fev. 2016'
        	}
          ]
       }
   }
      
   }
});


export default AdminReport;