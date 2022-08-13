<template>
	<div :class="['MainMenu', className]">
		<MainMenuBar className="navbar-nav text-center" />
	</div>
</template>

<script>
import MainMenuBar from "./MainMenuBar.vue"

export default {
	components: { MainMenuBar,  },
	props: [ "className",  ],
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
}

</script>