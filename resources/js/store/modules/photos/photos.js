import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        featured: [],
        nonFeatured: [],
        one: {
            location: "",
            alt: "",
            name: "",
            description: "",
        },
    }
}

const state = {
    initialState: initialState(),
    ...initialState()
}

export default {
    actions,
    getters,
    mutations,
    state
}
