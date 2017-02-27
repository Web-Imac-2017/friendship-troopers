	<template>
		<div class="container">
		<div class="row">

			<div class="admin-menu col-sm-2">
				<menuAdmin></menuAdmin>
			</div>

			<div class="col-sm-10"> 
				<div class="">
					<h1>Signalements</h1>
					<p> {{ reports.number }} au total </p>    
				</div>
				<div v-for="reportedPost in reports.reportedPosts" class="container" >
					<div class="col-sm-9">
						<p class="left"> Publication signalée pour <span> {{ reportedPost.type}} </span> le {{ reportedPost.date}} à {{ reportedPost.hour}} </p>
						<!-- TODO change with postTemplate -->			
						<div class="row post"> 
							<div class="col-sm-1">
								<div class="avatar">
									<img :src="avatar" alt="default avatar" class="avatar">
								</div>
							</div>
							<div class="col-sm-11">
									<div class="col-sm-11 left">
										<h1 class="pseudo">{{ reportedPost.post.user }}</h1>
										<small class="date"> {{ reportedPost.post.date + " à " + reportedPost.post.hour }}</small>
									</div>
									<div class="col-sm-12">
										<p class="content-block"> {{ reportedPost.post.content }} </p>
									</div>
							</div>
						</div>
					</div>
					<p> <span>{{reportedPost.nbTimesReported}} fois </span> signalé depuis son inscritpion ({{ reportedPost.inscriptionDate }}) </p>
					
						
					<reportBar> </reportBar>
					
				</div>
			</div>
		</div>
		</div>
	</template>

<style src="../../../www/assets/css/admin.css"></style>

<script>

let reportBar = {
	methods: {
		ignore() {
			
		},
		deleteMessage() {

		},
		deleteUser() {

		}
	},
	template : 
	`
	<div class="col-sm-6">
		<button class="col-sm-3 admin-button" @click="ignore"> Ignorer le signalement </button>
		<button class="col-sm-3 brown-button admin-button" @click="deleteMessage"> Supprimer le message </button>
		<button class="col-sm-3 red-button admin-button" @click="deleteUser"> Supprimer l'utilisateur </button>
	</div>
	`

	
}

import menuAdmin from './NavbarAdmin'

export default {
	
  components: { menuAdmin, reportBar} ,
  data () {
      return { 
       reports : {
          number : '2',
          reportedPosts : [ {
          		type : 'Contenu indésirable',
          		date :'25 fev',
          		hour : '15h20',
          		post:{
		          user: 'Lucky',
		          avatar : "addresse de l'avatar",
		          date: '20 fev',
		          hour: '12h04',
		          content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut tortor eu ipsum laoreet faucibus. Etiam mattis eros id leo maximus blandit. Proin id massa in risus gravida suscipit non eu arcu. Aenean auctor lacus risus, porttitor sodales odio vehicula eu. Curabitur luctus ut ligula a iaculis. Aliquam erat volutpat. Pellentesque magna nibh, aliquam sit amet consectetur eget, auctor quis neque.',
		          likes: '50',
		          comments: '2'
        		},
        		nbTimesReported : '3',
        		inscriptionDate : '3 fev. 2017'

          	}, {
          		type : 'Insulte',
          		date : '28 fev',
          		hour : '18h20',
          		post:{
		          user: 'Le fifou du 13',
		          avatar : "addresse de l'avatar",
		          date: '20 fev',
		          hour: '12h04',
		          content: 'On en a rien a foutre de ce que tu nous dis mec!',
		          likes: '500',
		          comments: '12'
        		},
        		nbTimesReported : '20',
        		inscriptionDate : '13 fev. 2016'
        	}
          ]
       }
   }
      
   }

}
</script>