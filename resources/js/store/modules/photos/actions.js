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
                console.log(error)
                commit(types.PHOTOS_ERROR, error)
                return error
            })
    },

    fetchAllPhotos ({ commit, dispatch }) {
        return window.axios.get("/api/photos")
            .then(response => {
                const all = response.data.data
                commit(types.PHOTOS_FETCH_ALL, all)
                dispatch("mapPhotosFeatured", all)
                dispatch("mapPhotosNonFeatured", all)
                return all
            })
            .catch(error => {
                console.log(error)
                commit(types.PHOTOS_ERROR, error)
                return error
            })
    },

    fetchOnePhoto ({ commit }, id) {
        return window.axios.get("/api/photos/" + id)
            .then(response => {
                const one = response.data
                commit(types.PHOTOS_FETCH_ONE, one)
                return one
            })
            .catch(error => {
                commit(types.PHOTOS_ERROR, error)
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
