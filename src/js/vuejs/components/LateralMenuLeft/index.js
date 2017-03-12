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
          userAvatar : '/assets/images/avatars/Terre/miror.svg',
          username : 'LuckyPon', 
          userHonor : 'Baroudeuse de l\'espace', 
          planet : 'Terre',
          avatar : 'aliens',
          planetId: 3,
          userPlanet : {
            path : '/assets/images/planets/Terre.svg',
            name : 'Terre'
          }, 
          lastFriends : [ 
          {
            avatar : '/assets/images/avatars/Sautien/aliens.svg',
            name : 'Spockdu77'
          }, {
            avatar : '/assets/images/avatars/Terre/planets.svg',
            name : 'MartyDuPassé'
          }, {
            avatar : '/assets/images/avatars/Terre/miror.svg',
            name : 'JulieDuFutur'
          }
          ] 
        }
      }
    }
});


export default LateralMenuLeft; 



