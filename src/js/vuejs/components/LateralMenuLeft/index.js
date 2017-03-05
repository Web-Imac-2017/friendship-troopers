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
    },
    methods:{
      deconnect(){
        this.$http.post(apiRoot() + 'auth/logout', {
          emulateJSON: true
        }).then(
          (response) => {
            console.log("success deconnexion !");
            this.$router.push("/")
          },
          (response) => {
            console.log("fail deconnexion !")
          }
        )
       

      }
    }
});


export default LateralMenuLeft; 



