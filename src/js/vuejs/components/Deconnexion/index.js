'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const Deconnexion = Vue.extend({
    template,
    methods:{
      deconnect(){
        this.$http.post(apiRoot() + 'auth/logout', {
          emulateJSON: true
        }).then(
          (response) => {
            this.$router.push({ name: 'Login'});
          },
          (response) => {}
        )
       

      }
    }
});


export default Deconnexion;