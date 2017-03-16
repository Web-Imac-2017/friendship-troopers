'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


Vue.component('intergalactique', {
  props: ['intergalactique'],
  template:
    `<div class="actu-intergalactique"> 
      <ul>
        <li>
          <img :src=intergalactique.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=intergalactique.planet class="pseudo">{{intergalactique.pseudo}}</p> 
          <p class="honor">{{intergalactique.honor}}</p>
        </li>
      </ul>
      <p class="content">{{intergalactique.content}} </p>
    </div>`
})


Vue.component('galactique', {
  props: ['galactique'],
  template:
    `<div class="actu-galactique"> 
      <ul>
        <li>
          <img :src=galactique.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=galactique.planet class="pseudo">{{galactique.pseudo }}</p> 
          <p class="honor">{{galactique.honor}}</p>
        </li>
      </ul>
      <p class="content">{{galactique.content}} </p>
    </div>`
})


Vue.component('planetaire', {
  props: ['planetaire'],
  template:
    `<div class="actu-planetaire"> 
      <ul>
        <li>
          <img :src=planetaire.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=planetaire.planet class="pseudo">{{planetaire.pseudo }}</p> 
          <p class="honor">{{planetaire.honor}}</p>
        </li>
      </ul>
      <p class="content">{{planetaire.content}} </p>
    </div>`
})


const LateralMenuRight = Vue.extend({
  template, 
  data () {
      return {
        actualite : {
          intergalactique : [
        	{
        		pseudo: 'luckypon', 
        		avatar:'/assets/images/avatars/Galaxie/astro.svg', 
        		planet :'Galaxie',
        		honor :'Super admin',
        		date : '12/03/13',
        		content : 'Ajout d\'un nouvel avatar et event en préparation!'
        	}
          ], 
          galactique : [
        	{
        		pseudo: 'Sarkophage', 
            userId : 6,
        		avatar:'/assets/images/avatars/Terre/planets.svg', 
        		planet :'Terre',
            planetId : 1,
         		honor :'Expert en tic',
	       		date : '12/03/13',
            content : 'Bienvenue dans la troupe des friends!'
        	}
          ],
          planetaire : [
        	{
        		pseudo: 'Harrissa Ford', 
            userId : 9,
        		avatar:'/assets/images/avatars/Paranose/astro.svg', 
        		planet :'Paranose',
            planetId : 2,
         		honor :'druide',
	       		date : '12/03/13',
        		content : 'Spaghetti party ce soir!'
        	}
        ]
        // type : 0 -> intergalactique / 1 --> galactique / 2 --> planetaire*/
    	}
      }
	}
});


export default LateralMenuRight;
