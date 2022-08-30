<template>
  <label class="col-12 mt-3"><div class="text-center"><b>Křestní jméno</b></div>
    <input type="text" v-model="profile.firstname" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <label class="col-12 mt-3"><div class="text-center"><b>Příjmení</b></div>
    <input type="text" v-model="profile.lastname" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <div class="text-center mt-3">
    <button class="btn btn-primary" @click="saveProfile">Uložit</button>
  </div>
</template>

<script>

export default {
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
		saveProfile(e) {
			this.$store.dispatch('saveProfile')
		},
	},
	computed: {
		profile() {
			return this.$store.state.profile
		},
	},
	watch: {
		'profile.firstname'(value) {
			this.$store.commit('setProfileFirstname', value)
		},
		'profile.lastname'(value) {
			this.$store.commit('setProfileLastname', value)
		},
	},
}

</script>