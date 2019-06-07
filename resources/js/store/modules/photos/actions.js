import { filter } from "lodash"
import * as types from "../../mutation-types"

export default {
    deleteOnePhoto ({ commit }, id) {
        return window.axios.delete("/api/photos/" + id)
            .then(response => {
                const r = response.data.data
                commit(types.PHOTOS_DELETE_ONE, r)
                return r
            })
            .catch(error => {
                commit(types.PHOTOS_ERROR, error)
                return error
            })
    },

    fetchAllPhotos ({ commit, dispatch }, params) {
        commit(types.PHOTOS_FETCH_ALL_PENDING, true)

        return window.axios.get("/api/photos", { params: params })
            .then(response => {
                const all = response.data.data
                commit(types.PHOTOS_FETCH_ALL, all)
                commit(types.PHOTOS_FETCH_ALL_PENDING, false)
                dispatch("mapPhotosFeatured", all)
                dispatch("mapPhotosNonFeatured", all)
                return all
            })
            .catch(error => {
                commit(types.PHOTOS_ERROR, error)
                commit(types.PHOTOS_FETCH_ALL_PENDING, false)
                return error
            })
    },

    fetchOnePhoto ({ commit }, id) {
        commit(types.PHOTOS_FETCH_ONE_PENDING, true)

        return window.axios.get("/api/photos/" + id)
            .then(response => {
                const one = response.data
                commit(types.PHOTOS_FETCH_ONE, one)
                commit(types.PHOTOS_FETCH_ONE_PENDING, false)
                return one
            })
            .catch(error => {
                commit(types.PHOTOS_ERROR, error)
                commit(types.PHOTOS_FETCH_ONE_PENDING, false)
                return error
            })
    },

    mapPhotosFeatured({ commit, state }, all) {
        const featured = filter(all || state.all, (item)=> item.featured === 1)
        commit(types.PHOTOS_FEATURED, featured)
        return featured
    },

    mapPhotosNonFeatured({ commit, state }, all) {
        const nonFeatured = filter(all || state.all, (item)=> item.featured !== 1)
        commit(types.PHOTOS_NON_FEATURED, nonFeatured)
        return nonFeatured
    },

    reset ({ commit }) {
        commit(types.PHOTOS_RESET)
        return null
    }
}
