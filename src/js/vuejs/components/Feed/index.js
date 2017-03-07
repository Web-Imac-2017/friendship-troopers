'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js'

let template = require('./template.html');
template     = eval(`\`${template}\``);


import LateralMenuLeft from '../LateralMenuLeft/index.js'
import LateralMenuRight from '../LateralMenuRight/index.js'
import MenuTools from '../MenuTools/index.js'
import Post from '../Post/index.js'
import CreatePost from '../CreatePost/index.js'
import PageNav from './pageNav/index.js'
import NavBar from '../NavBar/index.js';

const Feed = Vue.extend({
  template,
  components: { 
  	'create-post' : CreatePost, 
  	'lateral-menu-left' : LateralMenuLeft,
  	'lateral-menu-right' : LateralMenuRight, 
  	'menu-tools' : MenuTools, 
  	'post' : Post ,
    'page-nav' : PageNav,
    'navbar' : NavBar
  },
  created(){
    // TEST POUR RECUPERER UN POST DE LA PLANETE 1
    this.$http.get(apiRoot() + 'planets/1/posts', 
        {
          emulateJSON: true
        }).then(
          (response) => {
            
            console.log("success !");
            console.log(response);
            var postTab = response.data;
            console.log("Test content "+postTab[0].content);
          },
          (response) => {
            console.log("fail !");
            console.log(response);
          }
        )


    // TEST POUR RECUPERER UN POST DE L UTILISATEUR COULON : NE MARCHE PAS ENCORE
    /*this.$http.get(apiRoot() + 'planets/1/posts',
        {
          'username' : 'coulon'
        },{
          emulateJSON: true
        }).then(
          (response) => {
            
            console.log("success"+response.data);
            console.log(response.data);
            var postTab = response.data;
            console.log("Test content "+postTab[0].content);
          },
          (response) => {
            console.log("fail !")
            console.log(response)
          }
        )*/

    },
 
  	data () {
      	return {
      		posts : [{      /* earth / parallel / robots / aliens / space-opera*/

        	  user: 'Lucky',
            avatar : "/assets/images/avatars/parallel/astro.svg",
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
            avatar : "/assets/images/avatars/robots/landscape.svg",
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
            avatar : "/assets/images/avatars/aliens/dashboard.svg",
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