import * as middleware from "./middleware"
import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

const routes = [
    {
        children: [
            {
                beforeEnter: middleware.authRequired,
                name: "Account",
                path: "",
                component: view("Account/PersonalData"),
            },
            {
                beforeEnter: middleware.authRequired,
                name: "AuthorizedClientTokens",
                path: "/account/authorized-client-tokens",
                component: view("Account/AuthorizedClientTokens"),
            },
            {
                beforeEnter: middleware.authRequired,
                name: "PersonalTokens",
                path: "/account/personal-tokens",
                component: view("Account/PersonalTokens"),
            },
            {
                beforeEnter: middleware.authRequired,
                name: "ClientTokens",
                path: "/account/client-tokens",
                component: view("Account/TokenClients"),
            },
        ],
        component: view("Account/Account"),
        path: "/account"
    },
    {
        component: view("Home"),
        name: "Home",
        path: "/"
    },
    {
        component: view("Contact"),
        name: "Contact",
        path: "/contact"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: view("auth/Login"),
        meta: {
            footer: false
        },
        name: "Login",
        path: "/login"
    },
    {
        component: view("auth/Logout"),
        meta: {
            footer: false,
        },
        name: "Logout",
        path: "/logout"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: view("auth/Register"),
        meta: {
            footer: false
        },
        name: "Register",
        path: "/register"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: view("auth/passwords/Request"),
        meta: {
            footer: false
        },
        name: "PasswordRequest",
        path: "/password/request"
    },
    {
        beforeEnter: middleware.authNotRequired,
        component: view("auth/passwords/Reset"),
        meta: {
            footer: false
        },
        name: "PasswordReset",
        path: "/password/reset/:token"
    },
    {
        name: "InternalServerError",
        path: "/sorry",
        component: view("Errors/InternalServerError"),
    },
    {
        name: "Unauthorized",
        path: "/unauthorized",
        component: view("Errors/Unauthorized"),
    },
    {
        name: "PageNotFound",
        path: "*",
        component: view("Errors/PageNotFound"),
    },
]

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * @param {string} name The filename (basename) of the view to load.
 */
function view(name) {
    return function(resolve) {
        require(['./views/' + name + '.vue'], resolve);
    }
};

export default new VueRouter({
    history: true,
    mode: "history",
    routes
})
