<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
  <div>
    <div class="card card-default">
      <div class="card-header">
        Tokens de Clientes Autorizados
      </div>

      <div class="card-body">
        <!-- No Tokens Notice -->
        <p
          v-if="tokens.length === 0"
          class="mb-0"
        >
          No se encontraron tokens de clientes autorizados para tu usuario.
        </p>

        <!-- Authorized Tokens -->
        <table
          v-if="tokens.length > 0"
          class="table table-borderless mb-0"
        >
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Alcances</th>
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
                {{ token.client.name }}
              </td>

              <!-- Scopes -->
              <td style="vertical-align: middle;">
                <span v-if="token.scopes.length > 0">
                  {{ token.scopes.join(', ') }}
                </span>
              </td>

              <!-- Revoke Button -->
              <td style="vertical-align: middle;">
                <a
                  class="action-link text-danger"
                  @click="revoke(token)"
                >
                  <span class="fa fa-trash pr-2" />Revocar
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"

export default {
    /*
         * The component's data.
         */
    data() {
        return {
            tokens: []
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
             * Prepare the component (Vue 2.x).
             */
        prepareComponent() {
            this.getTokens()
        },

        /**
             * Get all of the authorized tokens for the user.
             */
        getTokens() {
            axios.get("/oauth/tokens")
                .then(response => {
                    return this.tokens = response.data
                })
                .catch(error => console.error(error))
        },

        /**
             * Revoke the given token.
             */
        revoke(token) {
            axios.delete("/oauth/tokens/" + token.id)
                .then(()=> {
                    return this.getTokens()
                })
                .catch(error => console.error(error))
        }
    }
}
</script>
