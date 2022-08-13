<template>
	<div :class="['Product', className]">
		<ProductCard className="card" :product="product" />
	</div>
</template>

<script>
import ProductCard from "./ProductCard.vue"

export default {
	components: { ProductCard,  },
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