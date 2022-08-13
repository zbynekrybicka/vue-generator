<template>
	<div :class="['ProductCardContentTools', className]">
		<ProductCardContentToolsPrice className="col-6" :product="product" />
		<ProductCardContentToolsDetail className="col-6" :product="product" />
	</div>
</template>

<script>
import ProductCardContentToolsPrice from "./ProductCardContentToolsPrice.vue"
import ProductCardContentToolsDetail from "./ProductCardContentToolsDetail.vue"

export default {
	components: { ProductCardContentToolsPrice, ProductCardContentToolsDetail,  },
	props: [ "className", "product", ],
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