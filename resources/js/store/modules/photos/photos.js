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
            alt: "",
            description: "",
            location: "",
            name: "",
            slug: "",
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
