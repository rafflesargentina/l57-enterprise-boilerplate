import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState() {
    return {
        active: {},
        all: [],
        count: 0,
        created: [],
        error: {},
        scopesAll: [],
        scopeMappedTags: [],
        one: {
            email: "",
            first_name: "",
            last_name: "",
            password: ""
        }
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
