import app from "@/app"

export function destroyRecord(url, id, toast) {
    app.$snotify.async("Borrando registro...", ()=> new Promise((resolve, reject)=> {
        window.axios.delete(url)
            .then(()=> {
                return resolve({
                    body: "El registro nº " + id + " fue borrado.",
                    config: {
                        closeOnClick: true,
                        timeout: 2000,
                        type: "success",
                    }
                })
            })
            .catch(error => {
                return reject({
                    body: "Ocurrió un error con el siguiente mensaje: " + error.data.message,
                    config: {
                        closeOnClick: true,
                        timeout: 2000,
                        type: "error",
                    }
                })
            })
        })
    )

    app.$snotify.remove(toast.id)
}

export function destroyRecordConfirmation(url, id) {
    return new Promise((resolve, reject) => {
        app.$snotify.confirm("¿Estás seguro de borrar el registro nº " + id + "?", "Atención", {
            buttons: [
                {
                    text: "Sí, deseo borrar el registro",
                    bold: true,
                    action: (toast)=> resolve(destroyRecord(url, id, toast))
                },
                {
                    text: "No. Cancelar",
                    action: (toast)=> (app.$snotify.remove(toast.id), reject)
                }
            ]
        })
    })
}
