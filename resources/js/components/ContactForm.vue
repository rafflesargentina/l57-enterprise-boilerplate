<style lang="scss" scoped>
textarea {
  height: 12rem;
}
</style>

<template>
  <form 
    :action="action"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    :method="method"
    novalidate
    @submit.prevent="submitForm" 
    @keydown="form.errors.clear($event.target.name)"
  >
    <div class="row mb-3">
      <div class="col-md-5">
        <div class="form-group">
          <label
            class="sr-only"
            for="name"
          >
            Ingresá tu nombre
          </label>
          <input
            v-model="form.name"
            :class="{ 'is-invalid': form.errors.has('name') }"
            class="form-control"
            name="name"
            placeholder="Nombre"
            required
            type="text"
          >
          <span
            v-if="form.errors.has('name')"
            class="invalid-feedback"
            role="alert"
          >
            <strong v-text="form.errors.get('name')" />
          </span>
        </div>

        <div class="form-group">
          <label
            class="sr-only"
            for="email"
          >
            Ingrese su dirección de Email
          </label>
          <input 
            v-model="form.email" 
            :class="{ 'is-invalid': form.errors.has('email') }"
            class="form-control"
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
            for="phone"
          >
            Ingrese un teléfono de contacto
          </label>
          <input
            v-model="form.phone"
            :class="{ 'is-invalid': form.errors.has('phone') }"
            class="form-control"
            name="phone"
            placeholder="Teléfono"
            type="text"
          >
          <span
            v-if="form.errors.has('phone')"
            class="invalid-feedback"
            role="alert"
          >
            <strong v-text="form.errors.get('phone')" />
          </span>
        </div>
      </div>

      <div class="col-md-7">
        <div class="form-group">
          <label
            class="sr-only"
            for="message"
          >
            Mensaje
          </label>
          <textarea
            v-model="form.message"
            :class="{ 'is-invalid': form.errors.has('message') }"
            class="form-control"
            name="message"
            required
            placeholder="Mensaje"
          />
          <span
            v-if="form.errors.has('message')"
            class="invalid-feedback"
            role="alert"
          >
            <strong v-text="form.errors.get('message')" />
          </span>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-5">
        <button
          :disabled="submitted"
          class="btn btn-block btn-lg btn-primary"
          type="submit"
        >
          Enviar mensaje
        </button>
      </div>
    </div>
  </form>
</template>

<script>
import Form from "@/utilities/Form"

let fields = {
    email: "",
    message: "",
    name: "",
    phone: "",
}

export default {

    name: "ContactForm",

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
        submitForm() {
            this.submitted = true

            this.$snotify.async("Procesando...", ()=> new Promise((resolve, reject) => {
                this.form[this.method](this.action)
                    .then(response => {
                        resolve({
                            body: "Tue mensaje fue enviado correctamente.",
                            config: {
                                closeOnClick: true,
                                showProgressBar: true,
                                timeout: 5000
                            }
                        })

                        return this.$router.push({ path: response.redirect })
                    })
                    .catch(error => {
                        this.submitted = false

                        let message = error.status > 422 ? error.data.message : "Ups..."

                        return reject({
                            body: message,
                            config: {
                                closeOnClick: true,
                                showProgressBar: true,
                                timeout: 2000
                            }
                        })
                    })
            })
            )
        },
    },
}
</script>
