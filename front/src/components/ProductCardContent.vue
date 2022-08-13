<template>
	<div :class="['ProductCardContent', className]">
		<h2 v-text="product.name" class="card-title" />
		<p v-text="product.description" class="card-text" />
		<ProductCardContentTools className="row" :product="product" />
	</div>
</template>

<script>
import ProductCardContentTools from "./ProductCardContentTools.vue"

export default {
	components: { ProductCardContentTools,  },
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