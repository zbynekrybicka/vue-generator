<template>
	<div :class="['MainFrame', className]">
		<MainMenu className="navbar navbar-expand-lg bg-success justify-content-center" />
		<ContentFrame className="container" />
	</div>
</template>

<script>
import MainMenu from "./MainMenu.vue"
import ContentFrame from "./ContentFrame.vue"

export default {
	components: { MainMenu, ContentFrame,  },
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