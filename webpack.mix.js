let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('resources/img/', 'public/img/')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/main.scss', 'public/css/app.css')

if (mix.inProduction()) {
    mix.version()
}

const path = require('path')

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js')
        }
    }
})
