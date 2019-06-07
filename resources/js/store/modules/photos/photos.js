import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        allPending: false,
        featured: [],
        nonFeatured: [],
        one: {
            alt: "",
            description: "",
            location: "",
            name: "",
            slug: "",
        },
        onePending: false,
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
