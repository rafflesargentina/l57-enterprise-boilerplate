import * as middleware from "@/router/middleware"
import { canAccessDashboard } from "./middleware"
import multiguard from "vue-router-multiguard"
import router from "@/router"

router.addRoutes(
    [
        {
            children: [
                {
                    beforeEnter: multiguard([middleware.authRequired, canAccessDashboard]),
                    meta: {
                        footer: false
                    },
                    name: "Dashboard",
                    path: "",
                    component: view("Admin/Dashboard"),
                },
            ],
            component: view("Admin/Admin"),
            meta: { footer: false },
            path: "/admin"
        },
    ]
)

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * @param {string} name The filename (basename) of the view to load.
 */
function view(name) {
    return function(resolve) {
        require(["./views/" + name + ".vue"], resolve)
    }
}
