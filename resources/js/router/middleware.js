import store from "@/store"

export const authRequired = (to, from, next) => {
    if (store.getters["auth/isAuthenticated"]) {
        return next()
    }

    var intended = to.fullpath !== "/logout" ? to.fullPath : "/"
    return next({name: "Login", query: { intended: encodeURI(intended) }})

}

export const authNotRequired = (to, from, next) => {
    if (!store.getters["auth/isAuthenticated"]) {
        return next()
    }

    return next({ name: "Home"})
}
