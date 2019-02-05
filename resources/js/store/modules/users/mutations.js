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

    [types.USERS_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.USERS_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    }
}
