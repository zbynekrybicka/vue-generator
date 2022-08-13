<template>
	<div :class="['ContentFrame', className]">
		<Homepage v-if="isHomepage" />
	</div>
</template>

<script>
import Homepage from "./Homepage.vue"

export default {
	components: { Homepage,  },
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
	},
	watch: {
	},
}

</script>