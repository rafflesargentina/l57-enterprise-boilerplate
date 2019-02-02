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
                console.error(error)
                commit(types.DOCUMENT_TYPES_ERROR, error)
                return error
            })
    },

    fetchAllDocumentTypes ({ commit, dispatch }) {
        return window.axios.get("/api/document-types")
            .then(response => {
                const all = response.data.data
                commit(types.DOCUMENT_TYPES_FETCH_ALL, all)
                return all
            })
            .catch(error => {
                console.log(error)
                commit(types.DOCUMENT_TYPES_ERROR, error)
                return error
            })
    },

    fetchOneDocumentType ({ commit }, id) {
        return window.axios.get("/api/document-types/" + id)
            .then(response => {
                const one = response.data
                commit(types.DOCUMENT_TYPES_FETCH_ONE, one)
                return one
            })
            .catch(error => {
                commit(types.DOCUMENT_TYPES_ERROR, error)
                return error
            })
    },

    reset ({ commit }) {
        commit(types.DOCUMENT_TYPES_RESET)
        return null
    }
}
