'use strict';
import Vue from 'vue/dist/vue';
import welcomeData from './welcomeData.json';
import {apiRoot} from '../../../../../config.js';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const WelcomeOnBoard = Vue.extend({
  template,
  methods: {
  finished : function(){
    welcomeData.finish = true;
    for (var i = 0; i < welcomeData.questions.length; i++) {
      if (welcomeData.answerValidate[i] == false){
        welcomeData.finish = false;
      }
    }
  },
    decrement: function(){
      if (welcomeData.current > 0 )
        welcomeData.current --

  }, increment: function(){
      if (welcomeData.current < welcomeData.questions.length)
        welcomeData.current ++
      this.finished()
      if (this.reached < welcomeData.current)
        this.reached = welcomeData.current;
  },
    selected : function(index){
    welcomeData.answers[welcomeData.current] = welcomeData.questions[welcomeData.current].answer[index].planetID
    welcomeData.answerValidate[welcomeData.current] = true
    if (welcomeData.current < welcomeData.nbQuestions - 1) {
        welcomeData.current ++
    } 
    if (this.reached < welcomeData.current)
      this.reached = welcomeData.current;
    this.finished()
  },
  attributePlanet : function(){
    var planet = [0,0,0,0,0];
    for (var i = 0; i < welcomeData.answers.length; i++) {
        planet[welcomeData.answers[i]-1] += 1
    }
    var max = 0, index = 0;
    console.log("Planete :" + planet);
    for (i = 0; i < planet.length; i++) {
      if (planet[i] > max ){
        max = planet[i]
        index = i;
      }
    }
    welcomeData.current = welcomeData.nbQuestions;
    return index;
  },
  submit : function(){
    /*var data = [
    {"op":"replace","path":"/user_interest","value":{"0":"1","1":"9","2":"14","3":"16","4":"24","5":"29"}}
    ]
    console.log("data" + JSON.stringify(data));
        this.$http.patch(apiRoot() + 'interest/WelcomeOnBoard', data, {
          emulateHTTP: true,
          headers: { 
            'Content-Type': 'application/json'
          }
        }).then(
          (response) => {
            console.log("success !");
            console.log(response);
          },
          (response) => {
            console.log("fail !");
            console.log(response);
          }
        )*/
    welcomeData.planetUser = this.attributePlanet()
    this.styleObject.borderColor = welcomeData.planetInfo[welcomeData.planetUser].color
    this.styleObject2.borderLeftColor = welcomeData.planetInfo[welcomeData.planetUser].color
  },
  backToQuestion : function(index){
    welcomeData.current = index;
  },
  selectedItem : function(index){
        if (welcomeData.answerValidate[welcomeData.current] == true ){
          if (welcomeData.answers[welcomeData.current] == index){
            return {
              'answer-selected' : true
            }
          }  
        }
      },
    addClasses : function(index) {
      var classArray = [];
      var classSelected = this.selectedItem(index);
      if ((index - 1) == 0 ) {
        classArray.push('col-sm-offset-1');
      }
      classArray.push(classSelected);
      return classArray;
    }
}, computed: {
    
    color: function () {
      if (planerUser != "")
        return welcomeData.planetInfo[welcomeData.planetUser].color;
    }

    

    
  },
  data () {
      return {
        introText:true,
        validateButton:false,
        welcomeData,
        reached : 0,
        styleObject : {
          borderColor : 'white'
        }, 
        styleObject2 : {
          borderLeftColor : 'white'
        }
    }
  }
});

export default WelcomeOnBoard;