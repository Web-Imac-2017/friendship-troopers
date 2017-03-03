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
      initialUser:JSON.parse(JSON.stringify(this.value)),
      lowPassword:false,
      falsePassword:false,
      falseMail:false,
      nullMail:true,
      nullPassword:true,
      nullPasswordChecked:true,
      imgDiv:false,
      user:{
        mail: '',
        password: '',
        passwordChecked:'',
        avatar : JSON.parse(JSON.stringify(this.value)).avatar,
        title: JSON.parse(JSON.stringify(this.value)).title,
      },
      finalUser:{
        mail: '',
        password: '',
        avatar : '',
        title: '',
      }
      
    }
  },
  methods:{
    goBack(){
      this.finalUser.mail = this.initialUser.mail;
      this.finalUser.password = this.initialUser.password;
      this.finalUser.avatar = this.initialUser.avatar;
      this.finalUser.title = this.initialUser.title;
      this.user.mail= '';
      this.user.password= '';
      this.user.passwordChecked='';
      this.user.avatar = this.initialUser.avatar;
      this.user.title= this.initialUser.title
      console.log("Revenu en arrière...");
    },
    finalUserToInitialUser(){
      this.initialUser.mail = this.finalUser.mail;
      this.initialUser.password = this.finalUser.password;
      this.initialUser.avatar = this.finalUser.avatar;
      this.initialUser.title = this.finalUser.title;
    },
    checkMail(){
      var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
      this.falseMail = (!regex.test(this.user.mail)) ? true : false;
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
    },
    save(){
      this.$emit('input', this.user);
      this.checkInputs();

      this.finalUser.password = (!(this.nullPasswordChecked) && !(this.lowPassword) && !(this.falsePassword)) ? this.user.password : this.initialUser.password;
      this.finalUser.mail = (!(this.nullMail) && !(this.falseMail)) ? this.user.mail : this.initialUser.mail;
      this.finalUser.title = this.user.title;
      this.finalUser.avatar = this.user.avatar;

      console.log("changements faits !!! Gerer ça quand liaison front/back done");
      
    }
  }
});


export default  formParameters;