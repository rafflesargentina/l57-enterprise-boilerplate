import { deleteSavedState } from "@/utilities/helpers"
import * as types from "../../mutation-types"
import axios from "axios"
import router from "@/router"

export default {
    init({ commit, dispatch, state }) {
        commit(types.AUTH_PENDING, true)
        commit(types.AUTH_TOKEN, state.token)
        return dispatch("validate")
    },

    login ({ commit, dispatch, getters }, response) {
        if (getters.isAuthenticated) return dispatch("validate")

        const token = response.data.token
        commit(types.AUTH_TOKEN, token)

        const user = response.data.user
        commit(types.AUTH_USER, user)

        commit(types.AUTH_PENDING, false)

        return response
    },

    logout ({ commit, dispatch }) {
        var redirect
        axios.post("/logout")
            .then(response => {
                redirect = response.data.redirect || "/"
                return window.location.href = redirect
            })
            .catch(error => {
                router.push({ path: redirect })

                let data = error.response.data
                commit(types.AUTH_ERROR, data)
                return data
            })

        unsetDefaultAuthHeaders()
        deleteSavedState("auth.token")
        deleteSavedState("auth.user")

        commit(types.AUTH_PENDING, false)

        return dispatch("reset")
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
                commit(types.AUTH_PENDING, false)
                return user
            })
            .catch(error => {
                dispatch("logout")

                commit(types.AUTH_ERROR, error.message || error)
                commit(types.AUTH_PENDING, false)
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
