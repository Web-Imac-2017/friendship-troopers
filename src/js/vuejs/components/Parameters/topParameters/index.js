'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const topParameters = Vue.extend({
  template,
  props: {
    user:Object,
    value:Object
  },
  computed : {
    imagePath : function() {
      return "/assets/images/avatars/" + this.user.name + "/" + this.user.imagePath;
    }
  },
  data(){
    return{
      titleTab : [ "Astronaute débutant", "Astronaute Intermédiaire","Super alien", "Cacahuete planétaire"],
      imgDiv:false
      /*user:JSON.parse(JSON.stringify(this.value)),
      */
    }
  },
  methods:{
    showAvatars(){
      this.imgDiv = (!this.imgDiv) ? true : false;
    }

  }
});

export default  topParameters;