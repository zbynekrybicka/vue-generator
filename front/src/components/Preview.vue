<template>
  <div class="card mt-3 col-12" v-if="isPreview">
    <div class="modal-header p-3 justify-content-end">
      <button type="button" class="btn-close cursor-pointer" aria-label="Close" @click="closePreview"></button>
    </div>
    <PreviewImage v-if="isImage" />
    <PreviewYoutube v-if="isYoutube" />
  </div>
</template>

<script>
import PreviewImage from "./PreviewImage.vue"
import PreviewYoutube from "./PreviewYoutube.vue"

export default {
	components: { PreviewImage, PreviewYoutube,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
		closePreview(e) {
			this.$store.commit('clearUrlResult')
		},
	},
	computed: {
		isPreview() {
			return this.$store.state.urlResult.type !== null
		},
		isImage() {
			return this.$store.state.urlResult.type === 'image'
		},
		isYoutube() {
			return this.$store.state.urlResult.type === 'youtube'
		},
	},
	watch: {
	},
}

</script>