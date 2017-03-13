'use strict';
import Vue from 'vue/dist/vue';

let template = require('./template.html');
template     = eval(`\`${template}\``);


Vue.component('intergalactique-item', {
  props: ['intergalactique'],
  template:
    `<div class="actu-intergalactique"> 
      <router-link :to="{ name: 'User', params: { user: intergalactique.pseudo}}">
      <ul>
        <li>
          <img :src=intergalactique.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=intergalactique.planet class="pseudo">{{intergalactique.pseudo}}</p> 
          <p class="honor">{{intergalactique.honor}}</p>
        </li>
      </ul>
      </router-link>
      <p class="content">{{intergalactique.content}} </p>
    </div>`
})


Vue.component('galactique-item', {
  props: ['galactique'],
  template:
    `<div class="actu-galactique"> 
      <router-link :to="{ name: 'User', params: { user: galactique.pseudo}}">
      <ul>
        <li>
          <img :src=galactique.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=galactique.planet class="pseudo">{{galactique.pseudo }}</p> 
          <p class="honor">{{galactique.honor}}</p>
        </li>
      </ul>
      </router-link>
      <p class="content">{{galactique.content}} </p>
    </div>`
})


Vue.component('planetaire-item', {
  props: ['planetaire'],
  template:
    `<div class="actu-planetaire"> 
      <router-link :to="{ name: 'User', params: { user: planetaire.pseudo}}">
      <ul>
        <li>
          <img :src=planetaire.avatar alt="avatar" class="avatar"> 
        </li>
        <li>
          <p :class=planetaire.planet class="pseudo">{{planetaire.pseudo }}</p> 
          <p class="honor">{{planetaire.honor}}</p>
        </li>
      </ul>
      </router-link>
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
        		content : 'héhé, je suis une actualité :) !'
        	}
          ], 
          galactique : [
        	{
        		pseudo: 'Ponyta', 
        		avatar:'/assets/images/avatars/Terre/planets.svg', 
        		planet :'Terre',
         		honor :'Super zorro',
	       		date : '12/03/13',
        		content : 'héhé, je suis une actualité :) ! adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pell'
        	}
          ],
          planetaire : [
        	{
        		pseudo: 'Yakati', 
        		avatar:'/assets/images/avatars/Paranose/astro.svg', 
        		planet :'Paranose',
         		honor :'Super sayen',
	       		date : '12/03/13',
        		content : 'héhé, je suis une actualité :) !'
        	}
        ]
        // type : 0 -> intergalactique / 1 --> galactique / 2 --> planetaire*/
    	}
      }
	}
});


export default LateralMenuRight;
