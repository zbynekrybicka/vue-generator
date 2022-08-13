<template>
	<div :class="['Homepage', className]">
		<span v-text="'Homepage'" />
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