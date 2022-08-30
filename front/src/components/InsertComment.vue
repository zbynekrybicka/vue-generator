<template>
  <div class="col-12 col-sm-6 offset-sm-3">
    <textarea class="col-12 mt-3 mb-3" type="text" v-model="comment" placeholder="Co se Vám honí hlavou?" @paste="detectUrl" />
    <Preview />
    <button class="btn btn-primary" @click="insertComment">Přidat příspěvek</button>
  </div>
</template>

<script>
import Preview from "./Preview.vue"

export default {
	components: { Preview,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
			comment: '',
		}
	},
	methods: {
		insertComment(e) {
			if (this.comment) {
			  this.$store.dispatch('insertComment', this.multimediaComment)
			  this.comment = ''
			  this.$store.commit('clearUrlResult')
			}
		},
		detectUrl(e) {
			const pastedText = e.clipboardData.getData('text')
			if (pastedText.match('https?://')) {
			  this.$store.dispatch('detectUrl', pastedText)
			}
		},
	},
	computed: {
		multimediaComment() {
			return { comment: this.comment, media: this.$store.state.urlResult }
		},
	},
	watch: {
	},
}

</script>