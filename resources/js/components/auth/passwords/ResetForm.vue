<template>
  <form
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    method="POST"
    action="/password/reset"
    novalidate
    @submit.prevent="reset"
    @keydown="form.errors.clear($event.target.name)"
  >
    <div class="form-group">
      <label
        class="sr-only"
        for="email"
      >
        Email
      </label>
      <input 
        v-model="form.token" 
        type="hidden" 
        name="token"
      >
      <input
        v-model="form.email"
        :class="{ 'is-invalid': form.errors.has('email') }"
        class="form-control form-control-lg"
        name="email"
        placeholder="Email"
        required
        type="email"
      >
      <span
        v-if="form.errors.has('email')"
        class="invalid-feedback"
        role="alert"
      >
        <strong v-text="form.errors.get('email')" />
      </span>
    </div>

    <div class="form-group">
      <label
        class="sr-only"
        for="password"
      >
        Contraseña
      </label>
      <input
        v-model="form.password"
        :class="{ 'is-invalid': form.errors.has('password') }"
        class="form-control form-control-lg"
        name="password"
        placeholder="Contraseña"
        required
        type="password"
      >
      <span
        v-if="form.errors.has('password')"
        class="invalid-feedback"
        role="alert"
      >
        <strong v-text="form.errors.get('password')" />
      </span>
    </div>

    <div class="form-group">
      <label
        class="sr-only"
        for="password-confirm"
      >
        Confirmación de contraseña
      </label>

      <input
        v-model="form.password_confirmation"
        :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
        class="form-control form-control-lg"
        name="password_confirmation"
        placeholder="Confirmación de contraseña"
        type="password"
      >
    </div>
    <button
      :disabled="submitted"
      class="btn btn-block btn-lg btn-primary"
      type="submit"
    >
      Reestablecer
    </button>
  </form>
</template>

<script>
import Form from "@/utilities/Form"

let fields = {
    email: "",
    token: "",
    password: "",
    password_confirmation: "",
}

export default {

    name: "ResetForm",

    data() {
        return {
            form: new Form(fields),
            submitted: false
        }
    },

    computed: {
        validated() {
            return this.form.errors.any()
        }
    },

    created() {
        return this.form.token = this.$route.params.token
    },

    methods: {
        reset() {
            this.submitted = true

            this.form.post("/password/reset").then(response => {
                this.form.reset()
                this.$snotify.success(response.message)
                return this.$router.push({ path: response.redirect || "/" })
            }).catch(error => {
                this.submitted = false
                if (error.status > 422) {
                    this.$snotify.error("Ocurrió un error con el siguiente mensaje: " + error.data.message)
                }
            })
        },
    }
}
</script>
