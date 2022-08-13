<template>
	<div :class="['MainMenu', className]">
		<span v-text="'Domů'" @click="page = ''" />
		<span v-text="'Produkty'" @click="page = 'products'" />
		<span v-text="'Objednávky'" @click="page = 'orders'" />
		<span v-text="'Odhlásit se'" @click="logout" />
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