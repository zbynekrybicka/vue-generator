<template>
	<div :class="['ProductsPage', className]">
		<ProductList v-if="!isSelectedProduct" className="row" />
		<ProductDetail v-if="isSelectedProduct" />
	</div>
</template>

<script>
import ProductList from "./ProductList.vue"
import ProductDetail from "./ProductDetail.vue"

export default {
	components: { ProductList, ProductDetail,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		isSelectedProduct() {
			return !!this.$store.state.selectedProduct
		},
	},
	watch: {
	},
}

</script>