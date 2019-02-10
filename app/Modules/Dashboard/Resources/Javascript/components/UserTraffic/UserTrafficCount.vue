<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-md-10 mb-3">
          <div class="card-text">
            Login de Usuarios
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <select
            class="form-control form-control-sm"
            @change="fetchUserTrafficCount({ created_at_preset: $event.target.value })"
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
      <area-chart
        :curve="false"
        :data="userTrafficCount"
      />
    </div>
  </div>
</template>

<script>
import { userTrafficComputed, userTrafficMethods } from "@dashboard/store/helpers"
import { DATE_RANGES } from "@dashboard/utilities/presets"

export default {
    name: "UserTrafficCount",

    computed: {
        ...userTrafficComputed,

        dateRanges() {
            return DATE_RANGES
        }
    },

    methods: {
        ...userTrafficMethods
    }
}
</script>
