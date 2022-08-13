<template>
	<div :class="['ContentFrame', className]">
		<Homepage v-if="isHomepage" />
		<ProductsPage v-if="isProducts" className="row" />
		<OrdersPage v-if="isOrders" />
	</div>
</template>

<script>
import Homepage from "./Homepage.vue"
import ProductsPage from "./ProductsPage.vue"
import OrdersPage from "./OrdersPage.vue"

export default {
	components: { Homepage, ProductsPage, OrdersPage,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		isHomepage() {
			return this.$store.state.page === ''
		},
		isProducts() {
			return this.$store.state.page === 'products'
		},
		isOrders() {
			return this.$store.state.page === 'orders'
		},
	},
	watch: {
	},
}

</script>