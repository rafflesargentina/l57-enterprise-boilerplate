import * as types from "../../mutation-types"
import { mapTags } from "@/utilities/helpers"

export default {
    deleteOneUser ({ commit }, id) {
        return window.axios.delete("/api/users/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.USERS_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                return error
            })
    },

    fetchAllUsers ({ commit }, params) {
        commit(types.USERS_FETCH_ALL_PENDING, true)

        return window.axios.get("/api/users", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USERS_FETCH_ALL, all)
                commit(types.USERS_FETCH_ALL_PENDING, false)
                return all
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                commit(types.USERS_FETCH_ALL_PENDING, false)
                return error
            })
    },

    fetchOneUser ({ commit, dispatch }, id) {
        commit(types.USERS_FETCH_ONE_PENDING, true)

        return window.axios.get("/api/users/" + id)
            .then(response => {
                const one = response.data
                commit(types.USERS_FETCH_ONE, one)
                commit(types.USERS_FETCH_ONE_PENDING, false)
                dispatch("mapOnePermissionTags", one)
                dispatch("mapOneRoleTags", one)
                return one
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                commit(types.USERS_FETCH_ONE_PENDING, false)
                return error
            })
    },

    mapOnePermissionTags ({ commit }, one) {
        const onePermissionTags = mapTags(one.permissions)
        commit(types.USERS_ONE_PERMISSION_MAP_TAGS, onePermissionTags)
        return onePermissionTags
    },

    mapOneRoleTags ({ commit }, one) {
        const oneRoleTags = mapTags(one.roles)
        commit(types.USERS_ONE_ROLE_MAP_TAGS, oneRoleTags)
        return oneRoleTags
    },

    reset ({ commit }) {
        commit(types.USERS_RESET)
        return null
    }
}
