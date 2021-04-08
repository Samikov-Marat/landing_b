const mix = require('laravel-mix');

mix.combine([
    'public/universal2/assets/vendor/jquery.min.js',
    'public/universal2/assets/vendor/owl.carousel.min.js',
    'public/universal2/assets/vendor/jquery.autocomplete.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/app.js',
    'resources/js/universal2/faq.js',
    'resources/js/universal2/how_it_works.js',
    'resources/js/universal2/map.js'
], 'public/universal2/new.js').version();


mix.copy('resources/css/universal2/app.css', 'public/universal2/app.css');
mix.copy('resources/css/universal2/custom.css', 'public/universal2/custom.css');

