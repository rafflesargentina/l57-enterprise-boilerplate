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

export const documentTypesComputed = {
    ...mapState(
        "documentTypes", {
            allDocumentTypes: state => state.all,
            oneDocumentType: state => state.one,
        }
    ),
}

export const documentTypesMethods = {
    ...mapActions(
        "documentTypes", [
            "deleteOneDocumentType",
            "fetchAllDocumentTypes",
            "fetchOneDocumentType"
        ]
    )
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

export const usersComputed = {
    ...mapState(
        "users", {
            allUsers: state => state.all,
            oneUser: state => state.one,
            oneUserPermissionMappedTags: state => state.onePermissionMappedTags,
            oneUserRolesMappedTags: state => state.oneRoleMappedTags,
        }
    ),
}

export const usersMethods = {
    ...mapActions(
        "users", [
            "deleteOneUser",
            "fetchAllUsers",
            "fetchOneUser",
            "mapOnePermissionTags",
            "mapOneRoleTags",
        ]
    )
}
