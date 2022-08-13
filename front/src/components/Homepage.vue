<template>
	<div :class="['Homepage', className]">
		<span v-text="'homepage'" />
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