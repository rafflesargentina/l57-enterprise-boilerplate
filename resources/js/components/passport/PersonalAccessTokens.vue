<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
  <div>
    <div>
      <div class="card card-default">
        <div class="card-header">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>
              Tokens Personales
            </span>

            <a
              class="action-link"
              tabindex="-1"
              @click="showCreateTokenForm"
            >
              <span class="fa fa-plus pr-2" />Crear Nuevo
            </a>
          </div>
        </div>

        <div class="card-body">
          <!-- No Tokens Notice -->
          <p
            v-if="tokens.length === 0"
            class="mb-0"
          >
            No hay creado ningun token de acceso personal para tu usuario.
          </p>

          <!-- Personal Access Tokens -->
          <table
            v-if="tokens.length > 0"
            class="table table-borderless mb-0"
          >
            <thead>
              <tr>
                <th>Nombre</th>
                <th />
              </tr>
            </thead>

            <tbody>
              <tr
                v-for="token in tokens"
                :key="token.id"
              >
                <!-- Client Name -->
                <td style="vertical-align: middle;">
                  {{ token.name }}
                </td>

                <!-- Delete Button -->
                <td style="vertical-align: middle;">
                  <a
                    class="action-link text-danger"
                    @click="revoke(token)"
                  >
                    <span class="fa fa-trash pr-2" />Borrar
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Create Token Modal -->
    <div
      id="modal-create-token"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Nuevo Token de Acceso Personal
            </h4>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              &times;
            </button>
          </div>

          <div class="modal-body">
            <!-- Form Errors -->
            <div
              v-if="form.errors.length > 0"
              class="alert alert-danger"
            >
              <p class="mb-0">
                <strong>Ocurrió un error con el siguiente mensaje:</strong>
              </p>
              <ul>
                <li
                  v-for="error in form.errors"
                  :key="error.id"
                >
                  {{ error }}
                </li>
              </ul>
            </div>

            <!-- Create Token Form -->
            <form
              role="form"
              @submit.prevent="store"
            >
              <!-- Name -->
              <div class="form-group row">
                <label class="col-md-4 col-form-label">
                  Nombre
                </label>

                <div class="col-md-6">
                  <input
                    id="create-token-name"
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    name="name"
                  >
                </div>
              </div>

              <!-- Scopes -->
              <div
                v-if="scopes.length > 0"
                class="form-group row"
              >
                <label class="col-md-4 col-form-label">
                  Alcances
                </label>

                <div class="col-md-6">
                  <div
                    v-for="scope in scopes"
                    :key="scope.id"
                  >
                    <div class="checkbox">
                      <label>
                        <input
                          type="checkbox"
                          :checked="scopeIsAssigned(scope.id)"
                          @click="toggleScope(scope.id)"
                        >

                        {{ scope.id }}
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal Actions -->
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              <span class="fa fa-times pr-2" />Cancelar
            </button>

            <button
              type="button"
              class="btn btn-primary"
              @click="store"
            >
              <span class="fa fa-check pr-2" />Crear
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Access Token Modal -->
    <div
      id="modal-access-token"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Token de Acceso Personal
            </h4>

            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              &times;
            </button>
          </div>

          <div class="modal-body">
            <p>
              Este es tu nuevo token de acceso personal. Esta va a ser la única vez que se muestre ¡así que no lo pierdas!
              Ahora podés usar este token para realizar solicitudes API.
            </p>

            <textarea
              v-model="accessToken"
              class="form-control"
              rows="10"
            />
          </div>

          <!-- Modal Actions -->
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              <span class="fa fa-times pr-2" />Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"
import { flatten, indexOf, reject, toArray } from "lodash"

export default {
    /*
         * The component's data.
         */
    data() {
        return {
            accessToken: null,

            tokens: [],
            scopes: [],

            form: {
                name: "",
                scopes: [],
                errors: []
            }
        }
    },

    /**
         * Prepare the component (Vue 1.x).
         */
    ready() {
        this.prepareComponent()
    },

    /**
         * Prepare the component (Vue 2.x).
         */
    mounted() {
        this.prepareComponent()
    },

    methods: {
        /**
             * Prepare the component.
             */
        prepareComponent() {
            this.getTokens()
            this.getScopes()

            let body = document.querySelector("body"),
                modalAccessToken = document.querySelector("#modal-access-token"),
                modalCreateToken = document.querySelector("#modal-create-token")

            body.appendChild(modalAccessToken)
            body.appendChild(modalCreateToken)

            window.$("#modal-create-token").on("shown.bs.modal", () => {
                window.$("#create-token-name").focus()
            })
        },

        /**
             * Get all of the personal access tokens for the user.
             */
        getTokens() {
            axios.get("/oauth/personal-access-tokens")
                .then(response => {
                    return this.tokens = response.data
                })
                .catch(error => console.error(error))
        },

        /**
             * Get all of the available scopes.
             */
        getScopes() {
            axios.get("/oauth/scopes")
                .then(response => {
                    return this.scopes = response.data
                })
                .catch(error => console.error(error))
        },

        /**
             * Show the form for creating new tokens.
             */
        showCreateTokenForm() {
            window.$("#modal-create-token").modal("show")
        },

        /**
             * Create a new personal access token.
             */
        store() {
            this.accessToken = null

            this.form.errors = []

            axios.post("/oauth/personal-access-tokens", this.form)
                .then(response => {
                    this.form.name = ""
                    this.form.scopes = []
                    this.form.errors = []

                    this.tokens.push(response.data.token)

                    return this.showAccessToken(response.data.accessToken)
                })
                .catch(error => {
                    if (typeof error.response.data === "object") {
                        this.form.errors = flatten(toArray(error.response.data.errors))
                    } else {
                        this.form.errors = ["Something went wrong. Please try again."]
                    }
                })
        },

        /**
             * Toggle the given scope in the list of assigned scopes.
             */
        toggleScope(scope) {
            if (this.scopeIsAssigned(scope)) {
                this.form.scopes = reject(this.form.scopes, s => s == scope)
            } else {
                this.form.scopes.push(scope)
            }
        },

        /**
             * Determine if the given scope has been assigned to the token.
             */
        scopeIsAssigned(scope) {
            return indexOf(this.form.scopes, scope) >= 0
        },

        /**
             * Show the given access token to the user.
             */
        showAccessToken(accessToken) {
            window.$("#modal-create-token").modal("hide")

            this.accessToken = accessToken

            window.$("#modal-access-token").modal("show")
        },

        /**
             * Revoke the given token.
             */
        revoke(token) {
            axios.delete("/oauth/personal-access-tokens/" + token.id)
                .then(()=> {
                    return this.getTokens()
                })
                .catch(error => console.error(error))
        }
    }
}
</script>
