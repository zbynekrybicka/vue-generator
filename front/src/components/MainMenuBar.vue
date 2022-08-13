<template>
	<div :class="['MainMenuBar', className]">
		<a v-text="'Domů'" @click.prevent="page = ''" class="nav-item nav-link text-white" href="#" />
		<a v-text="'Odhlásit se'" @click.prevent="logout" class="nav-item nav-link text-white" href="#" />
	</div>
</template>

<script>

export default {
	props: [ "className",  ],
	data() {
		return {
			page: '',
		}
	},
	methods: {
		logout(e) {
			this.$store.commit('deleteAuthToken')
		},
	},
	computed: {
	},
	watch: {
		page(value) {
			this.$store.commit('setPage', value)
		},
	},
}

</script>