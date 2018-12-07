import { deleteSavedState } from "@/utilities/helpers"
import * as types from "../../mutation-types"
import axios from "axios"

export default {
    init({ commit, dispatch, state }) {
        commit(types.AUTH_TOKEN, state.token)
        return dispatch("validate")
    },

    login ({ commit, dispatch, getters }, response) {
        if (getters.isAuthenticated) return dispatch("validate")

        const token = response.token
        commit(types.AUTH_TOKEN, token)

        const user = response.user
        commit(types.AUTH_USER, user)

        return response
    },

    logout () {
        unsetDefaultAuthHeaders()
        deleteSavedState("auth.token")
        deleteSavedState("auth.user")

        return true
    },

    validate ({ commit, dispatch, state }) {
        if (!state.user) return null

        return axios.get("/api/user")
            .then(response => {
                const user = response.data
                commit(types.AUTH_USER, user)
                return user
            })
            .catch(error => {
                commit(types.AUTH_ERROR, error)

                if (error.response.status === 401) {
                    return dispatch("logout")
                }

                return error
            })
    },
}

// Helpers

export function setDefaultAuthHeaders(token) {
    axios.defaults.headers.common["Authorization"] = "Bearer " + token
}

export function unsetDefaultAuthHeaders() {
    delete axios.defaults.headers.common["Authorization"]
}
