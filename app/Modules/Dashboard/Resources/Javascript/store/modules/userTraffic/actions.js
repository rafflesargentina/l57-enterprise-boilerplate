import * as types from "@dashboard/store/mutation-types"

export default {
    fetchAllUserTraffic ({ commit }, params) {
        return window.axios.get("/api/user-traffic", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_FETCH_ALL, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficBrowserUsage ({ commit }, params) {
        return window.axios.get("/api/browser-usage", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_BROWSER_USAGE, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficCount ({ commit }, params) {
        return window.axios.get("/api/user-traffic-count", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_COUNT, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficDeviceUsage ({ commit }, params) {
        return window.axios.get("/api/device-usage", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_DEVICE_USAGE, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficDeviceTypeUsage ({ commit }, params) {
        return window.axios.get("/api/device-type-usage", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_DEVICE_TYPE_USAGE, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficGeoUsage ({ commit }, params) {
        return window.axios.get("/api/geo-usage", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_GEO_USAGE, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    },

    fetchUserTrafficPlatformUsage ({ commit }, params) {
        return window.axios.get("/api/platform-usage", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USER_TRAFFIC_PLATFORM_USAGE, all)
                return all
            })
            .catch(error => {
                commit(types.USER_TRAFFIC_ERROR, error)
                return error
            })
    }
}
