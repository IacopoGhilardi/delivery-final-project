const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
<<<<<<< HEAD
    .sass('resources/sass/adminLayout.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
=======
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/guestMainLayout.scss', 'public/css')
    .sass('resources/sass/homepageGuest.scss', 'public/css');
>>>>>>> guests-routes
