'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const bottomParameters = Vue.extend({
  template,
  props: {
    value:Object,
  },
  data(){
    return{
      initialPassword:JSON.parse(JSON.stringify(this.value)).password,
      initialMail:JSON.parse(JSON.stringify(this.value)).mail,
      lowPassword:false,
      falsePassword:false,
      falseMail:false,
      nullMail:true,
      nullPassword:true,
      nullPasswordChecked:true,
      wrongPassword:false,
      validate:false,
      noChange:false,
      user:{
        mail: JSON.parse(JSON.stringify(this.value)).mail,
        password: '',
        newPassword:'',
        passwordChecked:'',
        avatar : JSON.parse(JSON.stringify(this.value)).avatar,
        title: JSON.parse(JSON.stringify(this.value)).title,
      },
      finalUser:{
        mail: JSON.parse(JSON.stringify(this.value)).mail,
        password: JSON.parse(JSON.stringify(this.value)).password,
        avatar : JSON.parse(JSON.stringify(this.value)).avatar,
        title: JSON.parse(JSON.stringify(this.value)).title,
      }
      
    }
  },
  methods:{
    checkMail(){
      var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
      this.falseMail = (!regex.test(this.user.mail)) ? true : false;
    },
    checkPassword(){
      var regex = /^.*(?=.{8,})(?=.*\d)(?=.*[a-zA-Z]).*$/;
      
      this.falsePassword = (this.user.newPassword != this.user.passwordChecked) ? true : false;
      if(!this.falsePassword)
        this.lowPassword = (!regex.test(this.user.newPassword)) ? true : false;
    },
    checkInputs(){
      this.nullMail = (this.user.mail == '') ? true : false;
      this.nullPassword = (this.user.newPassword == '') ? true : false;
      this.nullPasswordChecked = (this.user.passwordChecked == '') ? true : false;

      if(!(this.nullPassword)){
        this.checkPassword();
      }
      if(!(this.nullMail)){
        this.checkMail();
      }
        
    },
    toggleValidate(){
      this.validate = (!this.validate) ? true : false;
      this.wrongPassword = false;
      this.user.password="";
    },
    save(){
      this.$emit('input', this.user);
      this.checkInputs();
      if((!(this.nullPassword) && !(this.nullPasswordChecked) && !(this.lowPassword) && !(this.falsePassword)) 
        || (!(this.nullMail) && !(this.falseMail) && (this.initialMail != this.user.mail))){
        this.toggleValidate();
        this.noChange = false;
      }else{
        this.noChange = true;
      }
        
      
    },
    saveFinal(){
      if(this.user.password == this.initialPassword){
        this.wrongPassword = false;
        this.finalUser.password = (!(this.nullPasswordChecked) && !(this.lowPassword) && !(this.falsePassword)) ? this.user.newPassword : this.initialPassword;
        this.finalUser.mail = (!(this.nullMail) && !(this.falseMail)) ? this.user.mail : this.initialMail;

        console.log("changements faits !!! Gerer ça quand liaison front/back done : mail "+this.finalUser.mail+" mdp "+this.finalUser.password);

        this.$router.push("/utilisateur")

      }else{
        this.wrongPassword = true

      }

      
      
    }
  }
});


export default  bottomParameters;