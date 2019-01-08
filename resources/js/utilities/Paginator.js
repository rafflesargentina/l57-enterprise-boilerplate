import { size, slice } from "lodash"

class Paginator {
    /**
     * Create a new Paginator instance.
     *
     * @param {array} items
     * @param int perPage
     * @param int currentPage
     */
    constructor (items, perPage = 12, currentPage = null) {
        this.items = items
        this.paginationItems = []
        this.perPage = perPage

        this.setCurrentPage(currentPage)
    }

    /**
     * Get the items total count.
     */
    get count () {
        return size(this.items)
    }

    /**
     * Get the current page first item number.
     */
    get from () {
        return size(this.items) > 0 ? this.offsetCurrentPage() * this.perPage + 1 : 0
    }

    /**
     * Get the last page number.
     */
    get lastPage () {
        return Math.max(Math.ceil(this.total / this.perPage), 1)
    }

    /**
     * Get the current page last item number.
     */
    get to () {
        return size(this.items) > 0 ? this.from + this.count - 1 : 0
    }

    /**
     * Get the pagination items total count.
     */
    get total () {
        return size(this.items)
    }

    /**
     * Get the offset index for the current page.
     */
    offsetCurrentPage () {
        return this.currentPage > 0 ? this.currentPage - 1 : 0
    }

    /**
     * Get the offset end for the slice.
     */
    offsetEnd () {
        return this.offsetStart() + this.perPage
    }

    /**
     * Get the offset start for the slice.
     */
    offsetStart () {
        return this.offsetCurrentPage() * this.perPage
    }

    /**
     * Set the current page.
     */
    setCurrentPage (currentPage) {
        this.currentPage = currentPage || 1

        this.setPaginationItems()
    }

    /**
     * Set the pagination items.
     */
    setPaginationItems () {
        this.paginationItems = slice(this.items, this.offsetStart(), this.offsetEnd())
    }
}

export default Paginator
