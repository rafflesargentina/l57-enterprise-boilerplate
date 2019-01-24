import * as types from "../../mutation-types"
import { initialState } from "./photos"

export default {
    [types.PHOTOS_DELETE_ONE] () {},

    [types.PHOTOS_ERROR] (state, payload) {
        state.error = JSON.stringify(payload)
    },

    [types.PHOTOS_FEATURED] (state, payload) {
        state.featured = payload
    },

    [types.PHOTOS_FETCH_ALL] (state, payload) {
        state.all = payload
    },

    [types.PHOTOS_FETCH_ONE] (state, payload) {
        state.one = Object.freeze(payload)
    },

    [types.PHOTOS_NON_FEATURED] (state, payload) {
        state.nonFeatured = payload
    },

    [types.PHOTOS_RESET] (state) {
        Object.assign(state, { initialState: initialState(), ...initialState() })
    }
}
