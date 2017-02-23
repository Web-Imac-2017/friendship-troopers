<template>
   <div class="container-fluid welcome-on-board">
    <div class="row title">
      <div> {{ questions[current].number }}.</div>  
      <div> {{ questions[current].title }} </div>
    </div>
    <div class="row">
      <ul class="wrapper">
        <li class="item" @click="selected(0)">
          <div class="square"> <img :src="questions[current].answer[0].image"> </div> 
          <div class="text-center">{{ questions[current].answer[0].text }} </div>
        </li>
        <li class="item" @click="selected(1)">
          <div class="square"> <img :src="questions[current].answer[1].image"> </div> 
          <div class="text-center">{{ questions[current].answer[1].text }} </div> 
        </li>
        <li class="item" @click="selected(2)">
           <div class="square"><img :src="questions[current].answer[2].image">  </div> 
           <div class="text-center">{{ questions[current].answer[2].text }}</div> 
         </li>
        <li class="item" @click="selected(3)">
           <div class="square"> <img :src="questions[current].answer[3].image"> </div> 
           <div class="text-center">{{ questions[current].answer[3].text }}</div>  
         </li>
        <li class="item" @click="selected(4)">
          <div class="square"> <img :src="questions[current].answer[4].image"> </div> 
          <div class="text-center">{{ questions[current].answer[4].text }}</div> 
        </li>
      </ul>
    </div>
    <div class="row slider">
      <input type="range" v-model.number="current" min="0" max="5" step="1"> </input>
    </div>
    <div class="row"> 
              <button v-on:click="increment"> Next {{current}}</button>
      <p>
          {{current}}
      </p>
    </div>
  
</div>
</template>


<script>

export default {
   methods: {
    increment: function(){
      if (this.current < this.nbQuestions - 1)
        this.current ++

  }, 
    selected : function(index){
    console.log(this.questions[this.current].answer[index].text)
    console.log(index)
    if (this.current < this.nbQuestions - 1)
        this.current ++
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
                     {text: 'un Choubacca', image : "../assets/Avatar1.svg"} 
         ] 
        }, {
          number : "3",
          title : 'Tes vacances parfaites:' ,
          answer : [ {text:'un week-end romantique à New New York', image : "../assets/Avatar1.svg"},
                     {text:'tester les spécialités culinaires de Vulcain', image : "../assets/Avatar1.svg"},
                     {text:'relire tes classiques', image : "../assets/Avatar1.svg"}, 
                     {text:'arpenter un trou nor', image : "../assets/Avatar1.svg"},
                     {text:'faire la course de la Bounta', image : "../assets/Avatar1.svg"}
         ] 
        },{
          number : "4",
          title : 'L\'intellingence artificielle pour gérer ta maison :' ,
          answer : [{text: 'la Matrice', image : "../assets/Avatar1.svg"}, 
                    {text:'le Brain Bug', image : "../assets/Avatar1.svg"}, 
                    {text:'GladOS', image : "../assets/Avatar1.svg"}, 
                    {text:'AI du HIVE', image : "../assets/Avatar1.svg"}, 
                   {text: 'Hall', image : "../assets/Avatar1.svg"}
         ]},{
          number : "5",
          title : 'Ton moyen de transport de prédilection:' , 
          answer : [ {text:'le TARDIS', image : "../assets/Avatar1.svg"},
                     {text:'la Porte des Etoiles', image : "../assets/Avatar1.svg"},
                     {text:'en astro-stop', image : "../assets/Avatar1.svg"},
                     {text:'en DeLorean', image : "../assets/Avatar1.svg"}, 
                    {text: 'à bord de l\'Arcadia', image : "../assets/Avatar1.svg"}
         ] 
        },{
          number : "6",
          title : 'Tu aimes :' ,
          answer : [{text: 'passer du temps dans ton bunker', image : "../assets/Avatar1.svg"}, 
                    {text:'les rencontres du 3ième type', image : "../assets/Avatar1.svg"}, 
                    {text:'trafiquer le droïde ménager de maman', image : "../assets/Avatar1.svg"}, 
                    {text:'créer des paradoxes', image : "../assets/Avatar1.svg"}, 
                   {text: 'aller en croisière muni de votre multipass', image : "../assets/Avatar1.svg"}         ] 
        }
        ], 
        nbQuestions : 6,
        current : 0
      }
    }

}
</script>
