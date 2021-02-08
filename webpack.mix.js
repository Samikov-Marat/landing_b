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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.combine([
    'public/universal2/assets/vendor/jquery.min.js',
    'public/universal2/assets/vendor/owl.carousel.min.js',
    'public/universal2/assets/vendor/jquery.autocomplete.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/app.js',
    'resources/js/universal2/faq.js',
    'resources/js/universal2/how_it_works.js'
], 'public/universal2/new.js').version();

