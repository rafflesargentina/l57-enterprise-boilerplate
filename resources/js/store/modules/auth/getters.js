import { strLimit } from "@/utilities/helpers"

export default {
    isAuthenticated (state) {
        return !!state.user
    },

    user (state) {
        return state.user
    },

    username (state) {
        return state.user && undefined !== state.user.email ? strLimit(state.user.email) : "..."
    }
}
