<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <div class="card-text">
            Usuarios por día
          </div>
        </div>
        <div class="col-md-6 mb-3 mb-md-0">
          <select
            class="form-control form-control-sm"
            @change="fetchUsersCreated({ created_at_preset: $event.target.value })"
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
    </div>
    <area-chart
      :curve="false"
      :data="usersCreated"
      :library="{scales: { xAxes: [{ display: false }], yAxes: [{ display: false }] }}"
      height="6rem"
    />
  </div>
</template>

<script>
import { usersComputed, usersMethods } from "@dashboard/store/helpers"
import { DATE_RANGES } from "@dashboard/utilities/presets"

export default {
    name: "UsersPerDay",

    computed: {
        ...usersComputed,

        dateRanges() {
            return DATE_RANGES
        }
    },

    created() {
        let params = { created_at_range: DATE_RANGES[0] }

        return this.fetchUsersCreated(params)
    },

    methods: {
        ...usersMethods
    }
}
</script>
