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

export const photosComputed = {
    ...mapState(
        "photos", {
            allPhotos: state => state.all,
            onePhoto: state => state.one,
            photosFeatured: state => state.featured,
            photosNonFeatured: state => state.nonFeatured
        }
    ),
}

export const photosMethods = {
    ...mapActions(
        "photos", [
            "deleteOnePhoto",
            "fetchAllPhotos",
            "fetchOnePhoto"
        ]
    )
}
