<template>
	<div :class="['LoginFormUsernameInput', className]">
		<input type="text" id="loginFormUsername" v-model="username" @keyup.enter="login" class="w-100" />
	</div>
</template>

<script>

export default {
	props: [ "className",  ],
	data() {
		return {
			username: this.$store.state.loginForm.username,
		}
	},
	methods: {
	},
	computed: {
	},
	watch: {
		username(value) {
			this.$store.commit('setLoginFormUsername', value)
		},
	},
}

</script>