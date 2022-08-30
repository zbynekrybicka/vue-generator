<template>
  <div class="container-fluid bg-light login-form pt-5 pb-5">
    <div class="container bg-white border border-dark pt-5 pb-5">
      <LoginForm v-if="isLogin" @goto="page = $event" />
      <RegistrationForm v-if="isRegistration" @goto="page = $event" />
      <TwoFactorLogin v-if="isTwoFactor" />
    </div>
  </div>
</template>

<script>
import LoginForm from "./LoginForm.vue"
import RegistrationForm from "./RegistrationForm.vue"
import TwoFactorLogin from "./TwoFactorLogin.vue"

export default {
	components: { LoginForm, RegistrationForm, TwoFactorLogin,  },
	props: [  ],
	emits: [  ],
	data() {
		return {
			page: '',
		}
	},
	methods: {
	},
	computed: {
		isLogin() {
			return !this.$store.state.user_id && this.page === ''
		},
		isTwoFactor() {
			return this.$store.state.user_id && !this.$store.authToken
		},
		isRegistration() {
			return this.page === 'registration'
		},
	},
	watch: {
	},
}

</script>