<template>
  <div class="card-footer">
    <span class="cursor-pointer" v-if="!isMyLike" @click="postLike">To se mi líbí: </span>
    <span class="cursor-pointer" v-if="isMyLike" @click="deleteLike">Už se mi to nelíbí: </span>
    <span class="cursor-pointer" @click="showLikesList = true">{{ likesCount }}</span>
    <LikesList :likes="likes" v-if="showLikesList" @close="showLikesList = false" />
  </div>
</template>

<script>
import LikesList from "./LikesList.vue"

export default {
	components: { LikesList,  },
	props: [ "likes","commentId", ],
	emits: [  ],
	data() {
		return {
			showLikesList: false,
		}
	},
	methods: {
		postLike(e) {
			this.$store.dispatch('postLike', { comment_id: this.commentId })
		},
		deleteLike(e) {
			this.$store.dispatch('deleteLike', this.commentId)
		},
	},
	computed: {
		likesCount() {
			return this.likes.length
		},
		isMyLike() {
			return this.likes.find(item => item.user_id === this.$store.state.user_id)
		},
	},
	watch: {
	},
}

</script>