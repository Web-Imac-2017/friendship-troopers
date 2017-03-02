'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const LateralMenuLeft = Vue.extend({
  template,
   data () {
      return {
        user : {
          userAvatar : '../../../www/assets/images/Avatar1.svg',
          username : 'LuckyPon', 
          userBadge : 'Baroudeuse de l\'espace', 
          userPlanet : {
            path : '../../../www/assets/images/Avatar1.svg',
            name : 'Planete X785-E'
          }, 
          lastFriends : [ {
            avatar : '../../../www/assets/images/Avatar1.svg',
            name : 'Spockdu77'
          }, {
            avatar : '../../../www/assets/images/Avatar1.svg',
            name : 'MartyDuPassé'
          }, {
            avatar : '../../../www/assets/images/Avatar1.svg',
            name : 'JulieDuFutur'
          }
          ]
        }
      }
    }
});


export default LateralMenuLeft; 



