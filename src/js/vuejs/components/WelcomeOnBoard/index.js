'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

const WelcomeOnBoard = Vue.extend({
  template,
  methods: {
  finished : function(){
    this.finish = true;
    for (var i = 0; i < this.questions.length; i++) {
      if (this.answerValidate[i] == false){
        this.finish = false;
      }
    }
      console.log(this.answerValidate)
  },
    decrement: function(){
      if (this.current > 0 )
        this.current --

  }, increment: function(){
      if (this.current < this.questions.length)
        this.current ++
      this.finished()
  },
    selected : function(index){
    console.log(this.questions[this.current].answer[index].text)
    this.answers[this.current] = this.questions[this.current].answer[index].planetId
    this.answerValidate[this.current] = true
    if (this.current < this.nbQuestions - 1) {
        this.current ++
    } 
    this.finished()
  },
  attributePlanet : function(){
    var planet = [0,0,0,0,0,0];
    for (var i = 0; i < this.answers.length; i++) {
        planet[this.answers[i]-1] += 1
    }
    var max = 0, index = 0;
    for (i = 0; i < planet.length; i++) {
      if (planet[i] > max ){
        max = planet[i]
        index = i;
      }
    }
    this.current = this.nbQuestions;
    return index + 1;
  },
  submit : function(){
    this.planetUser = this.attributePlanet()
    console.log(planetUser);
  },
  backToQuestion : function(index){
    this.current = index;
  }
}, 
  data () {
      return {
        finish : false,
       questions: [ {
         number : "1",
         title : 'Ta couleur : ' ,
         answer : [ {text: 'bleu',image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/1_planete-bleue.jpg", planetId : '1'},
                    {text:'vert', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/1_planete-verte.jpg", planetId : '2'},
                    {text:'violet',image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/1_planete-violette.jpg", planetId : '3'},
                    {text:'rouge', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/1_planete-rouge.jpg", planetId : '4'},
                    {text:'orange', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/1_planete-orange.jpg", planetId : '5'}
         ]
        }, {
          number : "2",
          title : 'Ton compagnon :',
          answer : [ {text:'un petit vélociraptor', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/2_velociraptor.jpg", planetId : '1'},
                     {text:'un mini Groot', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/2_groot.png", planetId : '2'}, 
                     {text:'une charmante androïde', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/2_android.png", planetId : '3'}, 
                     {text:'Doc', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/2_Doc.jpg", planetId : '4'}, 
                     {text:'un Choubacca', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/2_choubacca.jpeg", planetId : '5'} 
         ] 
        }, {
          number : "3",
          title : 'Tes vacances parfaites :' ,
          answer : [ {text:'un week-end romantique à New New York', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/3_new-new-york.jpg", planetId : '1'},
                     {text:'tester les spécialités culinaires de Vulcain', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/3_vulcain.jpg", planetId : '2'},
                     {text:'relire tes classiques', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/3_lire-classiques.jpg", planetId : '3'}, 
                     {text:'arpenter un trou noir', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/3_trous-noirs.jpg", planetId : '4'},
                     {text:'faire la course de la Bounta', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/3_bounta.jpg", planetId : '5'}
         ] 
        },{
          number : "4",
          title : 'L\'intelligence artificielle pour gérer ta maison :' ,
          answer : [{text: 'la Matrice', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/4_matrice.jpg", planetId : '1'}, 
                    {text:'le Brain Bug', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/4_brainBug.jpg", planetId : '2'}, 
                    {text:'GladOS', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/4_Glados.jpg", planetId : '3'}, 
                    {text:'La Reine Rouge', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/4_red-queen.png", planetId : '4'}, 
                   {text:'AUTO', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/4_AUTO.jpg", planetId : '5'}
         ]},{
          number : "5",
          title : 'Ton moyen de transport de prédilection :' , 
          answer : [ {text:'le TARDIS', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/5_tardis.jpg", planetId : '1'},
                     {text:'la Porte des Etoiles', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/5_porte-des-etoiles.jpg", planetId : '2'},
                     {text:'l\'astro-stop', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/5_astro-stop.jpg", planetId : '3'},
                     {text:'la DeLorean', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/5_deLorean.jpg", planetId : '4'}, 
                     {text:'l\'Arcadia', image : "../../../friendship-troopers/www/assets/images/welcomeOnBoard/5_arcadia.jpg", planetId : '5'}
         ] 
        },{
          number : "6",
          title : 'Tu aimes :' ,
          answer : [{text: 'passer du temps dans ton bunker', image : "../../../friendship-troopers/www/assets/images/Avatar1.svg", planetId : '1'}, 
                    {text:'les rencontres du 3ième type', image : "../../../friendship-troopers/www/assets/images/Avatar1.svg", planetId : '2'}, 
                    {text:'trafiquer le droïde ménager de maman', image : "../../../friendship-troopers/www/assets/images/Avatar1.svg", planetId : '3'}, 
                    {text:'créer des paradoxes', image : "../../../friendship-troopers/www/assets/images/Avatar1.svg", planetId : '4'}, 
                   {text: 'aller en croisière muni de ton multipass', image : "../../../friendship-troopers/www/assets/images/Avatar1.svg", planetId : '5'}         ] 
        }
        ], 
        nbQuestions : 6,
        current : 0,
       
        answers : [],
        answerValidate : [false,false,false,false,false,false],
        planetUser : ""
      }
    }

});

export default WelcomeOnBoard;