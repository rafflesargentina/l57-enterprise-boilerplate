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
import { alertErrorMessage, alertSuccessMessage } from "@/utilities/helpers"
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

            this.form.post("/password/email").then(response => {
                alertSuccessMessage(response.message)
                return this.$router.push({ path: response.redirect || "/" })
            }).catch(error => {
                if (error.status > 422) {
                    alertErrorMessage(error.data.message || error.message)
                }

                return this.submitted = false
            })
        }
    }
}
</script>
