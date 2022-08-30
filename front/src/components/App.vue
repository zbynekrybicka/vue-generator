<template>
  <span class="preloader" v-if="isPreloader" />
  <span class="errorMessage" 
    v-if="isMessageShown" 
    @click="hideErrorMessage">{{ errorMessage }}</span>
  <LoginFrame v-if="!isLoggedIn" />
  <MainFrame v-if="isLoggedIn" />
</template>

<script>
import LoginFrame from "./LoginFrame.vue"
import MainFrame from "./MainFrame.vue"

export default {
	components: { LoginFrame, MainFrame,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
		hideErrorMessage(e) {
			this.$store.commit('hideErrorMessage')
		},
	},
	computed: {
		isPreloader() {
			return this.$store.state.preloader
		},
		isMessageShown() {
			return !!this.$store.state.errorMessage
		},
		errorMessage() {
			return this.$store.state.errorMessage
		},
		isLoggedIn() {
			return !!this.$store.state.authToken
		},
	},
	watch: {
	},
	created() {
		this.$store.commit('loadAuthToken')
	},
}

</script>