<template>
  <img :src="imagePreview" alt="Obrázek není k dispozici" />
</template>

<script>

export default {
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		imagePreview() {
			return this.$store.state.urlResult.content
		},
	},
	watch: {
	},
}

</script>