import * as types from "../../mutation-types"

export default {
    [types.USER_TRAFFIC_COUNT] (state, payload) {
        state.count = payload
    },

    [types.USER_TRAFFIC_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.USER_TRAFFIC_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.USER_TRAFFIC_BROWSER_USAGE] (state, payload) {
        state.browserUsage = payload
    },

    [types.USER_TRAFFIC_DEVICE_USAGE] (state, payload) {
        state.deviceUsage = payload
    },

    [types.USER_TRAFFIC_DEVICE_TYPE_USAGE] (state, payload) {
        state.deviceTypeUsage = payload
    },

    [types.USER_TRAFFIC_GEO_USAGE] (state, payload) {
        state.geoUsage = payload
    },

    [types.USER_TRAFFIC_PLATFORM_USAGE] (state, payload) {
        state.platformUsage = payload
    },
}
