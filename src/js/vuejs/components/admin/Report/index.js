'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import AdminMenu from '../AdminMenu/index.js' 
import ReportBar from './ReportBar/index.js'
import PostComment from './PostCommentTemplate/index.js'

const AdminReport = Vue.extend({
  template,
  components: { 
  	'menu-admin' : AdminMenu,
  	'report-bar' : ReportBar ,
    'post-comment' : PostComment },
  data () {
      return { 
        number : '2',
        reportedPosts : [ {
        		type : 'Contenu indésirable',
            postType: true,
        		date :'25 fev',
        		hour : '15h20',
        		post:{
		          user: 'Lucky',
              avatar : "/assets/images/avatars/Paranose/astro.svg",
              planeteId : 2,
              date: '20 fev',
              hour: '12h04',
              content: 'Je suis un méchant post !',
              likes: 50,
      		  },
        		nbTimesReported : '3',
        		inscriptionDate : '3 fev. 2017'

          }, {
          		type : 'Insulte',
              postType: false,
          		date : '28 fev',
          		hour : '18h20',
          		post:{
  		          user : "Moi1Toi1Kozepog",
                 planeteId : 1,
                avatar : "/assets/images/avatars/Terre/astro.svg",
                content : "la vie c'est du kiri,Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque. BLJozeuoaugoeugo'",
                date: '20 fev',
                 hour: '12h04'
        		},
        		nbTimesReported : '20',
        		inscriptionDate : '13 fev. 2016'
        	}
        ]
      }
      
   }
});


export default AdminReport;