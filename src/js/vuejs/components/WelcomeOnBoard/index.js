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
    this.answers[this.current] = this.questions[this.current].answer[index].text
    if (this.current < this.nbQuestions - 1)
        this.current ++
    this.finished()
  },
  submit : function(){
     this.http.post('', answers)
  }
}, 
  data () {
      return {
       questions: [ {
         number : "1",
         title : 'Ta couleur : ' ,
         answer : [ {text: 'bleu',image : "../logo.png"},
                    {text:'vert', image : "../assets/Avatar1.svg"},
                    {text:'orange',image : "../assets/Avatar1.svg"},
                    {text:'violet', image : "../assets/Avatar1.svg"},
                    {text:'noir', image : "../assets/Avatar1.svg"}
         ]
        }, {
          number : "2",
          title : 'Ton compagnon :',
          answer : [ {text:'un petit vélociraptor', image : "../assets/Avatar1.svg"},
                     {text:'un mini Groot', image : "../assets/Avatar1.svg"}, 
                     {text:'une charmante androïde', image : "../assets/Avatar1.svg"}, 
                     {text:'Doc', image : "../assets/Avatar1.svg"}, 
                     {text:'un Choubacca', image : "../assets/Avatar1.svg"} 
         ] 
        }, {
          number : "3",
          title : 'Tes vacances parfaites :' ,
          answer : [ {text:'un week-end romantique à New New York', image : "../assets/Avatar1.svg"},
                     {text:'tester les spécialités culinaires de Vulcain', image : "../assets/Avatar1.svg"},
                     {text:'relire tes classiques', image : "../assets/Avatar1.svg"}, 
                     {text:'arpenter un trou noir', image : "../assets/Avatar1.svg"},
                     {text:'faire la course de la Bounta', image : "../assets/Avatar1.svg"}
         ] 
        },{
          number : "4",
          title : 'L\'intelligence artificielle pour gérer ta maison :' ,
          answer : [{text: 'la Matrice', image : "../assets/Avatar1.svg"}, 
                    {text:'le Brain Bug', image : "../assets/Avatar1.svg"}, 
                    {text:'GladOS', image : "../assets/Avatar1.svg"}, 
                    {text:'AI du HIVE', image : "../assets/Avatar1.svg"}, 
                   {text:'Hall', image : "../assets/Avatar1.svg"}
         ]},{
          number : "5",
          title : 'Ton moyen de transport de prédilection :' , 
          answer : [ {text:'le TARDIS', image : "../assets/Avatar1.svg"},
                     {text:'la Porte des Etoiles', image : "../assets/Avatar1.svg"},
                     {text:'l\'astro-stop', image : "../assets/Avatar1.svg"},
                     {text:'la DeLorean', image : "../assets/Avatar1.svg"}, 
                    {text:'l\'Arcadia', image : "../assets/Avatar1.svg"}
         ] 
        },{
          number : "6",
          title : 'Tu aimes :' ,
          answer : [{text: 'passer du temps dans ton bunker', image : "../assets/Avatar1.svg"}, 
                    {text:'les rencontres du 3ième type', image : "../assets/Avatar1.svg"}, 
                    {text:'trafiquer le droïde ménager de maman', image : "../assets/Avatar1.svg"}, 
                    {text:'créer des paradoxes', image : "../assets/Avatar1.svg"}, 
                   {text: 'aller en croisière muni de ton multipass', image : "../assets/Avatar1.svg"}         ] 
        }
        ], 
        nbQuestions : 6,
        current : 0,
        finish : false,
        answers : ['','','','','','']
      }
    }

});

export default WelcomeOnBoard;