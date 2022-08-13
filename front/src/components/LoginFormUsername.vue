<template>
	<div :class="['LoginFormUsername', className]">
		<label for="loginFormUsername" v-text="'Přihlašovací jméno'" class="col-sm-6 col-xs-12" />
		<LoginFormUsernameInput className="col-sm-6 col-xs-12" />
	</div>
</template>

<script>
import LoginFormUsernameInput from "./LoginFormUsernameInput.vue"

export default {
	components: { LoginFormUsernameInput,  },
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