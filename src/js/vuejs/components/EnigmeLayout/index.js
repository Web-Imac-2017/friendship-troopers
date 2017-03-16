'use strict';

import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const EnigmeLayout = Vue.extend({
  template,
  props : {
    chat: Boolean,
  },
  created : function(){
  	this.username = this.$route.params.user;
  },
   mounted: function() {
      if (this.chat){
  			this.$http.get(apiRoot() + 'users/me').then((response) => {
       		 	this.me = response.data;
       		 	this.riddle.players.unshift(this.me)
      		}, (response) => {
        		console.log(response);
      		})
      	} 
  }, methods : {
    sendAnswer : function(){
      console.log("here" + this.answer)
      if ((this.answer == "menteur") || (this.answer == "Menteur")){
        this.$router.push( {name: 'EnigmeResolved',
            params: { user: this.username }})
         this.answer = ''
      } else {
        this.answer = ''
        this.wrongAnswer = true
      }
     
    }
  },
  data () {
  	return {
      wrongAnswer : false,
  		username :'',
  		riddle : {
  			content : 'Je plonge d\'une falaise de 10 mètre de haut. <br\> Je nage sous l\'eau pendant plus d\'une heure. <br\> Je chasse le requin avec les dents. <br\> Chaque matin je traverse la Méditarranée à la brasse ...',
  			players : [{
  				username : 'Connor',
          userId : 4,
  				imagePath : '/assets/images/avatars/aliens/aliens.svg',
  				planetId : 4
  			}
  			],
  			points : 125
  		},
  		planetData: ["#3e3e3e", "#3eb6df", "#ef4646", "#767fe2", "#72b51a", "#f9a519" ],
  		answer : '',
      me:{}
  	}
  }
});


export default EnigmeLayout;