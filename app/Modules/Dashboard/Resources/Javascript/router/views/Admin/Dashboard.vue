<template>
  <div>
    <div
      class="row no-gutters mb-md-4"
    >
      <div class="col-md-4 d-flex mb-3 pr-md-3">
        <NewUsers />
      </div>
      <div class="col-md-4 d-flex mb-3 pr-md-3">
        <UsersPerDay />
      </div>
      <div class="col-md-4 d-flex mb-3">
        <ActiveUsers />
      </div>
    </div>

    <ul
      id="myTab"
      class="nav nav-pills mb-3"
      role="tablist"
    >
      <li class="nav-item">
        <a
          id="users-traffic-tab"
          class="nav-link active"
          data-toggle="tab"
          href="#users-traffic"
          role="tab"
          aria-controls="users-traffic"
          aria-selected="true"
        >
          Tráfico de Usuarios
        </a>
      </li>
      <li class="nav-item">
        <a
          id="navigation-info-tab"
          class="nav-link"
          data-toggle="tab"
          href="#navigation-info"
          role="tab"
          aria-controls="navigation-info"
          aria-selected="false"
        >
          Información de navegación
        </a>
      </li>
      <li class="nav-item">
        <a
          id="geo-location-tab"
          class="nav-link"
          data-toggle="tab"
          href="#geo-location"
          role="tab"
          aria-controls="geo-location"
          aria-selected="false"
        >
          Geolocalización
        </a>
      </li>
    </ul>
    <div
      id="myTabContent"
      class="tab-content"
    >
      <div
        id="users-traffic"
        class="tab-pane fade show active"
        role="tabpanel"
        aria-labelledby="users-traffic-tab"
      >
        <UserTrafficCount />
      </div>
      <div
        id="navigation-info"
        class="tab-pane fade"
        role="tabpanel"
        aria-labelledby="navigation-info-tab"
      >
        <div class="row no-gutters">
          <div class="col-md-3 d-flex pr-3">
            <BrowserUsage />
          </div>
          <div class="col-md-3 d-flex pr-3">
            <DeviceUsage />
          </div>
          <div class="col-md-3 d-flex pr-3">
            <DeviceTypeUsage />
          </div>
          <div class="col-md-3 d-flex">
            <PlatformUsage />
          </div>
        </div>
      </div>
      <div
        id="geo-location"
        class="tab-pane fade"
        role="tabpanel"
        aria-labelledby="geo-location-tab"
      >
        <GeoUsage />
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            alreadyCreated: false
        }
    },

    created() {
        return this.prepare().then(() => this.alreadyCreated = true)
    },

    methods: {
        prepare() {
            return this.$store.dispatch("users/fetchUsersActive"),
            this.$store.dispatch("users/fetchUsersCount"),
            this.$store.dispatch("users/fetchUsersCreated"),
            this.$store.dispatch("userTraffic/fetchUserTrafficBrowserUsage"),
            this.$store.dispatch("userTraffic/fetchUserTrafficCount"),
            this.$store.dispatch("userTraffic/fetchUserTrafficDeviceUsage"),
            this.$store.dispatch("userTraffic/fetchUserTrafficDeviceTypeUsage"),
            this.$store.dispatch("userTraffic/fetchUserTrafficGeoUsage"),
            this.$store.dispatch("userTraffic/fetchUserTrafficPlatformUsage")
        }
    },
}
</script>
