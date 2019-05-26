import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        one: {
            address: {},
            avatar: {},
            contact: {},
            email: "",
            first_name: "",
            last_name: "",
            password: "",
            photos: [],
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
