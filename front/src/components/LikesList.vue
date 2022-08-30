<template>
  <div @click="$emit('close')" class="preloader show-image">
    <div class="container mt-5">
      <div class="card col-12">
        <div class="card-body">
          <h5 class="card-title">To se mi líbí</h5>
          <h6 class="card-subtitle mb-2 text-muted">Lidé, kteří Vás ocenili</h6>
          <a href="#" class="card-link" @click.prevent.stop="" v-for="like of likes">{{ like.name }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
	props: [ "likes", ],
	emits: [ "close", ],
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