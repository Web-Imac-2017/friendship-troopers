'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import LateralMenuLeft from '../LateralMenuLeft/index.js'
import MenuTools from '../MenuTools/index.js'
import FriendTemplate from '../FriendTemplate/index.js'


const Friends = Vue.extend({
  template,
  components: {
    'FriendTemplate' : FriendTemplate, 
    'lateral-menu-left' : LateralMenuLeft, 
    'menu-tools' : MenuTools }, 
  data () {
      return {
       user: {
        nbFriends : 7,
        planetSelected : 'Eat-712', 
        friends : 
          [ { 
              path  : '../../../www/assets/images/Avatar1.svg',
              name : 'ILoveUfo',
              badge : 'Baroudeuse de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'JeanLuc',
              badge : 'Baroudeur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'
            },{ 
              path : '../../../www/assets/images/Avatar1.svg',
              name : 'LoverDu77',
              badge : 'Séducteur de l\'espace',
              birthDate : '29 avril'}
          ]
       } 
    }

  }
});


export default Friends;