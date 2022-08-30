<template>
  <ul class="nav bg-primary">
    <li class="nav-item">
      <a class="nav-link text-white" href="#" @click.prevent="page = ''"><b>Zeď</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#" @click.prevent="page = 'profile'"><b>Profil</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#" @click.prevent="logout"><b>Odhlásit se</b></a>
    </li>
  </ul>
</template>

<script>

export default {
	props: [  ],
	emits: [  ],
	data() {
		return {
			page: '',
		}
	},
	methods: {
		logout(e) {
			this.$store.commit('logout')
		},
	},
	computed: {
	},
	watch: {
		page(value) {
			this.$store.commit('setPage',value)
		},
	},
}

</script>