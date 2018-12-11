import { initialState } from "./auth"
import { saveState } from "@/utilities/helpers"
import { setDefaultAuthHeaders } from "./actions"
import * as types from "@/store/mutation-types"

export default {
    [types.AUTH_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.AUTH_RESET] (state) {
        state = Object.assign(state, { initialState: initialState(), ...initialState() })
    },

    [types.AUTH_TOKEN] (state, payload) {
        if (payload) {
            state.token = payload
            saveState("auth.token", payload)
            setDefaultAuthHeaders(payload)
        }
    },

    [types.AUTH_USER] (state, payload) {
        if (payload) {
            state.user = payload
            saveState("auth.user", payload)
        }
    }
}
