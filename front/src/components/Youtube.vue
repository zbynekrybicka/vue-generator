<template>
  <iframe :src="videoUrl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" height="400" allowfullscreen></iframe>
</template>

<script>

export default {
	props: [ "video", ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		videoUrl() {
			return 'https://www.youtube.com/embed/' + this.video
		},
	},
	watch: {
	},
}

</script>