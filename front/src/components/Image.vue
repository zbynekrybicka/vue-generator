<template>
  <img :src="imageUrl" alt="Obrázek není k dispozici" @click="showImage = true" class="cursor-pointer" />
  <div v-if="showImage" @click="showImage = false" class="preloader show-image">
    <div class="show-image-frame col-10 offset-1 mt-3" :style="{ backgroundImage: 'url(' + imageUrl + ')' }">
    </div>
  </div>
</template>

<script>

export default {
	props: [ "image", ],
	emits: [  ],
	data() {
		return {
			showImage: false,
		}
	},
	methods: {
	},
	computed: {
		imageUrl() {
			return this.$store.state.imageUrl + this.image
		},
	},
	watch: {
	},
}

</script>