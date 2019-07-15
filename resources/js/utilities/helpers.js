import app from "@/app"
import { filter, map } from "lodash"

export function alertDestroyRecordConfirmation(url, id) {
    return app.$swal({
        title: "¿Estás seguro?",
        html: "<p>Estás a punto de borrar el registro con id nº <strong>" + id + "</strong>.<br><strong>Esta operación no se puede revertir</strong>.</p>",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No, cancelar",
        confirmButtonText: "Sí, estoy seguro",
        showLoaderOnConfirm: true,
        preConfirm: ()=> {
            return window.axios.delete(url)
                .then(response => {
                    return response
                })
                .catch(error => {
                    return alertErrorMessage("Ups...", error.data.message||error.message)
                })
        },
        allowOutsideClick: false,
    })

        .then(result => {
            var dismiss = result.dismiss
            if (dismiss) {
                return null
            }

            return alertSuccessMessage("Hecho", "El registro nº " + id + " fue borrado.")
        })

        .catch(error => {
            return alertErrorMessage("Ups...", error.data.message||error.message)
        })
}

export function alertDzUploadProgress(file, progressBarId) {
    var html = file.previewTemplate.childNodes[1].innerHTML + "<p class=\"my-3\">Por favor no refresques o cierres la ventana en el proceso.</p><div class=\"progress\"><div class=\"progress-bar\" id=\"" + progressBarId + "\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div></div>"

    return app.$swal({
        allowOutsideClick: false,
        cancelButtonText: "Cancelar",
        html: html,
        showCancelButton: true,
        showConfirmButton: false,
        title: "Subiendo...",
    })
}

export function alertErrorMessage(title, message) {
    var html = "<p>Ocurrió un error con el siguiente mensaje:</p><div class=\"card bg-light\"><div class=\"card-body\"><p class=\"mb-0\">" + message + "</p></div></div>"

    return app.$swal({
        html: html,
        title: title,
        type: "error",
    })
}

export function alertInfoMessage(title, text) {
    return app.$swal({
        text: text,
        title: title,
        type: "info",
    })
}

export function alertSuccessMessage(title, message) {
    return app.$swal({
        text: message,
        title: title,
        type: "success",
    })
}

export function alertWarningMessage(title, text) {
    return app.$swal({
        text: text,
        title: title,
        type: "warning",
    })
}

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
        dataURL: file.thumbnail,
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

export function removeDzPreviewTemplate(dz) {
    var files = dz.files

    if (files.length > 0 ) {
        return files.forEach(file => file.previewElement.remove())
    }
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
    return null !== value && value.length > limit ? value.substr(0, (limit - end.length)) + end : value
}
