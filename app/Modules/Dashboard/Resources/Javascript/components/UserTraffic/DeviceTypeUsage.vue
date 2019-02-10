<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card-text">
            Pantallas
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <select
            class="form-control form-control-sm"
            @change="fetchUserTrafficDeviceTypeUsage({ created_at_preset: $event.target.value })"
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
      <div class="card-text small">
        Login de usuarios visualizados por pantalla utilizada.
      </div>
      <pie-chart
        :data="userTrafficDeviceTypeUsage"
        :donut="true"
        :library="libraryOptions"
        legend="bottom"
      />
    </div>
  </div>
</template>

<script>
import { userTrafficComputed, userTrafficMethods } from "@dashboard/store/helpers"
import { DATE_RANGES } from "@dashboard/utilities/presets"

export default {
    name: "DeviceTypeUsage",

    data() {
        return {
            libraryOptions: {
                circumference: Math.PI,
                rotation: -Math.PI
            }
        }
    },

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
