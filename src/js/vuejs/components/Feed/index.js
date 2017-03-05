'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import Post from '../Post/index.js'
import CreatePost from '../CreatePost/index.js'
import PageNav from './pageNav/index.js'


const Feed = Vue.extend({
  template,
  components: { 
  	'create-post' : CreatePost, 
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight, 
  	'menu-tools' : MenuTools, 
  	'post' : Post ,
    'page-nav' : PageNav
  },
 
  	data () {
      	return {
      		posts : [{
        	  user: 'Lucky',
	          avatar : "../assets/images/Avatar1.svg",
            planeteId : 2,
	          date: '20 fev',
	          hour: '12h04',
	          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
	          likes: 50,
	          comments: [
            {
              user : "Moi",
              content : "la vie c'est du kiri"
            }, {
              user : "Toi",
              content : "Non, la vie c'est du kiwi"
            }
            ],
            id : 1
	        },
          {
            user: 'Lucky',
            avatar : "../assets/images/Avatar1.svg",
            planeteId : 3,
            date: '20 fev',
            hour: '12h04',
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
            likes: 50,
            comments: [
            {
              user : "Moi",
              content : "la vie c'est du kiri"
            }, {
              user : "Toi",
              content : "Non, la vie c'est du kiwi"
            }
            ],
            id : 2
          },
          {
            user: 'Lucky',
            avatar : "../assets/images/Avatar1.svg",
            planeteId : 4,
            date: '20 fev',
            hour: '12h04',
            content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
            likes: 50,
            comments: [
            {
              user : "Moi",
              content : "la vie c'est du kiri"
            }, {
              user : "Toi",
              content : "Non, la vie c'est du kiwi"
            }
            ],
            id : 3
          }
          ]
        }
  	}

});


export default Feed;