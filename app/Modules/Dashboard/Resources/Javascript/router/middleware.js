import store from "@/store"

export const canAccessDashboard = (to, from, next) => {
    var user = store.state.auth.user
    if (store.getters["auth/isAuthenticated"] && store.getters["auth/isAdmin"]) {
        return next()
    }

    return next({ name: "Unauthorized"})
}
