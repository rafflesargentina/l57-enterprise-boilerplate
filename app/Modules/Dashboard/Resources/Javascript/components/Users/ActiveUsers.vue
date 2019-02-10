<template>
  <div class="card flex-fill">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card-text">
            Usuarios Activos
          </div>
        </div>
        <div class="col-md-6 mb-3 text-right">
          <div
            v-if="usersActive['Activos']"
            class="small"
          >
            ({{ usersActive['Activos'] }} totales)
          </div>
        </div>
      </div>
      <pie-chart
        :data="usersActive"
        :donut="true"
        height="6rem"
        legend="left"
      />
    </div>
  </div>
</template>

<script>
import { usersComputed, usersMethods } from "@dashboard/store/helpers"

export default {
    name: "ActiveUsers",

    computed: {
        ...usersComputed
    },

    created() {
        return this.fetchUsersActive()
    },

    methods: {
        ...usersMethods
    }
}
</script>
