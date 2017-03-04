'use strict';
import Vue from 'vue/dist/vue';
import welcomeData from './welcomeData.json';

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
  },
    selected : function(index){
    welcomeData.answers[welcomeData.current] = welcomeData.questions[welcomeData.current].answer[index].planetID
    welcomeData.answerValidate[welcomeData.current] = true
    if (welcomeData.current < welcomeData.nbQuestions - 1) {
        welcomeData.current ++
    } 
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
    welcomeData.planetUser = this.attributePlanet()
    this.styleObject.borderColor = welcomeData.planetInfo[welcomeData.planetUser].color;
    
  },
  backToQuestion : function(index){
    welcomeData.current = index;
  }
}, computed: {
    
    color: function () {
      if (planerUser != "")
        return welcomeData.planetInfo[welcomeData.planetUser].color;
      } 
  },
  data () {
      return {
        welcomeData,
        styleObject : {
          borderColor : ''
        }
    }
  }
});

export default WelcomeOnBoard;