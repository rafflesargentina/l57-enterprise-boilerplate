import * as types from "../../mutation-types"
import { initialState } from "./documentTypes"

export default {
    [types.DOCUMENT_TYPES_DELETE_ONE] () {},

    [types.DOCUMENT_TYPES_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.DOCUMENT_TYPES_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.DOCUMENT_TYPES_FETCH_ALL_PENDING] (state, payload) {
        state.allPending = payload
    },

    [types.DOCUMENT_TYPES_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.DOCUMENT_TYPES_FETCH_ONE_PENDING] (state, payload) {
        state.onePending = payload
    },

    [types.DOCUMENT_TYPES_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    }
}
