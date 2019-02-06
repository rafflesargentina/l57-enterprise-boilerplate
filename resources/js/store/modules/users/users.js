import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        one: {
            email: "",
            first_name: "",
            last_name: "",
            password: "",
            slug: "",
        },
        onePermissionMappedTags: [],
        oneRoleMappedTags: [],
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
