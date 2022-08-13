<template>
	<div :class="['LoginFormPasswordInput', className]">
		<input type="password" id="loginFormPassword" v-model="password" @keyup.enter="login" class="w-100" />
	</div>
</template>

<script>

export default {
	props: [ "className",  ],
	data() {
		return {
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
		password(value) {
			this.$store.commit('setLoginFormPassword', value)
		},
	},
}

</script>