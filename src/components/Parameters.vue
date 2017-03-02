<template>
  <div class="container-fluid">
    <div class="row">
      <aside class="col-sm-2">
        <lateralMenuLeft></lateralMenuLeft>
        <MenuTools></MenuTools>
      </aside>
      <section class="article col-sm-8">
        <h1> Modifier mes informations </h1>
        <form-parameters v-model="user">
          <p slot="errorPassword">Les deux mots de passe ne correspondent pas !</p>
          <p slot="errorLowPassword">Le mot de passe n'est pas suffisament compliqué! Il doit comporter 1 chiffre, 1 lettre et au minimum 8 caractères.</p>

        </form-parameters>
        <pre>{{user}}</pre>

      </section>
      <div class="col-sm-2">
         <lateralMenuRight></lateralMenuRight>
      </div>


    </div>
  </div>
  
</template>



<script>
import LateralMenuLeft from './LateralMenuLeft'
import LateralMenuRight from './LateralMenuRight'
import MenuTools from './MenuTools'

let formParameters = {
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
  },
  template: `
    <form class="form post container-colored"  @submit.prevent.stop="save">
    <div class="row">
      <div class="col-sm-6">
        <p>Modifier votre avatar</p>
        <img src="http://placehold.it/150x150">
        <a href="">Choisir un nouvel avatar</a> 
      </div>
      <div class="col-sm-6">
        <p>Modifier votre titre</p>
        <select v-model="user.title">
          <option v-for="option in user.titleTab">
            {{ option }}
          </option>
        </select>
      </div>
    </div>
    <p>Modifier votre adresse mail</p>
    <div class="row">
      <div class="col-sm-2">
        <label for="">Adresse mail</label>
      </div>
      <div class="col-sm-10">
        <input maxlength="255" type="email" v-model="user.mail" name='mail'>
      </div>
    </div>
    <p>Modifier votre mot de passe</p>
    <div class="row">
      <div class="col-sm-2">
        <label for="">Nouveau</label>
      </div>
      <div class="col-sm-10">
        <input maxlength="255" type="password" v-model="user.password" name='password'>
        <div v-if="lowPassword"><slot name="errorLowPassword"></slot></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2">
        <label for="">Répéter nouveau</label>
      </div>
      <div class="col-sm-10">
        <input maxlength="255" type="password" v-model="user.passwordChecked">
        <div v-if="falsePassword"><slot name="errorPassword"></slot></div>
      </div>
    </div>
    <div class="row">
       <button>Annuler</button>
      <button>Enregistrer</button>
    </div>
  </form>     
  `
    
}

export default {
  components: { LateralMenuLeft, LateralMenuRight, MenuTools, formParameters }, 
  data () {
      return {
        user:{
          mail: '',
          password: '',
          passwordChecked: '',
          title:'title1',
          titleTab : [ "title1","title2"],
        }
      }
    }
}
</script>

