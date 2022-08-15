<template>
	<div :class="['MainMenuBar', className]">
		<MainMenuBarItem text="Homepage" page="" />
		<MainMenuBarItem text="Články" page="articles" />
		<a v-text="'Odhlásit se'" @click.prevent="logout" class="nav-item nav-link text-white" href="#" />
	</div>
</template>

<script>
import MainMenuBarItem from "./MainMenuBarItem.vue"

export default {
	components: { MainMenuBarItem,  },
	props: [ "className",  ],
	data() {
		return {
		}
	},
	methods: {
		logout(e) {
			this.$store.commit('deleteAuthToken')
		},
	},
	computed: {
	},
	watch: {
	},
}

</script>