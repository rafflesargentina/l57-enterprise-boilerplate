import { strLimit } from "@/utilities/helpers"

export default {
    investments (state) {
        var user = state.user
        if (user) {
            var investments = user.investments
            if (investments) {
                return investments.map(item => item["id"])
            }
        }

        return []
    },

    isAdmin (state) {
        var user = state.user
        if (user) {
            var roles = user.roles
            if (roles) {
                return roles.map(item => item["slug"]).includes("admin")
            }
        }

        return false
    },

    isAuthenticated (state) {
        return !!state.user
    },

    username (state) {
        return state.user && undefined !== state.user.email ? strLimit(state.user.email) : "..."
    }
}
