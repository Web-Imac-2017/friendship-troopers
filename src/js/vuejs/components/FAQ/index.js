'use strict';

import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);

import NavBar from '../NavBar/index.js';
 
const FAQ = Vue.extend({
  template,
  components : {
  	'navbar' : NavBar
  },
  data () {
    return {
      	questions : [
      	{   
       	 	question: "Je n'arrive pas à m'inscrire",
            answer : "Pour cela il suffit d'aller sur la page de connexion et de s'assurer que l'onglet \"Inscription\" est selectionné, puis remplir les champs du questionnaire. Un mail de confirmation vous est envoyé. Pour pouvoir accéder au site et à votre planète passez ensuite par le questionnaire de bienvenue, pour commencer votre exploration sur une planète qui vous corresponde.\nVoilà, vous êtes devenu explorateur !"},
        {     
       	 	question: "J'aimerais faire une énigme",
            answer : "C'est dommage, ce n'est pas encore possible...\n>Quand ça le sera vous pourrez alors vous torturer les méningues seul ou en groupe et en choissiant votre niveau !"},
        {     
       	 	question: "Pourquoi je n'ai pas le choix de la couleur de mon avatar",
            answer : "Un avatar dépend d'une planète, cette couleur marque votre identité. Il n'est pas possible de changer de planète, il n'est donc pas non plus possible de changer la couleur de son avatar."},
        {     
       	 	question: "Je souhaiterais changer d'avatar",
            answer : "Allez les modifier dans votre gestion de compte. Vous pouvez en acheter sur le marché galactique avec les points obtenus grâce aux énigmes."}
        ]
  	}
  }       
         
});


export default FAQ;