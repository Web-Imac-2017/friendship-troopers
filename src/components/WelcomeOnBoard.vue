<template>
   <div class="container post">
    <div class="row center">
      <div class="col-sm-8">
        
        <p> {{ questions[current].number }}</p>
        <p> {{ questions[current].title }} </p>
      </div>
      <div class="col-sm-12">
        <ul>
          <li class="col-sm-2" @click="selected(0)">
            <div class="square"> </div> {{ questions[current].answer[0] }} </li>
          <li class="col-sm-2" @click="selected(1)">
            <div class="square"> </div> {{ questions[current].answer[1] }}  </li>
          <li class="col-sm-2" @click="selected(2)">
             <div class="square"> </div> {{ questions[current].answer[2] }}  </li>
          <li class="col-sm-2" @click="selected(3)">
             <div class="square"> </div> {{ questions[current].answer[3] }}  </li>
          <li class="col-sm-2" @click="selected(4)">
            <div class="square"> </div> {{ questions[current].answer[4] }} </li>
        </ul>
      </div>
      <div class="col-sm-8">
        <div class="slider">
          <input type="range" v-model.number="current" min="0" max="5" step="1"> </input>
        </div>
        <button v-on:click="increment"> Next {{current}}</button>
          <p>
          {{current}}
      </p>
      </div> 
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
    console.log(this.questions[this.current].answer[index])
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
         answer : [ 'bleu', 'vert', 'orange', 'violet', 'noir'
         ]
        }, {
          number : "2",
          title : 'Ton compagnon :' ,
          answer : [ 'un petit vélociraptor', 'un mini Groot', 'une charmante androïde', 'Doc', 'un Choubacca'
         ] 
        }, {
          number : "3",
          title : 'Tes vacances parfaites:' ,
          answer : [ 'un week-end romantique à New New York', 'tester les spécialités culinaires de Vulcain', 'relire tes classiques', 'arpenter un trou nor', 'faire la course de la Bounta'
         ] 
        },{
          number : "4",
          title : 'L\'intellingence artificielle pour gérer ta maison :' ,
          answer : [ 'la Matrice', 'le Brain Bug', 'GladOS', 'AI du HIVE', 'Hall'
         ]},{
          number : "5",
          title : 'Ton moyen de transport de prédilection:' ,
          answer : [ 'le TARDIS', 'la Porte des Etoiles', 'en astro-stop', 'en DeLorean', 'à bord de l\'Arcadia'
         ] 
        },{
          number : "6",
          title : 'Tu aimes :' ,
          answer : [ 'passer du temps dans ton bunker', 'les rencontres du 3ième type', 'trafiquer le droïde ménager de maman', 'créer des paradoxes', 'aller en croisière muni de votre multipass'
         ] 
        }
        ], 
        nbQuestions : 6,
        current : 0
      }
    }

}
</script>