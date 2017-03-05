'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const topParameters = Vue.extend({
  template,
  props: {
    value:Object,
  },
  data(){
    return{
      user:JSON.parse(JSON.stringify(this.value)),
      imgDiv:false
    }
  },
  methods:{
    showAvatars(){
      this.imgDiv = (!this.imgDiv) ? true : false;
    }

  }
});


export default  topParameters;