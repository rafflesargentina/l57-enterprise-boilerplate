<template>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text bg-white">
        <i class="fa fa-search" />
      </span>
    </div>
    <input
      v-model="search"
      class="form-control border-left-0"
      placeholder="Búsqueda rápida..."
      type="text"
      @input="debounceFilterItems"
    >
  </div>
</template>

<script>
import { debounce, filter } from "lodash"

export default {
    name: "QuickSearch",

    props: {
        items: {
            required: true,
            type: Array
        }
    },

    data() {
        return {
            search: "",
            filteredItems: []
        }
    },

    watch: {
        items() {
            return this.filteredItems = this.items
        }
    },

    created() {
        return this.debounceFilterItems = debounce(this.filterItems, 200)
    },

    methods: {
        filterItems() {
            this.filteredItems = filter(this.items, (item)=> {
                return Object.values(item).toString().toLowerCase().indexOf(this.search.toLowerCase()) > -1
            })

            this.$emit("quick-search-results", this.filteredItems)
        }
    }
}
</script>
