<template>
  <div class="text-center">
    <p><b>Upozornění: V tuto chvíli již máte aktivované dvoufázové ověření. V případě, že si nepřidáte účet do Google authenticatoru, nepůjde se Vám nadále přihlásit.</b></p>
  
    <img :src="qrCodeUrl" alt="qr code" />
  </div>
</template>

<script>

export default {
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
		qrCodeUrl() {
			return this.$store.state.qrCodeUrl
		},
	},
	watch: {
	},
}

</script>