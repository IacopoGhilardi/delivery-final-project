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
    .js('resources/js/cart/cart.js', 'public/js')
    .js('resources/js/cart/script.js', 'public/js')
    .js('resources/js/analitics/statistic.js', 'public/js')
    .js('resources/js/payment/success.js', 'public/js')
    .js('resources/js/homepage/burger.js', 'public/js')
    .vue({ version: 2 })
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/adminLayout.scss', 'public/css')
    .sass('resources/sass/homepageGuest.scss', 'public/css')
    .sass('resources/sass/guestMainLayout.scss', 'public/css')
    .sass('resources/sass/dishLayout.scss', 'public/css')
    .sass('resources/sass/dishCreateLayout.scss', 'public/css')
    .sass('resources/sass/restaurantShow.scss', 'public/css')
    .sass('resources/sass/guestRestaurant.scss', 'public/css')
    .sass('resources/sass/loginRegisterLayout.scss', 'public/css')
    .sass('resources/sass/paymentLayout.scss', 'public/css')
    .sass('resources/sass/hosted.scss', 'public/css')
    .sass('resources/sass/success.scss', 'public/css')
    .sass('resources/sass/statistic.scss', 'public/css')   
    .sass('resources/sass/adminRestaurantIndex.scss', 'public/css');
    
