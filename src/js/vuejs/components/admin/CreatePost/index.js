'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import AdminMenu from '../AdminMenu/index.js'
import CreatePost from '../../CreatePost/index.js'
import PostAdmin from './PostAdmin/index.js'

const AdminCreatePost = Vue.extend({
  template,
   components : {
  	'admin-menu' : AdminMenu,
  	'create-post' : CreatePost,
  	'post-admin' : PostAdmin
  },
  data () {
      	return {
      		posts : [{      /* earth / parallel / robots / aliens / space-opera*/

        	  user: 'Lucky',
            avatar : "../../friendship-troopers/www/assets/images/avatars/parallel/astro.svg",
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
            avatar : "../../friendship-troopers/www/assets/images/avatars/robots/landscape.svg",
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
            avatar : "../../friendship-troopers/www/assets/images/avatars/aliens/landscape.svg",
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


export default AdminCreatePost;