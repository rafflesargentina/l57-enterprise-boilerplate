<template>
  <form
    :action="action"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    :method="method"
    aria-label="Registrate"
    novalidate
    @keydown="form.errors.clear($event.target.name)"
    @submit.prevent="register"
  >
    <div class="row">
      <div class="col-sm-6 form-group">
        <label
          class="sr-only"
          for="first_name"
        >
          Nombre
        </label>
        <input 
          v-model="form.first_name" 
          :class="{ 'is-invalid': form.errors.has('first_name') }"
          class="form-control form-control-lg" 
          name="first_name" 
          placeholder="Nombre"
          required
          type="text"
        >
        <span
          v-if="form.errors.has('first_name')"
          class="invalid-feedback"
          role="alert"
        >
          <strong v-text="form.errors.get('first_name')" />
        </span>
      </div>
      <div class="col-sm-6 form-group">
        <label
          class="sr-only"
          for="last_name"
        >
          Apellido
        </label>
        <input
          v-model="form.last_name"
          :class="{ 'is-invalid': form.errors.has('last_name') }"
          class="form-control form-control-lg"
          name="last_name"
          placeholder="Apellido"
          type="text"
        >
        <span
          v-if="form.errors.has('last_name')"
          class="invalid-feedback"
          role="alert"
        >
          <strong v-text="form.errors.get('last_name')" />
        </span>
      </div>
    </div>

    <div class="form-group">
      <label
        class="sr-only"
        for="email"
      >
        E-Mail
      </label>
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
        type="password"
        required
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
        for="password_confirmation"
      >
        Confirmación de contraseña
      </label>
      <input 
        v-model="form.password_confirmation" 
        :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
        class="form-control form-control-lg" 
        name="password_confirmation"
        placeholder="Confirmación de contraseña"
        required
        type="password"
      >
    </div>

    <div class="form-group">
      <div class="form-check">
        <input
          v-model="form.accepted"
          :class="{ 'is-invalid': form.errors.has('accepted') }"
          class="form-check-input"
          name="accepted"
          required
          type="checkbox"
          value="1"
        >
        <label 
          for="accepted" 
          class="form-check-label"
        >
          Acepto los <u
            data-toggle="modal" 
            data-target="#modalTermsAndConditions"
            role="button"
          >
            Términos y Condiciones
          </u> y la <u 
            data-toggle="modal" 
            data-target="#modalPolicyOfPrivacy"
            role="button"
          >
            Política de Privacidad
          </u>.
        </label>
        <div
          v-if="form.errors.has('accepted')"
          class="invalid-feedback"
          role="alert"
        >
          <strong v-text="form.errors.get('accepted')" />
        </div>
      </div>
    </div>

    <button
      :disabled="submitted"
      class="btn btn-block btn-lg btn-primary"
      type="submit"
    >
      Registrate
    </button>
  </form>
</template>

<script>
import Form from "@/utilities/Form"

let fields = {
    accepted: "",
    email: "",
    first_name: "",
    last_name: "",
    password: "",
    password_confirmation: ""
}

export default {

    name: "RegisterForm",

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
        register() {
            this.submitted = true

            this.form[this.method](this.action).then(response => {
                return this.$store.dispatch("auth/login", response.data)
            }).then(()=> {
                this.$snotify.success("Fuiste registrado correctamente.")
                return this.$router.push({ path: response.redirect || "/" })
            }).catch(error => {
                this.submitted = false
                if (error.status > 422) {
                    this.$snotify.error("Ocurrió un error con el siguiente mensaje: " + error.data.message)
                }
            })
        },
    },
}
</script>
