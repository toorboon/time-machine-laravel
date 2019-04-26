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
// Falls du separate js compiliert haben willst, nutze mix.js()! Zum Beispiel: mix.js('resources/js/deineDatei.js', 'public/js')

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/timeMachine.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .stylus('node_modules/flatpickr/src/style/themes/airbnb.styl', 'public/css');
