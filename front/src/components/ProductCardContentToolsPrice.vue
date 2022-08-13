<template>
	<div :class="['ProductCardContentToolsPrice', className]">
		<div v-text="product.price + ' Kč'" class="text-danger fw-bold" />
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
	},
	computed: {
	},
	watch: {
	},
}

</script>