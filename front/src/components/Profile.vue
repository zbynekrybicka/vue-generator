<template>
  <div class="container">
    <PersonData />
    <Settings />
  </div>
</template>

<script>
import PersonData from "./PersonData.vue"
import Settings from "./Settings.vue"

export default {
	components: { PersonData, Settings,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
	},
	watch: {
	},
	mounted() {
		this.$store.dispatch('loadProfile')
	},
}

</script>