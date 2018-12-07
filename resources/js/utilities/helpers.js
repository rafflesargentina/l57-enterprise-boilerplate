
export function deleteSavedState(key) {
    window.localStorage.removeItem(key)
    window.sessionStorage.removeItem(key)
}

export function getSavedState(key) {
    var local = window.localStorage.getItem(key)
    var session = window.sessionStorage.getItem(key)

    if (local) {
        return JSON.parse(local)
    }

    if (session) {
        return JSON.parse(session)
    }

    return null
}

export function saveState(key, state, remember) {
    if (remember) {
        window.localStorage.setItem(key, JSON.stringify(state))
    } else {
        window.sessionStorage.setItem(key, JSON.stringify(state))
    }
}

export function strLimit(value = "", limit = 30, end = "...") {
    return null !== value && value.length > limit ? value.substr(0, (limit - value.length)) + end : value
}
