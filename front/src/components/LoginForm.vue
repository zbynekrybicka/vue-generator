<template>
	<div :class="['LoginForm', className]">
		<LoginFormUsername className="row" />
		<LoginFormPassword className="row" />
		<LoginFormLogin />
	</div>
</template>

<script>
import LoginFormUsername from "./LoginFormUsername.vue"
import LoginFormPassword from "./LoginFormPassword.vue"
import LoginFormLogin from "./LoginFormLogin.vue"

export default {
	components: { LoginFormUsername, LoginFormPassword, LoginFormLogin,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
	},
	watch: {
	},
}

</script>