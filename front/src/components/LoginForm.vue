<template>
  <label class="col-12 mt-3"><div class="text-center"><b>Uživatelské jméno</b></div>
    <input type="text" v-model="username" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <label class="col-12 mt-3"><div class="text-center"><b>Heslo</b></div>
    <input type="password" v-model="password" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <div class="text-center mt-3">
    <button class="btn btn-primary" @click="login">Přihlásit se</button>
  </div>   
  <div class="text-center mt-3">
    <a href="#" @click.prevent="$emit('goto', 'registration')">Registrace</a>
  </div>
</template>

<script>

export default {
	props: [  ],
	emits: [ "goto", ],
	data() {
		return {
			username: this.$store.state.loginForm.username,
			password: this.$store.state.loginForm.password,
		}
	},
	methods: {
		login(e) {
			this.$store.dispatch('login')
		},
	},
	computed: {
	},
	watch: {
		username(value) {
			this.$store.commit('setLoginFormUsername', value)
		},
		password(value) {
			this.$store.commit('setLoginFormPassword', value)
		},
	},
}

</script>