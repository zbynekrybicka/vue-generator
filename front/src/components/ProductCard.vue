<template>
	<div :class="['ProductCard', className]">
		<ProductCardContent className="card-body" :product="product" />
	</div>
</template>

<script>
import ProductCardContent from "./ProductCardContent.vue"

export default {
	components: { ProductCardContent,  },
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