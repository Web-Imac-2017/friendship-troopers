<!-- <template>
  <section class="login">

    <form-user v-model="user" title="Request form">
	<div slot="header">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis, minus.</div>
    <div slot="footer">Footer ipsum dolor sit amet, consectetur adipisicing elit. Debitis, minus.</div>

    <div slot="error">{{user.pseudo}} est déjà utilisé !</div>

	</form-user>

    <pre>{{user}}</pre>

  </div>

  </section>
</template>


<script>

let formUser = {
	props:{
		value:Object
	},
	data(){
		return{
			user:JSON.parse(JSON.stringify(this.value)),
			title: 'Inscription',
			seen:false
		}
	},
	methods:{
		save(){
			this.$emit("input", this.user)
		}
	},
	template: `
	<form class="form" @submit.prevent="save">
		<h1>{{ title }}</h1>
		<p><slot name="header"></slot></p>
		<div class="field">
			<label for="">Pseudo</label>
			<input type="text" v-model="user.pseudo" placeholder="edit me">
			<p><slot name="error" v-if="seen"></slot></p>
		</div>
		<div class="field">
			<label for="">Mail</label>
			<input type="text" v-model="user.mail" placeholder="edit me">
		</div>
		<div class="field">
			<label for="">Mot de passe</label>
			<input type="text" v-model="user.password" placeholder="edit me">
		</div>
		<button class="button" type="submit">Envoyer</button>	
		<p><slot name="footer"></slot></p>
    </form>
	`
	,/*mounted: function(){
		console.log(this)
	}*/
}
export default {
	components: {formUser },
	data () {
      return {
        user:{
        	pseudo: '',
	        mail: '',
	        password: ''
        },

      }
    }

}
</script>
 -->


 <template>
  <div class="container container-table">
      <div class="row vertical-10p">
        <div class="container">
          <img class="logo" src="../assets/logo.png">
          <div class="text-center col-md-4 col-sm-offset-4">
            <!-- errors -->
            <div v-if=response class="text-red"><p>{{response}}</p></div>

            <!-- login form -->
            <form class="ui form loginForm"  @submit.prevent="save">

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control" name="username" placeholder="Username" type="text" v-model="username">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control" name="mail" placeholder="Mail" type="text" v-model="mail">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" name="password" placeholder="Password" type="password" v-model="password">
              </div>
              <button type="submit" v-bind:class="'btn btn-primary btn-lg ' + loading">Submit</button>
            </form>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
module.exports = {
  name: 'Login',
  data: function (router) {
    return {
      username: '',
      password: '',
      mail: '',
    }
  },
  methods: {
    save: function () {
      this.$emit("input", this.user)
  	}
  }
}
</script>

<style>
 html, body, .container-table {
  height: 100%;
  /* background-color: #282B30 !important; */
}
.container-table {
    display: table;
    color: white;
}
.vertical-center-row {
    display: table-cell;
    vertical-align: middle;
}
.vertical-20p {
  padding-top: 20%;
}
.vertical-10p {
  padding-top: 10%;
}
.logo {
  width: 15em;
  padding: 3em;
}
.loginForm .input-group {
  padding-bottom: 1em;
  height: 4em;
}
.input-group input {
  height: 4em;
} 
</style>