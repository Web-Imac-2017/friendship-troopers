'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const MenuTools = Vue.extend({
    template,
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


export default MenuTools;