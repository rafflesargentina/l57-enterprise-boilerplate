import { mapDzMockFile, previewDzThumbnailFromFile, removeDzPreviewTemplate } from "@/utilities/helpers"

export const dz = {
    data() {
        return {
            dzFeaturedPhotoHasAcceptedFiles: false,
            dzFeaturedPhotoHasError: false,
            dzUnfeaturedPhotosHasAcceptedFiles: false,
            dzUnfeaturedPhotosHasError: false,
        }
    },

    computed: {
        dzFeaturedPhoto() {
            return this.$refs.dzFeaturedPhoto
        },

        dzUnfeaturedPhotos() {
            return this.$refs.dzUnfeaturedPhotos
        },
    },

    methods: {
        dzFeaturedPhotoAddOrRemoveFiles() {
            return this.dzFeaturedPhotoHasAcceptedFiles = this.dzFeaturedPhoto.getAcceptedFiles().length > 0
        },

        dzFeaturedPhotoRemoveFile(file) {
            if (this.isDestroying === false && file.id) {
                this.dzFeaturedPhotoAddOrRemoveFiles()
            }
        },

        dzFeaturedPhotoFail() {
            return this.dzFeaturedPhotoHasError = true
        },

        dzFeaturedPhotoMounted(featuredPhoto) {
            if (this.dzFeaturedPhoto) {
                removeDzPreviewTemplate(this.dzFeaturedPhoto.dropzone)
                if (featuredPhoto) {
                    return previewDzThumbnailFromFile(this.dzFeaturedPhoto.dropzone, mapDzMockFile(featuredPhoto))
                }
            }
        },

        dzFeaturedPhotoProcessQueue() {
            if (this.dzFeaturedPhoto) {
                this.dzFeaturedPhotoHasError = false
                return Promise.resolve(this.dzFeaturedPhoto.processQueue())
            }
        },

        dzFeaturedPhotoSetUrl() {
            if (this.dzFeaturedPhoto) {
                return this.dzFeaturedPhoto.setOption("url", this.url)
            }
        },

        dzFeaturedPhotoSucceed(file, response) {
            return Promise.resolve([file, response])
        },

        dzUnfeaturedPhotosAddOrRemoveFiles() {
            return this.dzUnfeaturedPhotosHasAcceptedFiles = this.dzUnfeaturedPhotos.getAcceptedFiles().length > 0
        },

        dzUnfeaturedPhotosFail() {
            return this.dzUnfeaturedPhotosHasError = true
        },

        dzUnfeaturedPhotosMounted(unfeaturedPhotos) {
            if (this.dzUnfeaturedPhotos) {
                removeDzPreviewTemplate(this.dzUnfeaturedPhotos.dropzone)

                if (unfeaturedPhotos) {
                    return unfeaturedPhotos.forEach(unfeaturedPhoto => {
                        return previewDzThumbnailFromFile(this.dzUnfeaturedPhotos.dropzone, mapDzMockFile(unfeaturedPhoto))
                    })
                }
            }
        },

        dzUnfeaturedPhotosProcessQueue() {
            if (this.dzUnfeaturedPhotos) {
                this.dzUnfeaturedPhotosHasError = false
                return Promise.resolve(this.dzUnfeaturedPhotos.processQueue())
            }
        },

        dzUnfeaturedPhotosRemoveFile(file) {
            if (this.isDestroying === false && file.id) {
                this.deleteOnePhoto(file.id)
                this.dzUnfeaturedPhotosAddOrRemoveFiles()
            }
        },

        dzUnfeaturedPhotosSetUrl() {
            if (this.dzUnfeaturedPhotos) {
                return this.dzUnfeaturedPhotos.setOption("url", this.url)
            }
        },

        dzUnfeaturedPhotosSucceed(file, response) {
            return Promise.resolve([file, response])
        }
    }
}
