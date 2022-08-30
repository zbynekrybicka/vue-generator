<template>
  <label class="col-12 mt-3"><div class="text-center"><b>Autorizační kód</b></div>
    <input type="text" ref="input" v-model="authCode" @keyup.enter="authorize" class="col-12 col-sm-6 offset-sm-3" />
  </label>
  <div class="text-center mt-3">
    <button class="btn btn-primary" @click="authorize">Autorizovat</button>
  </div>  
</template>

<script>

export default {
	props: [  ],
	emits: [  ],
	data() {
		return {
			authCode: '',
		}
	},
	methods: {
		authorize(e) {
			this.$store.dispatch('authorize', this.authorizeData)
		},
	},
	computed: {
		authorizeData() {
			return { user_id: this.$store.state.user_id, authCode: this.authCode }
		},
	},
	watch: {
	},
	mounted() {
		this.$refs.input.focus()
	},
}

</script>