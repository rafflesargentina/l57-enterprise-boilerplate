
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
    //el: "#app",
    render: (h) => h(require("./App.vue")),
    router,
    store
}).$mount("#app")

export default app
