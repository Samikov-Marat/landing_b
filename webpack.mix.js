const mix = require('laravel-mix');

mix.combine([
    'public/universal2/assets/vendor/jquery.min.js',
    'public/universal2/assets/vendor/owl.carousel.min.js',
    'public/universal2/assets/vendor/jquery.autocomplete.js',
    'resources/js/universal2/app.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/calculator.js',
    'resources/js/universal2/faq.js',
    'resources/js/universal2/how_it_works.js',
    'resources/js/universal2/map.js'
], 'public/universal2/new.js').version();

mix.combine([
    'public/personal/assets/vendor/jquery.min.js',
    'public/personal/assets/vendor/owl.carousel.min.js',
    'public/personal/assets/vendor/jquery.autocomplete.js',
    'resources/js/personal/app.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/calculator.js',
], 'public/personal/new.js').version();


mix.copy('resources/css/universal2/app.css', 'public/universal2/app.css').version();
mix.copy('resources/css/universal2/custom.css', 'public/universal2/custom.css').version();

mix.copy('vendor/almasaeed2010/adminlte/plugins/select2/', 'public/admin_files/select2').version();

mix.combine([
    "resources/js/admin_files/admin.js",
    "resources/js/admin_files/texts.js",
    "resources/js/admin_files/permissions.js",
    "resources/js/admin_files/pages.js",
    "resources/js/admin_files/local_offices.js",
    "resources/js/admin_files/top_offices.js",
], 'public/admin_files/new_admin.js').version();

