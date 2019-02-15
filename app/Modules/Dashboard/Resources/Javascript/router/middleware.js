import store from "@/store"

export const canAccessDashboard = (to, from, next) => {
    if (store.getters["auth/isAuthenticated"] && store.getters["auth/isAdmin"]) {
        return next()
    }

    return next({ name: "Unauthorized"})
}
