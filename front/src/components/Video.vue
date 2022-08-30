<template>
  <video controls muted ref="video">
    <source :src="videoUrl" type="video/mp4" />
  </video>
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
			return this.$store.state.videoUrl + this.video
		},
	},
	watch: {
	},
	created() {
		document.addEventListener('scroll', (e) => {
		  try {
		    const video = this.$refs.video
		    const top = video.getBoundingClientRect().top
		    const breakpoint = innerHeight - video.clientHeight
		    if (top < breakpoint && top > 0) {
		      video.play()
		    } else if (top > breakpoint || top < 0) {
		      video.pause()
		    }
		  } catch(e) {}
		})
	},
}

</script>