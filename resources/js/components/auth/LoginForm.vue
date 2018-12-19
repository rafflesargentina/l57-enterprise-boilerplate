<template>
  <form 
    :action="action"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    :method="method"
    aria-label="Ingresá"
    novalidate
    @keydown="form.errors.clear($event.target.name)"
    @submit.prevent="login"
  >
    <div class="form-group">
      <label
        class="sr-only"
        for="email"
      >
        Email
      </label>
      <input 
        v-model="form.email" 
        :class="{ 'is-invalid': form.errors.has('email') }"
        autocomplete="username"
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
        autocomplete="current-password"
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

    <button
      :disabled="submitted"
      type="submit"
      class="btn btn-block btn-lg btn-primary mb-3"
    >
      Ingresá
    </button>

    <div class="form-check">
      <label class="w-100">
        <input 
          v-model="form.remember" 
          class="form-check-input"
          name="remember"
          type="checkbox"
        > Recordame.
        <RouterLink
          class="auth__link auth__link--forgot-password"
          to="/password/request"
        >
          ¿Olvidaste tu contraseña?
        </RouterLink>
      </label>
    </div>
  </form>
</template>

<script>
import Form from "@/utilities/Form"

let fields = {
    email: "",
    password: "",
    remember: "",
}

export default {

    name: "LoginForm",

    props: {
        action: {
            type: String,
            required: true
        },

        method: {
            type: String,
            required: true
        }
    },

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

    methods: {
        login() {
            this.submitted = true

            this.form[this.method](this.action)
                .then(response => {
                    return this.$store.dispatch("auth/login", response)
                })
                .then(response => {
                    let intended = this.$route.query.intended
                    let redirect = intended || response.redirect
                    return this.$router.push({ path: redirect })
                })
                .catch(()=> {
                    this.submitted = false
                })
        },
    }
}
</script>
