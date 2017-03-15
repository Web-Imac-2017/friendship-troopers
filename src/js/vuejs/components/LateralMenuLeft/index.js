'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const LateralMenuLeft = Vue.extend({
    template,
    created: function() {
      this.$http.get(apiRoot() + "users/me", {emulateJSON: true}).then(
        (response) => {
          this.user = response.data;
          this.$emit("userinfos");
        }, (response) => {
          this.$router.push({name : "Login"});
        });
    },
    data () {
      return {
        user : {},
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



