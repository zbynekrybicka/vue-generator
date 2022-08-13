<template>
	<div :class="['LoginFormPassword', className]">
		<label for="loginFormPassword" v-text="'Heslo'" class="col-sm-6 col-xs-12" />
		<LoginFormPasswordInput className="col-sm-6 col-xs-12" />
	</div>
</template>

<script>
import LoginFormPasswordInput from "./LoginFormPasswordInput.vue"

export default {
	components: { LoginFormPasswordInput,  },
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