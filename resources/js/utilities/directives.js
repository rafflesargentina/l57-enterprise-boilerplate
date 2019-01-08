import Vue from "vue"
import { slugify } from "@/utilities/helpers"

Vue.directive("slugify", {
    twoWay: true,
    bind: function(el) {
        el.addEventListener("keyup", function() {
            this.value = slugify(this.value)
        })
    }
})
