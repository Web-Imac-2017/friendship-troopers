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
      falseMail:false,
      nullMail:true,
      nullPassword:true,
      nullPasswordChecked:true,
      imgDiv:false
    }
  },
  methods:{
    checkMail(){
      var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
      this.falseMail = (!regex.test(this.userSignIn.mail)) ? true : false;
    },
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

      if(!(this.nullPassword)){
        this.checkPassword();
      }
      if(!(this.nullMail)){
        this.checkMail();
      }
      
        
    },
    showAvatars(){
      this.imgDiv = (!this.imgDiv) ? true : false;
      console.log("show avatars");
    },
    changeAvatar : function (event) {
/*      this.user.imagePath = this.attr('src');
      console.log("avatar " + this.attr('src'));*/
    },
    save(){
      this.$emit('input', this.user);
      this.checkInputs();
      if(!(this.nullPasswordChecked) && !(this.lowPassword) && !(this.falsePassword))
          console.log("Changement de mot de passe possible !!");
      if(!(this.nullMail) && !(this.falseMail))
          console.log("Changement de mail possible !!");
      console.log("changements faits !!! Gerer ça quand liaison front/back done");
      
    }
  }
});


export default  formParameters;