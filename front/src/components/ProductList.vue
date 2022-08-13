<template>
	<div :class="['ProductList', className]">
		<h1 v-text="'Produkty'" />
		<Product v-for="product in products" :key="product.id" :product="product" :className="['col-md-4', 'col-sm-6', 'col-xs-12']" />
	</div>
</template>

<script>
import Product from "./Product.vue"

export default {
	components: { Product,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		products() {
			return this.$store.state.products
		},
	},
	watch: {
	},
	mounted() {
		this.$store.dispatch('getProducts')
	}
}

</script>