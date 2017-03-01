'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Post = Vue.extend({
  template,
  props:{
    post:Object
  },
  data () {
      return {
        post:{
          user: 'Lucky',
          avatar : "addresse de l'avatar",
          date: '20 fev',
          hour: '12h04',
          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
          likes: '50',
          comments: '2'
        }, 
        picture:false, 
        user : {
          userAvatar : '../assets/logo.png',
          username : 'LuckyPon', 
          userBadge : 'Baroudeuse de l\'espace', 
          userPlanet : {
            path : '../assets/Avatar1.svg',
            name : 'Planete X785-E'
          }, 
          lastFriends : [ {
            avatar : '../assets/Avatar1.svg',
            name : 'Spockdu77'
          }, {
            avatar : '../assets/Avatar1.svg',
            name : 'MartyDuPassé'
          }, {
            avatar : '../assets/Avatar1.svg',
            name : 'JulieDuFutur'
          }
          ]
        }
      }
    }
});


export default Post;