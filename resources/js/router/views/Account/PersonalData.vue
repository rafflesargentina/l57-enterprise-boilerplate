<template>
  <form
    :action="action"
    :class="[validated ? 'needs-validation' : 'needs-validation']"
    :method="method"
    novalidate
    aria-label="Datos Personales"
    @submit.prevent="submitForm"
    @keydown="form.errors.clear($event.target.name)"
  >
    <div class="row no-gutters">
      <div class="col-sm-4 order-sm-2 mb-2 mb-sm-0">
        <div class="card account__card">
          <div class="account__card-cover" />
          <div class="account__card-img">
            <div class="account__card-img-inner">
              <img 
                v-if="form.avatar"
                :src="form.avatar.url"
                class="account__img preview"
              >
              <div
                v-if="!form.avatar"
                class="account__img preview"
              />
            </div>
          </div>
          <section class="card-body account__card-body">
            <div class="account__card-header text-center">
              <h5>{{ user.name }}</h5>
              <i>{{ username }}</i>
            </div>
            <button
              class="btn btn-block btn-outline-primary"
              data-toggle="modal"
              data-target="#modalChangeAvatar"
              type="button"
            >
              Cambiar foto
            </button>
          </section>
        </div>
      </div>

      <div class="col-sm-8 mb-2 mb-sm-0 pr-sm-2 pr-md-3">
        <main class="account-content card account__card"> 
          <section class="account-section">
            <h4 class="account-header">
              Datos Personales
            </h4>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label
                  for="first_name"
                >
                  Nombre
                </label>
                <input
                  v-model="form.first_name"
                  :class="{ 'is-invalid': form.errors.has('first_name') }"
                  type="text"
                  class="form-control"
                  name="first_name"
                  required
                  autofocus
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
                  for="last_name"
                >
                  Apellido
                </label>
        
                <input
                  v-model="form.last_name"
                  :class="{ 'is-invalid': form.errors.has('last_name') }"
                  type="text"
                  class="form-control"
                  name="last_name"
                  required
                  autofocus
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
                for="email"
              >
                E-Mail
              </label>
        
              <input
                v-model="form.email"
                :class="{ 'is-invalid': form.errors.has('email') }"
                type="email"
                class="form-control"
                name="email"
                required
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
                for="password"
              >
                Contraseña
              </label>

              <input
                v-model="form.password"
                :class="{ 'is-invalid': form.errors.has('password') }"
                type="password"
                class="form-control"
                name="password"
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
                for="password-confirm"
              >
                Confirmación de contraseña
              </label>

              <input
                v-model="form.password_confirmation"
                :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                type="password"
                class="form-control"
                name="password_confirmation"
                required
              >
            </div>

            <button
              type="submit"
              class="btn btn-block btn-lg btn-primary"
            >
              <span class="fa fa-check pr-2" />Actualizar datos
            </button>
          </section>
        </main>
      </div>
    </div>

    <div
      id="modalChangeAvatar"
      aria-hidden="true"
      aria-labelledby="modalTitleChangeAvatar" 
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 
              id="modalTitleChangeAvatar" 
              class="modal-title"
            >
              Cambiar foto
            </h5>
            <button 
              type="button" 
              class="close" 
              data-dismiss="modal" 
              aria-label="Close"
            >
              <span aria-hidden="true">
                &times;
              </span>
            </button>
          </div>
          <vue-dropzone 
            id="dzAvatar"
            ref="dzAvatar"
            :options="dzOptions"
            @vdropzone-error="dzError"
            @vdropzone-files-added="dzAddOrRemoveFiles" 
            @vdropzone-mounted="dzMounted"
            @vdropzone-removed-file="dzAddOrRemoveFiles" 
            @vdropzone-processing="dzSetUrl"
            @vdropzone-queue-complete="dzAccept"
          />
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6 mb-2 mb-sm-0">
                <button
                  :disabled="!dzHasAcceptedFiles"
                  class="btn btn-block btn-outline-primary"
                  type="button"
                  @click="dzProcessQueue"
                >
                  <span class="fa fa-check pr-2" />Aceptar
                </button>
              </div>
              <div class="col-sm-6">
                <button
                  class="btn btn-block btn-outline-primary"
                  type="button"
                  @click="dzCancel"
                >
                  <span class="fa fa-times pr-2" />Cancelar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import { authComputed } from "@/store/helpers"
import { getSavedState, mapDzMockFile,  previewDzThumbnailFromFile } from "@/utilities/helpers"
import store from "@/store"
import vue2Dropzone from "vue2-dropzone"
import Form from "@/utilities/Form"

import "vue2-dropzone/dist/vue2Dropzone.min.css"

const token = getSavedState("auth.token")
const csrfToken = document.head.querySelector("meta[name=\"csrf-token\"]").content

export default {

    name: "PersonalData",

    components: {
        vueDropzone: vue2Dropzone
    },

    data() {
        return {
            dzHasError: false,
            dzOptions: {
                addRemoveLinks: true,
                autoProcessQueue: false,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i><br/>Hacé click o arrastrá una foto hacía acá",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Authorization": "Bearer " + token
                },
                maxFiles: 1,
                maxFilesize: 0.2,
                method: "put",
                params: { avatar: { 0: { featured: 1 } } },
                paramName: "avatar",
                uploadMultiple: true,
                url: "/api/avatars"
            },
            dzHasAcceptedFiles: false,
            form: {}
        }
    },

    computed: {
        ...authComputed,

        action() {
            return "/api/account"
        },

        dzAvatar() {
            return this.$refs.dzAvatar
        },

        dzUrl() {
            return "/api/avatars/" + this.user.id
        },

        method() {
            return "put"
        },

        validated() {
            return this.form.errors.any()
        }
    },

    created() {
        this.form = new Form(this.user)

        store.watch(state => state.auth.user, value => {
            this.form = new Form(value)
        })
    },

    mounted() {
        let modal = document.querySelector("#modalChangeAvatar")
        document.querySelector("body").appendChild(modal)
    },

    methods: {
        dzAccept() {
            if (!this.dzHasError) {
                window.$("#modalChangeAvatar").modal("hide")
                return store.dispatch("auth/validate")
            }
        },

        dzAddOrRemoveFiles() {
            return this.dzHasAcceptedFiles = this.dzAvatar.getAcceptedFiles().length > 0
        },

        dzCancel() {
            window.$("#modalChangeAvatar").modal("hide")

            if (this.dzAvatar.getQueuedFiles().length > 0) {
                this.dzAvatar.removeAllFiles()
                return this.dzMounted()
            }

            if (this.dzAvatar.getAcceptedFiles().length === 0) {
                return this.dzMounted()
            }

            return
        },

        dzError() {
            return this.dzHasError = true
        },

        dzMounted() {
            if (this.user.avatar) {
                return previewDzThumbnailFromFile(this.dzAvatar.dropzone, mapDzMockFile(this.user.avatar))
            }
        },

        dzProcessQueue() {
            if (this.dzAvatar) {
                this.dzHasError = false
                return this.dzAvatar.processQueue()
            }
        },

        dzSetUrl() {
            if (this.dzAvatar) {
                return this.dzAvatar.setOption("url", this.dzUrl)
            }
        },

        submitForm() {
            this.submitted = true

            this.form[this.method](this.action)
                .then(()=> {
                    this.$store.dispatch("auth/validate")

                    return this.$snotify.success("Los datos de tu cuenta fueron actualizados.")
                }).catch(error => {
                    if (error.status > 422) {
                        this.$snotify.error("Ocurrió un error con el siguiente mensaje: " + error.data.message)
                    }

                    return this.submitted = false
                })
        }
    }
}
</script>
