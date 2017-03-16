'use strict';
import Vue from 'vue/dist/vue';
import {apiRoot} from '../../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``); 

const FriendsSubMenu = Vue.extend({
  template,
  props : {
    friend: Object
  }, 
  computed : {
    imagePath : function() { 
      return "/assets/images/avatars/" + this.friend.planet + "/" + this.friend.imagePath;
    }
  },
  methods: {
  	validateInvitation: function() {
      this.$http.patch(apiRoot() + "users/" + this.friend.friendId + "/confirm_friend", {emulateJSON: true}).then(
      (response) => {
        this.$emit('friendaction');
      },
      (response) => {
      });
  	},
  	refuseInvitation : function() {
      this.$http.delete(apiRoot() + "users/" + this.friend.friendId + "/delete_friend", {emulateJSON: true}).then(
      (response) => {
        this.$emit('friendaction');
      },
      (response) => {
      });
  	}
  }
});

export default FriendsSubMenu;