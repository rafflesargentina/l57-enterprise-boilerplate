import * as types from "../../mutation-types"
import { initialState } from "./users"

export default {
    [types.USERS_DELETE_ONE] () {},

    [types.USERS_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.USERS_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.USERS_FETCH_ALL_PENDING] (state, payload) {
        state.allPending = payload
    },

    [types.USERS_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.USERS_FETCH_ONE_PENDING] (state, payload) {
        state.onePending = payload 
    },

    [types.USERS_ONE_PERMISSION_MAP_TAGS] (state, payload) {
        state.onePermissionMappedTags = payload
    },

    [types.USERS_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    },

    [types.USERS_ONE_ROLE_MAP_TAGS] (state, payload) {
        state.oneRoleMappedTags = payload
    },
}
