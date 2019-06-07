import actions from "./actions"
import getters from "./getters"
import mutations from "./mutations"

export function initialState()
{
    return {
        all: [],
        allPending: false,
        one: {
            address: {
                country: "",
                door_number: "",
                floor_number: "",
                locality: "",
                state: "",
                street_name: "",
                street_number: "",
                sublocality: "",
                zip: "",
            },
            avatar: {},
            contact: {
                email: "",
                fax: "",
                mobile: "",
                phone: "",
                position: "",
                website: "",
            },
            email: "",
            first_name: "",
            last_name: "",
            password: "",
            photos: [],
            slug: "",
        },
        onePending: false,
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
