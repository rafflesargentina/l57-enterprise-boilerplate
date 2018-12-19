<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
  <div>
    <div class="card card-default">
      <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span>
            Tokens de Clientes OAUTH
          </span>

          <a
            class="action-link"
            tabindex="-1"
            @click="showCreateClientForm"
          >
            <span class="fa fa-plus pr-2" />Crear Nuevo
          </a>
        </div>
      </div>

      <div class="card-body">
        <!-- Current Clients -->
        <p
          v-if="clients.length === 0"
          class="mb-0"
        >
          No hay creado ningun cliente OAUTH para tu usuario.
        </p>

        <table
          v-if="clients.length > 0"
          class="table table-borderless mb-0"
        >
          <thead>
            <tr>
              <th>Id.</th>
              <th>Nombre</th>
              <th>Secreto</th>
              <th />
              <th />
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="client in clients"
              :key="client.id"
            >
              <!-- ID -->
              <td style="vertical-align: middle;">
                {{ client.id }}
              </td>

              <!-- Name -->
              <td style="vertical-align: middle;">
                {{ client.name }}
              </td>

              <!-- Secret -->
              <td style="vertical-align: middle;">
                <code>{{ client.secret }}</code>
              </td>

              <!-- Edit Button -->
              <td style="vertical-align: middle;">
                <a
                  class="action-link"
                  tabindex="-1"
                  @click="edit(client)"
                >
                  <span class="fa fa-pencil pr-2" />Editar
                </a>
              </td>

              <!-- Delete Button -->
              <td style="vertical-align: middle;">
                <a
                  class="action-link text-danger"
                  @click="destroy(client)"
                >
                  <span class="fa fa-trash pr-2" />Borrar
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Create Client Modal -->
    <div
      id="modal-create-client"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Nuevo Cliente OAUTH
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
              v-if="createForm.errors.length > 0"
              class="alert alert-danger"
            >
              <p class="mb-0">
                <strong>Ocurrió un error con el siguiente mensaje:</strong>
              </p>
              <br>
              <ul>
                <li
                  v-for="error in createForm.errors"
                  :key="error.id"
                >
                  {{ error }}
                </li>
              </ul>
            </div>

            <!-- Create Client Form -->
            <form role="form">
              <!-- Name -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label">
                  Name
                </label>

                <div class="col-md-9">
                  <input
                    id="create-client-name"
                    v-model="createForm.name"
                    type="text"
                    class="form-control"
                    @keyup.enter="store"
                  >

                  <span class="form-text text-muted">
                    Algo que tus usuarios reconozcan y en lo que puedan confiar.
                  </span>
                </div>
              </div>

              <!-- Redirect URL -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label">
                  URL de redireccionamiento
                </label>

                <div class="col-md-9">
                  <input
                    v-model="createForm.redirect"
                    type="text"
                    class="form-control"
                    name="redirect"
                    @keyup.enter="store"
                  >

                  <span class="form-text text-muted">
                    La URL callback de autorización de tu aplicación.
                  </span>
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

    <!-- Edit Client Modal -->
    <div
      id="modal-edit-client"
      class="modal fade"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Editar Cliente OAUTH
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
              v-if="editForm.errors.length > 0"
              class="alert alert-danger"
            >
              <p class="mb-0">
                <strong>Ocurrió un error con el siguiente mensaje:</strong>
              </p>
              <br>
              <ul>
                <li
                  v-for="error in editForm.errors"
                  :key="error.id"
                >
                  {{ error }}
                </li>
              </ul>
            </div>

            <!-- Edit Client Form -->
            <form role="form">
              <!-- Name -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label">
                  Nombre
                </label>

                <div class="col-md-9">
                  <input
                    id="edit-client-name"
                    v-model="editForm.name"
                    type="text"
                    class="form-control"
                    @keyup.enter="update"
                  >

                  <span class="form-text text-muted">
                    Algo que tus usuarios reconozcan y en lo que puedan confiar.
                  </span>
                </div>
              </div>

              <!-- Redirect URL -->
              <div class="form-group row">
                <label class="col-md-3 col-form-label">
                  URL de redireccionamiento
                </label>

                <div class="col-md-9">
                  <input
                    v-model="editForm.redirect"
                    type="text"
                    class="form-control"
                    name="redirect"
                    @keyup.enter="update"
                  >

                  <span class="form-text text-muted">
                    La URL callback de autorización de tu aplicación.
                  </span>
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
              @click="update"
            >
              <span class="fa fa-check pr-2" />Actualizar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"
import { flatten, toArray } from "lodash"

export default {
    /*
         * The component's data.
         */
    data() {
        return {
            clients: [],

            createForm: {
                errors: [],
                name: "",
                redirect: ""
            },

            editForm: {
                errors: [],
                name: "",
                redirect: ""
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
            this.getClients()

            let body = document.querySelector("body"),
                modalEditClient = document.querySelector("#modal-edit-client"),
                modalCreateClient = document.querySelector("#modal-create-client")

            body.appendChild(modalEditClient)
            body.appendChild(modalCreateClient)

            window.$("#modal-create-client").on("shown.bs.modal", () => {
                window.$("#create-client-name").focus()
            })

            window.$("#modal-edit-client").on("shown.bs.modal", () => {
                window.$("#edit-client-name").focus()
            })
        },

        /**
             * Get all of the OAuth clients for the user.
             */
        getClients() {
            axios.get("/oauth/clients")
                .then(response => {
                    return this.clients = response.data
                })
                .catch(error => console.error(error))
        },

        /**
             * Show the form for creating new clients.
             */
        showCreateClientForm() {
            window.$("#modal-create-client").modal("show")
        },

        /**
             * Create a new OAuth client for the user.
             */
        store() {
            this.persistClient(
                "post", "/oauth/clients",
                this.createForm, "#modal-create-client"
            )
        },

        /**
             * Edit the given client.
             */
        edit(client) {
            this.editForm.id = client.id
            this.editForm.name = client.name
            this.editForm.redirect = client.redirect

            window.$("#modal-edit-client").modal("show")
        },

        /**
             * Update the client being edited.
             */
        update() {
            this.persistClient(
                "put", "/oauth/clients/" + this.editForm.id,
                this.editForm, "#modal-edit-client"
            )
        },

        /**
             * Persist the client to storage using the given form.
             */
        persistClient(method, uri, form, modal) {
            form.errors = []

            axios[method](uri, form)
                .then(()=> {
                    this.getClients()

                    form.name = ""
                    form.redirect = ""
                    form.errors = []

                    return window.$(modal).modal("hide")
                })
                .catch(error => {
                    if (typeof error.response.data === "object") {
                        form.errors = flatten(toArray(error.response.data.errors))
                    } else {
                        form.errors = ["Something went wrong. Please try again."]
                    }
                })
        },

        /**
             * Destroy the given client.
             */
        destroy(client) {
            axios.delete("/oauth/clients/" + client.id)
                .then(()=> {
                    return this.getClients()
                })
                .catch(error => console.error(error))
        }
    }
}
</script>
