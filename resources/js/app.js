
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap")

import store from "@/store"
import router from "@/router"
import Vue from "vue"
import Snotify from "vue-snotify"

Vue.use(Snotify)

// Don't warn about using the dev version of Vue in development
Vue.config.productionTip = process.env.NODE_ENV === "production"

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split("/").pop().split(".")[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    created() {
        window.axios.interceptors.response.use(null, (error)=> {
            let code = error.response.status
            if (error.config && !error.config.__isRetryRequest) {
                if (code > 404 && code < 420) {
                    switch (code) {
                    case 419:
                        this.$snotify.info("Tu sesión expiró. Por favor volvé a ingresar con tus credenciales.")
                        break
                    default:
                        this.$snotify.error("Ocurrió un error inesperado en la sesión de tu usuario. Por favor volvé a ingresar con tus credenciales.")
                    }
                } else if (code === 500) {
                    router.push({ name: "InternalServerError" })
                }
            }

            return Promise.reject(error)
        })
    },

    //el: "#app",
    render: (h) => h(require("./App.vue")),
    router,
    store
}).$mount("#app")

export default app
