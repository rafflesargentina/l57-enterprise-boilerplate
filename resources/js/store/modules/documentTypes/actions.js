import * as types from "../../mutation-types"

export default {
    deleteOneDocumentType ({ commit }, id) {
        return window.axios.delete("/api/document-types/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.DOCUMENT_TYPES_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                commit(types.DOCUMENT_TYPES_ERROR, error)
                return error
            })
    },

    fetchAllDocumentTypes ({ commit }, params) {
        commit(types.DOCUMENT_TYPES_FETCH_ALL_PENDING, true)

        return window.axios.get("/api/document-types", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.DOCUMENT_TYPES_FETCH_ALL, all)
                commit(types.DOCUMENT_TYPES_FETCH_ALL_PENDING, false)
                return all
            })
            .catch(error => {
                commit(types.DOCUMENT_TYPES_ERROR, error)
                commit(types.DOCUMENT_TYPES_FETCH_ALL_PENDING, false)
                return error
            })
    },

    fetchOneDocumentType ({ commit }, id) {
        commit(types.DOCUMENT_TYPES_FETCH_ONE_PENDING, true)

        return window.axios.get("/api/document-types/" + id)
            .then(response => {
                const one = response.data
                commit(types.DOCUMENT_TYPES_FETCH_ONE, one)
                commit(types.DOCUMENT_TYPES_FETCH_ONE_PENDING, false)
                return one
            })
            .catch(error => {
                commit(types.DOCUMENT_TYPES_ERROR, error)
                commit(types.DOCUMENT_TYPES_FETCH_ONE_PENDING, false)
                return error
            })
    },

    reset ({ commit }) {
        commit(types.DOCUMENT_TYPES_RESET)
        return null
    }
}
