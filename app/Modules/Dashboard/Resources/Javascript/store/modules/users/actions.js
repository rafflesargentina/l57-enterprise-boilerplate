import * as types from "@dashboard/store/mutation-types"

export default {
    fetchUsersActive ({ commit }, params) {
        return window.axios.get("/api/users-active", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USERS_ACTIVE, all)
                return all
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                return error
            })
    },

    fetchUsersCount ({ commit }, params) {
        return window.axios.get("/api/users-count", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USERS_COUNT, all)
                return all
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                return error
            })
    },

    fetchUsersCreated ({ commit }, params) {
        return window.axios.get("/api/users-created", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.USERS_CREATED, all)
                return all
            })
            .catch(error => {
                commit(types.USERS_ERROR, error)
                return error
            })
    },
}
