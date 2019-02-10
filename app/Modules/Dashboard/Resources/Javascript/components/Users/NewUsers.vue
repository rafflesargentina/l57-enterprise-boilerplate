<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3 mb-md-0">
          <div class="card-text">
            Nuevos Usuarios
          </div>
        </div>
        <div class="col-6 mb-3 mb-md-0">
          <select
            class="form-control form-control-sm"
            @change="fetchUsersCount({ created_at_preset: $event.target.value })"
          >
            <option
              v-for="(value, index) in dateRanges"
              :key="index"
              :value="index"
            >
              {{ value }}
            </option>
          </select>
        </div>
      </div>
      <h1 class="display-4">
        {{ usersCount }}
      </h1>
    </div>
  </div>
</template>

<script>
import { usersComputed, usersMethods } from "@dashboard/store/helpers"
import { DATE_RANGES } from "@dashboard/utilities/presets"

export default {
    name: "NewUsers",

    computed: {
        ...usersComputed,

        dateRanges() {
            return DATE_RANGES
        }
    },

    created() {
        let params = { created_at_range: DATE_RANGES[0] }

        return this.fetchUsersCount(params)
    },

    methods: {
        ...usersMethods
    }
}
</script>
