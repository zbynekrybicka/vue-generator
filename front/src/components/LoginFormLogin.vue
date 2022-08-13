<template>
	<div :class="['LoginFormLogin', className]">
		<button v-text="'Přihlásit se'" @click="login" class="btn btn-primary float-end" />
	</div>
</template>

<script>

export default {
	props: [ "className",  ],
	data() {
		return {
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
	},
}

</script>