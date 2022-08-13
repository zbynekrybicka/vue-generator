<template>
	<div :class="['OrdersPage', className]">
		<span v-text="'objednávky'" />
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
	},
	computed: {
	},
	watch: {
	},
}

</script>