<template>
	<div :class="['ProductCardContentToolsDetail', className]">
		<a v-text="'Detail'" class="btn btn-primary float-end" @click="selectProduct" />
	</div>
</template>

<script>

export default {
	props: [ "className", "product", ],
	data() {
		return {
		}
	},
	methods: {
		selectProduct(e) {
			this.$store.commit('selectProduct', this.product.id)
		},
	},
	computed: {
	},
	watch: {
	},
}

</script>