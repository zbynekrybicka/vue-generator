<template>
	<div :class="['App', className]">
		<span v-if="isPreloader" class="preloader" />
		<span v-if="isMessageShown" class="errorMessage" @click="hideErrorMessage" v-text="errorMessage" />
		<LoginForm v-if="!isLoggedIn" className="container mt-5" />
		<MainFrame v-if="isLoggedIn" />
	</div>
</template>

<script>
import LoginForm from "./LoginForm.vue"
import MainFrame from "./MainFrame.vue"

export default {
	components: { LoginForm, MainFrame,  },
	props: [ "className",  ],
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
	mounted() {
		this.$store.commit('loadAuthToken')
	}
}

</script>