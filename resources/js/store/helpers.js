import { mapActions, mapGetters, mapState } from "vuex"

export const authComputed = {
    ...mapState("auth", {
        user: state => state.user
    }),
    ...mapGetters("auth", ["isAuthenticated", "username"])
}

export const authMethods = {
    ...mapActions("auth", ["login", "logout", "validate"])
}
