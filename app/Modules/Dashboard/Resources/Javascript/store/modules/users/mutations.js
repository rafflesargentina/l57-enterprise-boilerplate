import * as types from "../../mutation-types"

export default {
    [types.USERS_ACTIVE] (state, payload) {
        state.active = payload
    },

    [types.USERS_COUNT] (state, payload) {
        state.count = payload
    },

    [types.USERS_CREATED] (state, payload) {
        state.created = payload
    },

    [types.USERS_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    }
}
