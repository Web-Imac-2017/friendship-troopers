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
          id: 1,
          planetId: 1,
          name: "Terre",
          description: null,
          points: null,
          username: "coulon",
          imagePath: "/assets/images/avatars/earth/aliens.svg",
          altText: "avatar",
          honorificTitle: "Astronaute Intermédiaire",
          firstname: null,
          lastname: null,
          birthdate: "2013-02-05"
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
});


export default LateralMenuLeft; 



