<template>
  <label class="col-12 mt-3"><div class="text-center"><b>Uživatelské jméno</b></div>
    <input type="text" v-model="username" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <label class="col-12 mt-3"><div class="text-center"><b>Křestní jméno</b></div>
    <input type="text" v-model="firstname" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <label class="col-12 mt-3"><div class="text-center"><b>Příjmení</b></div>
    <input type="text" v-model="lastname" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <label class="col-12 mt-3"><div class="text-center"><b>Heslo</b></div>
    <input type="password" v-model="password" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <div class="text-center mt-3">
    <button class="btn btn-primary" @click="registration">Registrovat</button>
  </div>   
  <div class="text-center mt-3">
    <a href="#" @click.prevent="$emit('goto', '')">Přihlásit se</a>
  </div>
</template>

<script>

export default {
	props: [  ],
	emits: [ "goto", ],
	data() {
		return {
			username: '',
			firstname: '',
			lastname: '',
			password: '',
		}
	},
	methods: {
		registration(e) {
			this.$store.dispatch('registration')
		},
	},
	computed: {
	},
	watch: {
		username(value) {
			this.$store.commit('setRegistrationFormUsername', value)
		},
		firstname(value) {
			this.$store.commit('setRegistrationFormFirstname', value)
		},
		lastname(value) {
			this.$store.commit('setRegistrationFormLastname', value)
		},
		password(value) {
			this.$store.commit('setRegistrationFormPassword', value)
		},
	},
}

</script>