import { strLimit } from "@/utilities/helpers"

export default {
    isAdmin (state) {
        return state.user.roles.map(item => item["slug"]).includes("admin")
    },

    isAuthenticated (state) {
        return !!state.user
    },

    username (state) {
        return state.user && undefined !== state.user.email ? strLimit(state.user.email) : "..."
    }
}
