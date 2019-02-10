import modules from "./modules"
import store from "@/store"

for (const module of Object.entries(modules)) {
    store.registerModule(module[0], module[1])
}

// Automatically run the `init` action for every module, if one exists.
for (const moduleName of Object.keys(modules)) {
    if (modules[moduleName].actions && modules[moduleName].actions.init) {
        store.dispatch(`${moduleName}/init`)
    }
}
