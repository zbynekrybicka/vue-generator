<template>
	<div :class="['ContentFrame', className]">
		<Homepage v-if="isHomepage" />
		<Articles v-if="isArticles" />
	</div>
</template>

<script>
import Homepage from "./Homepage.vue"
import Articles from "./Articles.vue"

export default {
	components: { Homepage, Articles,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		isHomepage() {
			return this.$store.state.page === ''
		},
		isArticles() {
			return this.$store.state.page === 'articles'
		},
	},
	watch: {
	},
}

</script>