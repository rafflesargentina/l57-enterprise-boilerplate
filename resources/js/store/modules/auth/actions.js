import { deleteSavedState } from "@/utilities/helpers"
import * as types from "../../mutation-types"
import axios from "axios"
import route from "@/router"

export default {
    init({ commit, dispatch, state }) {
        commit(types.AUTH_TOKEN, state.token)
        return dispatch("validate")
    },

    login ({ commit, dispatch, getters }, response) {
        if (getters.isAuthenticated) return dispatch("validate")

        const token = response.data.token
        commit(types.AUTH_TOKEN, token)

        const user = response.data.user
        commit(types.AUTH_USER, user)

        return response
    },

    logout ({ commit }) {
        unsetDefaultAuthHeaders()
        deleteSavedState("auth.token")
        deleteSavedState("auth.user")

        commit(types.AUTH_RESET)

        return axios.post("/logout")
            .then(response => router.push({ path: response.data.redirect }))
    },

    reset ({ commit }) {
        commit(types.AUTH_RESET)
        return null
    },

    validate ({ commit, dispatch, state }) {
        if (!state.user) return null

        return axios.get("/api/account")
            .then(response => {
                const user = response.data.data.user
                commit(types.AUTH_USER, user)
                return user
            })
            .catch(error => {
                commit(types.AUTH_ERROR, error)

                if (error.response.status === 401) {
                    dispatch("logout")
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
