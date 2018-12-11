<template>
  <form
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    action="/password/email"
    method="POST"
    novalidate
    @keydown="form.errors.clear($event.target.name)"
    @submit.prevent="request"
  >
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
    <button
      :disabled="submitted"
      class="btn btn-block btn-lg btn-primary"
      type="submit"
    >
      Enviar
    </button>
  </form>
</template>

<script>
import Form from "../../../utilities/Form"

let fields = {
    email: "",
}

export default {

    name: "RequestForm",

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
        request() {
            this.submitted = true

            this.$snotify.async("Procesando...", ()=> new Promise((resolve, reject) => {
                this.form.post("/password/email")
                    .then(response => {
                        resolve({
                            body: "Tu solicitud de reestablecimiento de contraseña fue procesada.",
                            config: {
                                closeOnClick: true,
                                showProgressBar: true,
                                timeout: 5000
                            }
                        }) 
                        return this.$router.push({ path: response.redirect || "/" })
                    })
                    .catch(error => {
                        this.submitted = false

                        let message = error.status > 422 ? error.data.message : "Ups..."

                        return reject({
                            body: message,
                            config: {
                                closeOnClick: true,
                                showProgressBar: true,
                                timeout: 2000,
                            }
                        })
                    })
                })
            )
        }
    },
}
</script>
