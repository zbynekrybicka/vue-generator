<template>
  <div class="container">
    <InsertComment />
    <Comment v-for="comment in comments" :comment="comment"/>
  </div>
</template>

<script>
import Comment from "./Comment.vue"
import InsertComment from "./InsertComment.vue"

export default {
	components: { Comment, InsertComment,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		comments() {
			return this.$store.state.comments
		},
	},
	watch: {
	},
	created() {
		this.$store.dispatch('getComments')
	},
}

</script>