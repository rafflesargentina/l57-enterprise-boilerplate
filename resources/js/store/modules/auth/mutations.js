import { saveState } from "@/utilities/helpers"
import { setDefaultAuthHeaders } from "./actions"

export default {
    AUTH_ERROR (state, payload) {
        state.error = JSON.stringify(payload)
    },

    AUTH_TOKEN (state, payload) {
        if (payload) {
            state.token = payload
            saveState("auth.token", payload)
            setDefaultAuthHeaders(payload)
        }
    },

    AUTH_USER (state, payload) {
        if (payload) {
            state.user = payload
            saveState("auth.user", payload)
        }
    }
}
