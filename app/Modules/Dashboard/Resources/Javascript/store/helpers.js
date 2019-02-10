import { mapActions, mapState } from "vuex"

export const usersComputed = {
    ...mapState("users", {
        usersActive: state => state.active,
        usersCount: state => state.count,
        usersCreated: state => state.created
    })
}

export const usersMethods = {
    ...mapActions("users", [
        "fetchUsersActive",
        "fetchUsersCount",
        "fetchUsersCreated"
    ])
}

export const userTrafficComputed = {
    ...mapState("userTraffic", {
        allUserTraffic: state => state.all,
        userTrafficBrowserUsage: state => state.browserUsage,
        userTrafficCount: state => state.count,
        userTrafficDeviceUsage: state => state.deviceUsage,
        userTrafficDeviceTypeUsage: state => state.deviceTypeUsage,
        userTrafficGeoUsage: state => state.geoUsage,
        userTrafficPlatformUsage: state => state.platformUsage
    })
}

export const userTrafficMethods = {
    ...mapActions("userTraffic", [
        "fetchAllUserTraffic",
        "fetchUserTrafficBrowserUsage",
        "fetchUserTrafficCount",
        "fetchUserTrafficDeviceUsage",
        "fetchUserTrafficDeviceTypeUsage",
        "fetchUserTrafficGeoUsage",
        "fetchUserTrafficPlatformUsage",
    ])
}
