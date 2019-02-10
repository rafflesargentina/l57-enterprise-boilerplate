import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState() {
    return {
        all: [],
        browserUsage: [],
        count: [],
        deviceUsage: [],
        deviceTypeUsage: [],
        geoUsage: [],
        platformUsage: [],
    }
}

export const state = {
    initialState: initialState(),
    ...initialState()
}

export default {
    actions,
    getters,
    mutations,
    state
}
