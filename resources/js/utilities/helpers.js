import { map } from "lodash"


export function deleteSavedState(key) {
    window.localStorage.removeItem(key)
    window.sessionStorage.removeItem(key)
}

export function getSavedState(key) {
    var local = window.localStorage.getItem(key)
    var session = window.sessionStorage.getItem(key)

    try {
        if (local) {
            return JSON.parse(local)
        }

        if (session) {
            return JSON.parse(session)
        }

    // Handle malformed state.
    } catch (e) {
        return null
    }

    return null
}

export function mapDzMockFiles(files) {
    return map(files, (file)=> {
        return mapDzMockFile(file)
    })
}

export function mapDzMockFile(file) {
    return {
        id: file.id,
        accepted: true,
        dataURL: file.url,
        location: file.location,
        name: file.location,
        size: file.size
    }
}

export function previewDzThumbnailFromFile(dz, file) {
    dz.files.push(file)
    dz.emit("addedfile", file)
    dz.createThumbnailFromUrl(
        file,
        dz.options.thumbnailWidth,
        dz.options.thumbnailHeight,
        dz.options.thumbnailMethod,
        true,
        (thumbnail)=> {
            dz.emit("thumbnail", file, thumbnail)
            dz.emit("complete", file)
        }
    )
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
