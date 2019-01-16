import { filter, map } from "lodash"

export function deleteSavedState(key) {
    window.localStorage.removeItem(key)
    window.sessionStorage.removeItem(key)
}

export function filterTags(tags, query) {
    return filter(tags, tag => new RegExp(query, "i").test(tag.text))
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

export function mapTags(tags, id = "id", text = "name") {
    return map(tags, (tag)=> {
        return { id: tag[id], text: tag[text] }
    })
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

export function slugify(text) {
    var slug = ""
    // Change to lower case
    var lower = text.toLowerCase()
    // Letter "e"
    slug = lower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, "e")
    // Letter "a"
    slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, "a")
    // Letter "o"
    slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, "o")
    // Letter "u"
    slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, "u")
    // Trim the last whitespace
    slug = slug.replace(/\s*$/g, "")
    // Change whitespace to "-"
    slug = slug.replace(/\s+/g, "-")
    // Replace multiple - with single -
    slug = slug.replace(/--+/g, "-")
    // Replace @ with "at"
    slug = slug.replace(/@/g, "-at-")
    // Replace & with "and"
    slug = slug.replace(/&/g, "-and-")
    // Remove all non-word chars
    slug = slug.replace(/[^\w-]+/g, "")

    return slug
}

export function strLimit(value = "", limit = 30, end = "...") {
    return null !== value && value.length > limit ? value.substr(0, (limit - value.length)) + end : value
}
