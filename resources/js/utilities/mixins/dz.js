import app from "@/app"
import { alertDzUploadProgress, alertErrorMessage, alertSuccessMessage, mapDzMockFile, previewDzThumbnailFromFile, removeDzPreviewTemplate } from "@/utilities/helpers"

export const dz = {
    computed: {
        dzDocuments() {
            if (this.$refs.dzDocuments) {
                return this.$refs.dzDocuments
            }
        },

        dzFeaturedPhoto() {
            if (this.$refs.dzFeaturedPhoto) {
                return this.$refs.dzFeaturedPhoto
            }
        },

        dzUnfeaturedPhotos() {
            if (this.$refs.dzUnfeaturedPhotos) {
                return this.$refs.dzUnfeaturedPhotos
            }
        },
    },

    methods: {
        dzDocumentsError(file, message) {
            this.submitted = false

            return alertErrorMessage("Ups...", message.message || message)
                .then(this.dzDocuments.removeFile(file))
        },

        dzDocumentsMounted(documents) {
            if (this.dzDocuments) {
                removeDzPreviewTemplate(this.dzDocuments.dropzone)

                if (documents) {
                    documents.forEach(document => {
                        return previewDzThumbnailFromFile(this.dzDocuments.dropzone, mapDzMockFile(document))
                    })

                    return documents
                }
            }
        },

        dzDocumentsRemovedFile(file) {
            if (this.isDestroying === false && file.id) {
                this.deleteOneDocument(file.id)
            }
        },

        dzDocumentsProcessQueue() {
            if (this.dzDocuments) {
                if (this.dzDocuments.getQueuedFiles().length > 0) {
                    return this.dzDocuments.processQueue()
                }

                return this.dzDocuments.$emit("vdropzone-success-multiple", "documents")
            }
        },

        dzDocumentsProcessing(file) {
            if (this.dzDocuments) {
                this.dzDocuments.setOption("url", this.url)

                return alertDzUploadProgress(file, "dz-documents-progress-bar")
                    .then(result => {
                        if (result.dismiss) {
                            return this.dzDocuments.removeFile(file)
                        }
                    })
            }
        },

        dzDocumentsUploadProgress(file, progress, bytesSent) {
            var el = document.getElementById("dz-documents-progress-bar")
            if (el) {
                var percent = Math.round(progress)
                el.innerHTML = percent + "%"
                el.dataset.valuenow = percent
                el.style.width = percent + "%"
            }
        },

        dzFeaturedPhotoError(file, message) {
            this.submitted = false 

            return alertErrorMessage("Ups...", message.message || message)
                .then(this.dzFeaturedPhoto.removeFile(file))
        },

        dzFeaturedPhotoMounted(featuredPhoto) {
            if (this.dzFeaturedPhoto) {
                if (featuredPhoto) {
                    removeDzPreviewTemplate(this.dzFeaturedPhoto.dropzone)
                    previewDzThumbnailFromFile(this.dzFeaturedPhoto.dropzone, mapDzMockFile(featuredPhoto))

                    return featuredPhoto
                }
            }
        },

        dzFeaturedPhotoProcessing(file) {
            if (this.dzFeaturedPhoto) {
                this.dzFeaturedPhoto.setOption("url", this.url)

                return alertDzUploadProgress(file, "dz-featured-photo-progress-bar")
                    .then(result => {
                        if (result.dismiss) {
                            return this.dzFeaturedPhoto.removeFile(file)
                        }
                    })
            }
        },

        dzFeaturedPhotoProcessQueue() {
            if (this.dzFeaturedPhoto) {
                if (this.dzFeaturedPhoto.getQueuedFiles().length > 0) {
                    return this.dzFeaturedPhoto.processQueue()
                }

                return this.dzFeaturedPhoto.$emit("vdropzone-success-multiple", "featured_photo")
            }
        },

        dzFeaturedPhotoRemovedFile(file) {
            if (this.isDestroying === false && file.id) {
                this.deleteOnePhoto(file.id)
            }
        },

        dzFeaturedPhotoUploadProgress(file, progress, bytesSent) {
            var el = document.getElementById("dz-featured-photo-progress-bar")
            if (el) {
                var percent = Math.round(progress)
                el.innerHTML = percent + "%"
                el.dataset.valuenow = percent
                el.style.width = percent + "%"
            }
        },

        dzUnfeaturedPhotosError(file, message) {
            this.submitted = false

            return alertErrorMessage("Ups...", message.message || message)
                .then(this.dzUnfeaturedPhotos.removeFile(file))
        },

        dzUnfeaturedPhotosMounted(unfeaturedPhotos) {
            if (this.dzUnfeaturedPhotos) {
                removeDzPreviewTemplate(this.dzUnfeaturedPhotos.dropzone)

                if (unfeaturedPhotos) {
                    unfeaturedPhotos.forEach(unfeaturedPhoto => {
                        return previewDzThumbnailFromFile(this.dzUnfeaturedPhotos.dropzone, mapDzMockFile(unfeaturedPhoto))
                    })

                    return unfeaturedPhotos
                }
            }
        },

        dzUnfeaturedPhotosProcessQueue() {
            if (this.dzUnfeaturedPhotos) {
                if (this.dzUnfeaturedPhotos.getQueuedFiles().length > 0) {
                    return this.dzUnfeaturedPhotos.processQueue()
                }

                return this.dzUnfeaturedPhotos.$emit("vdropzone-success-multiple", "unfeatured_photos")
            }
        },

        dzUnfeaturedPhotosRemovedFile(file) {
            if (this.isDestroying === false && file.id) {
                this.deleteOnePhoto(file.id)
            }
        },

        dzUnfeaturedPhotosProcessing(file) {
            if (this.dzUnfeaturedPhotos) {
                this.dzUnfeaturedPhotos.setOption("url", this.url)

                return alertDzUploadProgress(file, "dz-unfeatured-photos-progress-bar")
                    .then(result => {
                        if (result.dismiss) {
                            return this.dzFeaturedPhoto.removeFile(file)
                        }
                    })
            }
        },

        dzUnfeaturedPhotosUploadProgress(file, progress, bytesSent) {
            var el = document.getElementById("dz-unfeatured-photos-progress-bar")
            if (el) {
                var percent = Math.round(progress)
                el.innerHTML = percent + "%"
                el.dataset.valuenow = percent
                el.style.width = percent + "%"
            }
        },
    }
}
