'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


const NavBar = Vue.extend({
  template,
    methods: {
    showMenuPesponsive: function(){
    }, 
    showSubMenu: function(idMenu){
      if (this.subMenu == idMenu) 
        this.subMenu = 0
      else {
        this.subMenu = idMenu
      }
    }, 
    showNotifications: function(){
      for (var i = 0; i < this.friends.length; i++) {
       // alert(this.friends[i].pseudo);
     }
    }, 
    showMessages: function(){
      if (this.subMenu == 2) 
        this.subMenu = 0
      else 
        this.subMenu = 2
    }, 
    showFriends: function(){
      if (this.subMenu == 1) 
        this.subMenu = 0
      else 
        this.subMenu = 1
    }
  }, 
   data () {
      return {
        friends: [ {pseudo: 'luckypon',date : '12/03/13'},
                    {pseudo: 'luckyLuke',date : '12/03/13'}
                 ],
        messages: [ {pseudo: 'luckypon',date : '12/03/13'},
                    {pseudo: 'tintin',date : '11/02/12'},
                    {pseudo: 'kirikoukou',date : '01/03/13'}
                 ], 
        notifications: [
                    {type:'like', post:'4', pseudo:'luckypon'},
                    {type:'comment', post:'2', pseudo: 'hihi'}     
        ], 
        subMenu : 0

        // notifs:[{
        //   friends : 1,
        //   messages : 16,
        //   notifications : 100
        // }], 
        // subMenu : 0 /*1:friends / 2: messages / 3: notif*/
      }
    }

    

}
});


export default NavBar;