<template>
	<div :class="['ProductDetail', className]">
		<a v-html="'&amp;lt;'" @click="deselectProduct" class="btn btn-secondary" />
		<h1 v-text="product.name" />
		<p v-text="product.description" />
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
		deselectProduct(e) {
			this.$store.commit('selectProduct', null)
		},
	},
	computed: {
		product() {
			return this.$store.state.products.find(product => this.$store.state.selectedProduct === product.id)
		},
	},
	watch: {
	},
}

</script>