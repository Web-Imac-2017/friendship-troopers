'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Comment = Vue.extend({
  props : {
    comment:Object,
    planet : String
  },
  template,
  created : function() {
    this.imagePath = "/assets/images/avatars/" + this.planet + "/" + this.comment.imagePath;
  },
  methods : {
    // Return a formated date, with hours (like "12 avr. 12h45")
    formateDate : function(date) {
      var object = new Date(date); 
      var months = ["janv.", "févr.", "mars", "avr.", "mai", "juin", "juill.", "août", "sept.", "oct.", "nov.", "déc."];
      return object.getDate() + " " + months[object.getMonth()] + " à " + object.getHours() + ":" + ('0'+object.getMinutes()).slice(-2);
    }
  },
  data () {
    return {
      newComment : '',
      imagePath :''
    }
  },

});


export default Comment;