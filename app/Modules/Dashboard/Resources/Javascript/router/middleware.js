import store from "@/store"

export const canAccessDashboard = (to, from, next) => {
    var user = store.state.auth.user
    if (store.getters["auth/isAuthenticated"] && user.roles.map(item => item["slug"]).includes("admin")) {
        return next()
    }

    return next({ name: "Unauthorized"})
}
