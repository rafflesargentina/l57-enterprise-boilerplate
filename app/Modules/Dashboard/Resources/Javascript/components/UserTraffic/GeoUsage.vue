<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-md-10 mb-3">
          <div class="card-text">
            Login de Usuarios por Geolocalización
          </div>
        </div>
        <div class="col-md-2 mb-3">
          <select
            class="form-control form-control-sm"
            @change="fetchUserTrafficGeoUsage({ created_at_preset: $event.target.value })"
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
      <geo-chart :data="userTrafficGeoUsage" />
    </div>
  </div>
</template>

<script>
import { userTrafficComputed, userTrafficMethods } from "@dashboard/store/helpers"
import { DATE_RANGES } from "@dashboard/utilities/presets"

export default {
    name: "GeoUsage",

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
