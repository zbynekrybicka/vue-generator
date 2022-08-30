<template>
  <h2>Dvoufázové ověření</h2>
  <ul>
    <li>
      Stáhněte si aplikaci Google authenticator
      (<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=cs&gl=US" target="_blank">Android</a>,
      <a href="https://apps.apple.com/us/app/google-authenticator/id388497605" target="_blank">iOS</a>).
    </li>
    <li>Naskenujte v aplikaci QR kód.</li>
    <li>Až se budete přihlašovat, bude po Vás web vyžadovat opsání kódu z Google authenticatoru.</li>
  </ul>
  <TwoFactorAuthentication v-if="isTwoFactorAuthentication" />
  <div class="text-center mt-3" v-if="!isTwoFactorAuthentication">
    <button class="btn btn-primary" @click.prevent="activateTwoFactor">Aktivovat dvoufázové ověření</button>
  </div>
</template>

<script>
import TwoFactorAuthentication from "./TwoFactorAuthentication.vue"

export default {
	components: { TwoFactorAuthentication,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
		activateTwoFactor(e) {
			this.$store.dispatch('activateTwoFactor')
		},
	},
	computed: {
		isTwoFactorAuthentication() {
			return !!this.$store.state.qrCodeUrl
		},
	},
	watch: {
	},
}

</script>