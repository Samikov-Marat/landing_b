const mix = require('laravel-mix');



mix.combine([
    'public/universal2/assets/vendor/jquery.min.js',
    'public/universal2/assets/vendor/owl.carousel.min.js',
    'public/universal2/assets/vendor/jquery.autocomplete.js',
    'node_modules/select2/dist/js/select2.full.js',
    'resources/js/universal2/recaptcha_ext.js',
    'resources/js/universal2/feedback.js',
    'resources/js/universal2/order_form.js',
    'resources/js/universal2/support.js',
    'resources/js/universal2/app.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/calculator.js',
    'resources/js/universal2/faq.js',
    'resources/js/universal2/how_it_works.js',
    'resources/js/universal2/map.js',
    'resources/js/universal2/allow_cookies.js',
    'resources/js/universal2/google_tag_manager.js',
    "resources/js/personal/tracking.js",
    "resources/js/personal/tracking_short.js",
    "resources/js/personal/tracking_result.js",
    "resources/js/personal/tracking_result_item.js",
    'resources/js/universal2/contacts.js',
], 'public/universal2/new.js').version();

mix.combine([
    'public/personal/assets/vendor/jquery.min.js',
    'public/personal/assets/vendor/owl.carousel.min.js',
    'public/personal/assets/vendor/jquery.autocomplete.js',
    'resources/js/universal2/recaptcha_ext.js',
    'resources/js/universal2/google_tag_manager.js',
    "resources/js/personal/tracking.js",
    "resources/js/personal/tracking_short.js",
    "resources/js/personal/tracking_result.js",
    "resources/js/personal/tracking_result_item.js",
    'resources/js/personal/app.js',
    'resources/js/personal/feedback.js',
    'resources/js/personal/feedback_reviews.js',
    'resources/js/personal/office.js',
    'resources/js/personal/allow_cookies.js',
    'resources/js/universal2/tariffs.js',
    'resources/js/universal2/calculator.js',
], 'public/personal/new.js').version();

mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/universal2/select2').version();
mix.copy('resources/css/universal2/app.css', 'public/universal2/app.css').version();
mix.copy('resources/css/universal2/info.css', 'public/universal2/info.css').version();
mix.copy('resources/css/universal2/custom.css', 'public/universal2/custom.css').version();

mix.copy('node_modules/leaflet.markercluster/dist/MarkerCluster.css', 'public/universal2/MarkerCluster.css').version();
mix.copy('node_modules/leaflet.markercluster/dist/MarkerCluster.Default.css', 'public/universal2/MarkerCluster.Default.css').version();

mix.copy('resources/css/universal2/custom.css', 'public/universal2/custom.css').version();

mix.copy('node_modules/leaflet.markercluster/dist/leaflet.markercluster.js', 'public/universal2/leaflet.markercluster.js').version();




mix.copy('vendor/almasaeed2010/adminlte/plugins/select2/', 'public/admin_files/select2').version();

mix.combine([
    "resources/js/admin_files/admin.js",
    "resources/js/admin_files/texts.js",
    "resources/js/admin_files/permissions.js",
    "resources/js/admin_files/pages.js",
    "resources/js/admin_files/local_offices.js",
    "resources/js/admin_files/top_offices.js",
    "resources/js/admin_files/world_languages.js",
    "resources/js/admin_files/languages.js",
    "resources/js/admin_files/images.js",
], 'public/admin_files/new_admin.js').version();

