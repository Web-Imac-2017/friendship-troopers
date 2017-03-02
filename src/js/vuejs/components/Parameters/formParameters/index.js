'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const formParameters = Vue.extend({
  template,
  props: {
    value:Object,
  },
  data(){
    return{
      user: JSON.parse(JSON.stringify(this.value)),
      lowPassword:false,
      falsePassword:false,
      nullMail:true,
      nullPassword:true,
      nullPasswordChecked:true
    }
  },
  methods:{
    checkPassword(){
      var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-zA-Z]).*$/;
      
      this.falsePassword = (this.user.password != this.user.passwordChecked) ? true : false;
      if(!this.falsePassword)
        this.lowPassword = (!regex.test(this.user.password)) ? true : false;
    },
    checkInputs(){
      this.nullMail = (this.user.mail == '') ? true : false;
      this.nullPassword = (this.user.password == '') ? true : false;
      this.nullPasswordChecked = (this.user.passwordChecked == '') ? true : false;

      this.checkPassword();
      console.log(""); 
      return ((!this.lowPassword)&&(!this.falsePassword)) ? true : false; 
    },
    save(){
      this.$emit('input', this.user);
      if(this.checkInputs())
        console.log("changements faits !!! Gerer ça quand liaison front/back done");
      
    }
  }
});


export default  formParameters;