<template>
	<div :class="['MainMenuBarItem', className]">
		<a v-text="text" @click.prevent="setPage" class="nav-item nav-link text-white" href="#" />
	</div>
</template>

<script>

export default {
	props: [ "className", "text","page", ],
	data() {
		return {
		}
	},
	methods: {
		setPage(e) {
			this.$store.commit('setPage', this.page)
		},
	},
	computed: {
	},
	watch: {
	},
}

</script>