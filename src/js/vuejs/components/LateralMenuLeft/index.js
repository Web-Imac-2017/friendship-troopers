'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const LateralMenuLeft = Vue.extend({
    template,
    data () {
      return {
        user : {
          userAvatar : '/assets/images/Avatar1.svg',
          username : 'LuckyPon', 
          userHonor : 'Baroudeuse de l\'espace', 
          userPlanet : {
            path : '/assets/images/planets/P1.svg',
            name : 'space-opera'
          }, 
          lastFriends : [ 
          {
            avatar : '/assets/images/avatars/aliens/aliens.svg',
            name : 'Spockdu77'
          }, {
            avatar : '/assets/images/avatars/earth/planets.svg',
            name : 'MartyDuPassé'
          }, {
            avatar : '/assets/images/avatars/earth/miror.svg',
            name : 'JulieDuFutur'
          }
          ] 
        }
      }
    }
});


export default LateralMenuLeft; 



