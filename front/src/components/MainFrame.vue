<template>
  <MainMenu />
  <MainContent v-if="page === ''" />
  <Profile v-if="page === 'profile'" />
</template>

<script>
import MainMenu from "./MainMenu.vue"
import MainContent from "./MainContent.vue"
import Profile from "./Profile.vue"

export default {
	components: { MainMenu, MainContent, Profile,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		page() {
			return this.$store.state.page
		},
	},
	watch: {
	},
}

</script>