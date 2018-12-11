import * as middleware from "./middleware"
import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

const routes = [
    {
        component: require("@/router/views/Home.vue"),
        name: "Home",
        path: "/"
    },
    {
        component: require("@/router/views/Contact.vue"),
        name: "Contact",
        path: "/contact"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: require("@/router/views/auth/Login.vue"),
        meta: {
            footer: false
        },
        name: "Login",
        path: "/login"
    },
    {
        component: require("@/router/views/auth/Logout.vue"),
        meta: {
            footer: false,
        },
        name: "Logout",
        path: "/logout"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: require("@/router/views/auth/Register.vue"),
        meta: {
            footer: false
        },
        name: "Register",
        path: "/register"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: require("@/router/views/auth/passwords/Request.vue"),
        meta: {
            footer: false
        },
        name: "PasswordRequest",
        path: "/password/request"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: require("@/router/views/auth/passwords/Reset.vue"),
        meta: {
            footer: false
        },
        name: "PasswordReset",
        path: "/password/reset/:token"
    },
]

export default new VueRouter({
    history: true,
    mode: "history",
    routes
})
