'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const WelcomeOnBoard = Vue.extend({
  template,
  methods: {
  finished : function(){
    if (this.current == this.nbQuestions - 1 )
      this.finish = true
    for (var i = 0; i < this.nbQuestions; i++) 
      if (this.answers[i] == '')
        this.finish = false
  },
    decrement: function(){
      if (this.current > 0 )
        this.current --

  }, increment: function(){
      if (this.current < this.nbQuestions - 1)
        this.current ++
      this.finished()

  },
    selected : function(index){
    console.log(this.questions[this.current].answer[index].text)
    console.log(index)
    this.answers[this.current] = this.questions[this.current].answer[index].planetId
    if (this.current < this.nbQuestions - 1)
        this.current ++
    this.finished()
  },
  attributePlanet : function(){
    for (var i = 0; i < this.answers.length; i++) {
      this.planet[this.answers[i] - 1] += 1
    }
    var max = 0, index = 0;
    for (i = 0; i < this.planet.length; i++) {
      if (this.planet[i] > max ){
        max = this.planet[i]
        index = i;
      }
    }
    console.log("planete Id : " + (index + 1))
    return index + 1;
  },
  submit : function(){
    this.attributePlanet()
  }
}, 
  data () {
      return {
       questions: [ {
         number : "1",
         title : 'Ta couleur : ' ,
         answer : [ {text: 'bleu',image : "../../../www/assets/images/Avatar1.svg", planetId : '1'},
                    {text:'vert', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'},
                    {text:'orange',image : "../../../www/assets/images/Avatar1.svg", planetId : '3'},
                    {text:'violet', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'},
                    {text:'noir', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'}
         ]
        }, {
          number : "2",
          title : 'Ton compagnon :',
          answer : [ {text:'un petit vélociraptor', image : "../../../www/assets/images/Avatar1.svg", planetId : '1'},
                     {text:'un mini Groot', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'}, 
                     {text:'une charmante androïde', image : "../../../www/assets/images/Avatar1.svg", planetId : '3'}, 
                     {text:'Doc', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'}, 
                     {text:'un Choubacca', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'} 
         ] 
        }, {
          number : "3",
          title : 'Tes vacances parfaites :' ,
          answer : [ {text:'un week-end romantique à New New York', image : "../../../www/assets/images/Avatar1.svg", planetId : '1'},
                     {text:'tester les spécialités culinaires de Vulcain', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'},
                     {text:'relire tes classiques', image : "../../../www/assets/images/Avatar1.svg", planetId : '3'}, 
                     {text:'arpenter un trou noir', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'},
                     {text:'faire la course de la Bounta', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'}
         ] 
        },{
          number : "4",
          title : 'L\'intelligence artificielle pour gérer ta maison :' ,
          answer : [{text: 'la Matrice', image : "../../../www/assets/images/Avatar1.svg", planetId : '1'}, 
                    {text:'le Brain Bug', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'}, 
                    {text:'GladOS', image : "../../../www/assets/images/Avatar1.svg", planetId : '3'}, 
                    {text:'AI du HIVE', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'}, 
                   {text:'Hall', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'}
         ]},{
          number : "5",
          title : 'Ton moyen de transport de prédilection :' , 
          answer : [ {text:'le TARDIS', image : "../../../www/assets/images/Avatar1.svg", planetId : '1'},
                     {text:'la Porte des Etoiles', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'},
                     {text:'l\'astro-stop', image : "../../../www/assets/images/Avatar1.svg", planetId : '3'},
                     {text:'la DeLorean', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'}, 
                    {text:'l\'Arcadia', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'}
         ] 
        },{
          number : "6",
          title : 'Tu aimes :' ,
          answer : [{text: 'passer du temps dans ton bunker', image : "../../../www/assets/images/Avatar1.svg", planetId : '1'}, 
                    {text:'les rencontres du 3ième type', image : "../../../www/assets/images/Avatar1.svg", planetId : '2'}, 
                    {text:'trafiquer le droïde ménager de maman', image : "../../../www/assets/images/Avatar1.svg", planetId : '3'}, 
                    {text:'créer des paradoxes', image : "../../../www/assets/images/Avatar1.svg", planetId : '4'}, 
                   {text: 'aller en croisière muni de ton multipass', image : "../../../www/assets/images/Avatar1.svg", planetId : '5'}         ] 
        }
        ], 
        nbQuestions : 6,
        current : 0,
        finish : false,
        answers : ['','','','','',''],
        planet : [0,0,0,0,0,0]
      }
    }

});

export default WelcomeOnBoard;